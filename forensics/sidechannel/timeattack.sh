#!/bin/bash

for i in {0..9}; do
#	for j in {0..2}; do
		k=${i}0000000
		echo $k
		(time echo $k | ./pin_checker) 2>&1 | grep real | grep -Eo "m[^s]+s" | sed "s/m\|s//g"
#	done
done
