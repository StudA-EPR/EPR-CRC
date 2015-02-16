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

######################
# Main program
######################

check_args $#


if [ $# -eq 2 ]; then
	ssh_port_nr_string="-p $2"
	scp_port_nr_string="-P $2"
else
	ssh_port_nr_string=''
	scp_port_nr_string=''
fi

# Stop web server.
echo 'Stopping the http web server ...'
ssh $ssh_port_nr_string "$1" '/etc/init.d/uhttpd stop'

# Copy HTML files, ESH templates, assets and CGI scripts.
echo 'Copying files to the router ...'
scp $scp_port_nr_string -r ./webGUI/* "$1:/www/"

# Execute the setup script.
echo 'Executing setup script ...'
ssh $ssh_port_nr_string "$1" 'sh' < setup.sh

# Start web server.
echo 'Starting the http web server ...'
ssh $ssh_port_nr_string "$1" '/etc/init.d/uhttpd start'

echo 'Done!'