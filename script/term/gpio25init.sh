#!/bin/bash
if [ ! -d /sys/class/gpio/gpio25 ] 
then
  echo "25" > /sys/class/gpio/export
  echo "out" > /sys/class/gpio/gpio25/direction
fi
