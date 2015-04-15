#!/bin/sh

if [ $# -lt 1 ]
then
	echo 'Missing argument: Number of seconds to log memory stats.'
	exit 1
fi

date_format='+%H-%M-%S'
log='mem-stat-'$(date $date_format)

echo '['$(date $date_format)'] Starting ...' >> $log

i=0

while [ $i -lt $1 ]
do
	echo '['$(date $date_format)']' >> $log
	echo $(free -k) >> $log
	echo '' >> $log
	
	sleep 1
	i=$((i+1))
done

echo '['$(date $date_format)']End' >> $log