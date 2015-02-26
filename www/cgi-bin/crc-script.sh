#!/bin/sh
option=$(echo "$QUERY_STRING"|awk -F'=' '{print $2}')
option=${QUERY_STRING}
ausgabe="kein Parameter"
if ["$option" = "takepicture"]
  then
   ausgabe=`gphoto2 --capture-image-and-download`
elif ["$option" = "debug"]
 then
  ausgabe=`gphoto2 --debug`
elif ["$option" = "listfiles"]  
 then
 ausgabe=`gphoto2 --list-files`
else
 ausgabe="falscher Parameter"
fi
echo "Content-type: text/html"
echo ""
echo "Ausgabe:" ${ausgabe}
echo "<br>"
echo "<pre>"
ls -l
gphoto2 --debug
echo "</pre>" 
echo "Option:" ${option}
echo "$QUERY_STRING"
cat /www/crc/crc.html 
