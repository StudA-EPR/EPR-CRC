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

# Iterate over the lines.
while read line
do
	# Extract the shell command from the esh tag.
	command=$(echo "$line" | sed -n 's/\(^.*\)\(<%\)\(.*\)\(%>\)\(.*$\)/\3/p')
	
	# Execute the shell command.
	output=$(eval $command)
	
	# Sometimes, slashes appear in a commands output text. Escape them.
	output=$(echo "$output" | sed 's/\//\\&/')
	
	# Substitute the original esh tag with its output.
	substitution=$(echo "$line" | sed 's/<%.*%>/'"$output"'/')
	
	# Print the shit.
	echo "$substitution"
done < "$1.html.esh"
