#!/bin/sh

#
# Embedded Shell (esh) interpreter.
#
# Usage:
# $ esh templatefile
#
# The template file must have the file ending '.html.esh'.
#

# Check if a template filename is given.
if [ $# -lt 1 ]
then
	echo 'Usage: esh templatefile'
	exit 1
fi

# Check if the template file exists.
if [ ! -e "$1.html.esh" ]
then
	echo "The template file $1.html.esh does not exist."
	exit 1
fi

# Any shell code can be appended as a second command line argument
# when calling the esh interpreter. Execute it!
if [ $# -eq 2 ]
then
	eval "$2"
fi

esh_multiline=false
esh_buffer=()

# Iterate over the lines of the template file.
while read line
do
	if $esh_multiline
	then
		# The "Parser" is inside a multi line esh block.
		esh_end=$(echo "$line" | sed -n '/<% esh_end %>/p')
		if [ -n "$esh_end" ]
		then
			# Concatenate all command lines from a buffer to a script.
			esh_commands=''
			for esh_command in "${esh_buffer[@]}"
			do
				esh_commands=$esh_commands$esh_command'\n'
			done
			
			# Execute the shell esh_command, if there is one.	
			esh_output=$(echo "$esh_commands" | sh)
			
			echo "$esh_output"
							
			esh_multiline=false
			esh_buffer=()
		else
			# Continue to read lines into the esh_buffer. The esh block hasn't ended yet.
			esh_buffer+=("$line")
		fi
	else
		# The parser is not in a multi line esh block.
		# Extract the shell command from the esh tag.
		esh_command=$(echo "$line" | sed -n 's/\(^.*\)\(<%\)\(.*\)\(%>\)\(.*$\)/\3/p')
		if [ "$esh_command" == " esh_begin " ]
		then
			# A multi line esh block has begun! Remember it!
			esh_multiline=true
		else
			# Execute the shell esh_command, if there is one.
			if [ -n "$esh_command" ]
			then
				# One line esh esh_command found.
				esh_output=$(eval $esh_command)
				
				# Sometimes, slashes appear in a commands output text. Escape them.
				esh_output=$(echo "$esh_output" | sed 's/\//\\&/')
			else
				# No esh commands found. Just simple html.
				esh_output=''
			fi
	
			# Substitute the original esh tag with its esh_output.
			esh_substitution=$(echo "$line" | sed 's/<%.*%>/'"$esh_output"'/')
	
			# Print that shit.
			echo "$esh_substitution"
		fi
	fi
done < "$1.html.esh"
