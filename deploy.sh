#!/bin/sh

#
# Deployment script that connects to an OpenWRT system, copies the app's data
# and executes required setup steps.
#
# Usage:
# ./deploy.sh <IP or hostname> <optional port number>
#

######################
# Helper functions
######################

# Print a help page.
function print_help()
{
	echo 'Usage: ./deploy.sh <IP or hostname> <optinal port number>'
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

# Removes all files listed in deploy_files.conf at the remote system.
function clean_files()
{
	while read line
	do
		ssh -n -p $ssh_port $hostname "rm /$line"
	done < deploy_files.conf
}

# Create tar archive of files.
function create_archive()
{
	while read line
	do
		# Append file/files in line to the tar file.
		tar rf deployment.tar $line
	done < deploy_files.conf
	
	gzip deployment.tar
}

######################
# Main program
######################

check_args $#

hostname=$1

ssh_port=22

if [ $# -eq 2 ]; then
	ssh_port=$2
fi

# Stop web server.
echo 'Stopping the http web server ...'
ssh -p $ssh_port $hostname '/etc/init.d/uhttpd stop'

# Clean the remote www folder.
echo 'Cleaning app files on remote ...'
clean_files

# Compress app files to archive, transmit them and unpack them on the remote.
create_archive
echo "Transmitting compressed files to remote ..."
scp -q -P $ssh_port deployment.tar.gz "$hostname:/"
echo "Extracting files on remote ..."
ssh -p $ssh_port $hostname 'cd / && tar xzf deployment.tar.gz && rm deployment.tar.gz'
rm deployment.tar.gz

# Execute the setup script.
echo 'Executing setup script ...'
ssh -p $ssh_port $hostname 'sh' < setup.sh

# Start web server.
echo 'Starting the http web server ...'
ssh -p $ssh_port $hostname '/etc/init.d/uhttpd start'

echo 'Done!'