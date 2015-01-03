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

multiline=false
buffer=()

# Iterate over the lines of the template file.
while read line
do
	if $multiline
	then
		# The "Parser" is inside a multi line esh block.
		esh_end=$(echo "$line" | sed -n '/<% esh_end %>/p')
		if [ -n "$esh_end" ]
		then
			# Concatenate all command lines from a buffer to a script.
			commands=''
			for command in "${buffer[@]}"
			do
				commands=$commands$command'\n'
			done
			
			# Execute the shell command, if there is one.	
			output=$(echo "$commands" | sh)
			
			echo "$output"
							
			multiline=false
			buffer=()
		else
			# Continue to read lines into the buffer. The esh block hasn't ended yet.
			buffer+=("$line")
		fi
	else
		# The parser is not in a multi line esh block.
		# Extract the shell command from the esh tag.
		command=$(echo "$line" | sed -n 's/\(^.*\)\(<%\)\(.*\)\(%>\)\(.*$\)/\3/p')
		if [ "$command" == " esh_begin " ]
		then
			# A multi line esh block has begun! Remember it!
			multiline=true
		else
			# Execute the shell command, if there is one.
			if [ -n "$command" ]
			then
				# One line esh command found.
				output=$(eval $command)
				
				# Sometimes, slashes appear in a commands output text. Escape them.
				output=$(echo "$output" | sed 's/\//\\&/')
			else
				# No esh commands found. Just simple html.
				output=''
			fi
	
			# Substitute the original esh tag with its output.
			substitution=$(echo "$line" | sed 's/<%.*%>/'"$output"'/')
	
			# Print that shit.
			echo "$substitution"
		fi
	fi
done < "$1.html.esh"
