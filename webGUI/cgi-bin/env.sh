#!/bin/sh

echo "Content-type: text/html"
echo ""

echo '<!DOCTYPE html>'
echo '<html>'
echo '<head>'
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'
echo '<title>dhbw camera remote control</title>'
echo '</head>'
echo '<body>'
echo '<h3>Startseite <u>E</u>in<u>P</u>latinen<u>R</u>echner - <u>C</u>amera <u>R</u>emote <u>C</u>ontrol</h3>'

	echo "<form method=\"GET\" action=\"env.sh\">"
	echo '<br><input type="submit" value="preview" name="option">'
	echo '<br><input type="submit" value="info" name="option">'
	echo '<input type="submit" value="ausloesen" name="option">'
	echo '<input type="submit" value="debug" name="option">'
	echo '<input type="submit" value="listfiles" name="option">'
	echo '<input type="reset" value="reset">'
	echo '<p><input type="submit" value="interval" name="option"> shot every <input name="seconds" type="number" min="1" max="9999" value="3"> seconds </p>'
	echo '</form>'

# Make sure we have been invoked properly.
 
  if [ "$REQUEST_METHOD" != "GET" ]; then
  echo "<hr>Script Error:"\
             "<br>Usage error, cannot complete request, REQUEST_METHOD!=GET."\
             "<br>Check your FORM declaration and be sure to use METHOD=\"GET\".<hr>"
	        exit 1
 fi


# exit if there are no search arguments
if [ -z "$QUERY_STRING" ]; then
	        exit 0
else
     # extract the data from querystrings with sed:
     OPTION=`echo "$QUERY_STRING" | sed -n 's/^.*option=\([^&]*\).*$/\1/p' | sed "s/%20/ /g"`
     SECONDS=`echo "$QUERY_STRING" | sed -n 's/^.*seconds=\([^&]*\).*$/\1/p' | sed "s/%20/ /g"`
     ZZ=`echo "$QUERY_STRING" | sed -n 's/^.*val_z=\([^&]*\).*$/\1/p' | sed "s/%20/ /g"`
     echo #Variable:  Wert'
     echo "OPTION: " $OPTION
     echo '<br>'
     echo "Interval-SECONDS: " $SECONDS
     echo '<br>'
     echo "val_z: " $ZZ
fi

echo $QUERY_STRING echo $QUERY_STRING | sed .s/&/ /g.

echo '<hr>'
echo '<b>Ausgabe:</b><br>'

 
if [ "$OPTION" = "ausloesen" ]; then
	ausgabe=$(gphoto2 --capture-image-and-download)
fi

if [ "$OPTION" = "info" ]; then
	ausgabe1=$(gphoto2 --auto-detect)"<br>"
	ausgabe2=$(gphoto2 --abilities | sed 's/$/ <br>/' )
	ausgabe=$ausgabe1$ausgabe2
fi

if [ "$OPTION" = "listfiles" ]; then
	ausgabe=$(gphoto2 --list-files)
fi

if [ "$OPTION" = "debug" ]; then
	ausgabe=$(ls -l)
fi

if [ "$OPTION" = "reset" ]; then
	ausgabe=$(reboot)
fi

if [ "$OPTION" = "interval" ]; then
	ausgabe=$(gphoto2 --capture-image-and-download --interval "$SECONDS")
fi

if [ "$OPTION" = "preview" ]; then
	ausgabe=$(gphoto2 --capture-preview --force-overwrite --filename preview.jpg)
fi

if [ "$OPTION" = "reset" ]; then
	ausgabe=$(gphoto2 --capture-preview --force-overwrite --filename preview.jpg)
fi

echo "$ausgabe" | sed 's/^.*$/&<br>/g'

echo '<br><img src="../preview.jpg">'


echo '<br>'
echo '<hr>'
echo 'maybe we use this: http://stackoverflow.com/questions/3919755/how-to-parse-query-string-from-a-bash-cgi-cript to iterate through our post parameters'
echo '<table border="1">'
echo '<tr><td colspan="2"><b>Environment Variables</b></td></tr>'
echo '<tr><td colspan="2"><pre>'
export
echo '</pre></td>'
echo '</tr>'

echo '<tr><td><b>Uptime:</b></td><td><b>uname -a:</b></td></tr>'
echo '<tr>'
echo '<td><pre>' 
uptime 
echo '</pre></td>'
echo '<td><pre>'
uname -a
echo '</pre></td>'
echo '<tr><td colspan="2"><b>cat /proc/version</b></td></tr>'
echo '<tr><td colspan="2"><pre>'
cat /proc/version
echo '</pre></td></tr>'
echo '</table>'

echo '</body>'
echo '</html>'

exit 0
        