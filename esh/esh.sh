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

multiline=false
buffer=()

while read line
do
	if $multiline
	then
		esh_end=$(echo "$line" | sed -n '/<% esh_end %>/p')
		if [ -n "$esh_end" ]
		then
			# Ausführen des Shellcodes
			commands=''
			for command in "${buffer[@]}"
			do
				commands=$commands$command'\n'
			done
			
			# Execute the shell command, if there is one.
			if [ -n "$commands" ]
			then
				#output=$(eval $commands)
				output=$(echo "$commands" | sh)
			else
				output=''
			fi
			
			echo "$output"
							
			multiline=false
		else
			buffer+=("$line")
		fi
	else
		# Extract the shell command from the esh tag.
		command=$(echo "$line" | sed -n 's/\(^.*\)\(<%\)\(.*\)\(%>\)\(.*$\)/\3/p')
		if [ "$command" == " esh_begin " ]
		then
			multiline=true
		else
			# Execute the shell command, if there is one.
			if [ -n "$command" ]
			then
				output=$(eval $command)
			else
				output=''
			fi
			# Sometimes, slashes appear in a commands output text. Escape them.
			output=$(echo "$output" | sed 's/\//\\&/')
	
			# Substitute the original esh tag with its output.
			substitution=$(echo "$line" | sed 's/<%.*%>/'"$output"'/')
	
			# Print that shit.
			echo "$substitution"
		fi
	fi
done < "$1.html.esh"
