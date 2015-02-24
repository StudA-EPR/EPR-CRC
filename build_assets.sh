#!/bin/sh

#
# Concatenate assets such as CSS and JavaScript files.
#
# Usage:
# ./build_assets.sh <css/js> <folder>
#

# Print a help page.
function print_help()
{
	echo 'Usage: ./build_assets.sh <css/js> <folder>'
}

# Check for correct arguments.
function check_args()
{
	if [ $1 -lt 2 ]
	then
		print_help
		exit 1
	fi
}

check_args $#

# Get timestamp and create tmp file.
tmp_file="assets_tmp_$(date +%s)"
touch $tmp_file

# Get the files to concatenate.
files=($2/*.$1)

# Concatenate the files into a tmp file.
for file in ${files[@]}
do
	cat $file >> $tmp_file
done

# Get the md5 sum of the tmp file.
md5sum=$(md5 -q $tmp_file)

# Rename the tmp file with the md5 sum in the file name to enable easier browser caching.
mv $tmp_file "assets_$md5sum.$1"

