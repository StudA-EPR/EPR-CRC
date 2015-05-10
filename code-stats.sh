#!/bin/sh

#
# PHP code statistics.
#
files=(www/*.php www/classes/*.php)
lines=0

for file in ${files[@]}
do
    lines=$((lines + $(cat $file | wc -l)))
done

echo "$lines lines of PHP code in "${#files[@]}' PHP files.'

#
# CSS code statistics.
# Ignore minified CSS files, they are 3rd party libraries.
#
files=(www/css/*[!min].css)
lines=0

for file in ${files[@]}
do
    lines=$((lines + $(cat $file | wc -l)))
done

echo "$lines lines of CSS code in "${#files[@]}' CSS files.'

#
# JavaScript code statistics.
# Ignore minified JavaScript files, they are 3rd party libraries.
#
files=(www/js/*[!min].js)
lines=0

for file in ${files[@]}
do
    lines=$((lines + $(cat $file | wc -l)))
done

echo "$lines lines of JavaScript code in "${#files[@]}' JavaScript files.'