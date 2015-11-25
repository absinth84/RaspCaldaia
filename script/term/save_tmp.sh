#!/bin/bash
sensore[0]='28-000005d4ab6a'
d_sensore[0]='camera'
x=0
for i in "${sensore[@]}"
do
 temp=`/root/term/read_tmp.sh $i`
 if [ "$temp" != "-0.062" ]
  then
  if [ "$temp" != "85" ]
   then
    /usr/bin/redis-cli rpush ${d_sensore[${y}]} $temp
  fi
 fi
y=`expr $y + 1` 
done
/usr/bin/redis-cli rpush lettura "`date "+%Y-%m-%d %H:%M:%S"`"
/usr/bin/redis-cli rpush timestamp "`date "+%s"`"
