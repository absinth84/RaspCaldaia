#!/bin/bash

#Temperature 
t=20

while true ;
do 

	temp=$(bash /root/term/read_tmp.sh all)
	date
	echo "temperatura: $temp"

	if (( `echo "$temp<${t}" | bc -l` ))
	then
		echo "1" > /sys/class/gpio/gpio25/value
	else	
		echo "0" > /sys/class/gpio/gpio25/value	
	fi
	
	echo "Rele=" $( cat /sys/class/gpio/gpio25/value)
	echo
	sleep 5m
done

