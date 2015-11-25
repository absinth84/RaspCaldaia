#!/bin/bash
temp=`elinks -dump "http://www.wunderground.com/weatherstation/WXDailyHistory.asp?ID=ILISSONE4&format=1"|awk -F "," '{print $2}'| grep '[0-9]\.[0-9]'| tail -1`
echo "Temp Lissone= $temp °C"
/usr/bin/redis-cli rpush temp_esterna $temp
