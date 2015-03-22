#!/bin/sh

#
# Use this script to make backups of the www folder of your OpenWrt router.
#
# Usage:
# ./backup.sh <IP or hostname> <optional port number>
#

######################
# Helper functions
######################

# Print a help page.
function print_help()
{
	echo 'Usage: ./backup.sh <IP or hostname> <optinal port number>'
}

# Check for correct arguments.
function check_args()
{
	if [ $1 -lt 1 ]
	then
		print_help
		exit 1
	fi
}

######################
# Main program
######################

check_args $#

timestamp=$(date "+%Y-%m-%d_%H-%M-%S")

ssh_port=22

# Check if an optional port number is given.
if [ $# -eq 2 ]
then
	ssh_port=$2
fi

# Connect to the remote host, create a tar archive of the www folder.
# The compression using gzip happens at the client for performance reasons.
ssh -p $ssh_port "root@$1" "tar cf - /www" | gzip > "backup_$timestamp.tar.gz"

