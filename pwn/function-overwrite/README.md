É possível escrever dados arbitrários em certas regiões de memória do executável através da manipulação dos números inseridos nele.

A função `vuln()` recebe dois inteiros do usuário, `num1` e `num2`. Caso o primeiro seja menor que 10, o índice `num1` da variável `fun` é setado para ele próprio + o valor de `num2`.

![](/Screenshots/Pasted%20image%2020220329165558.png)

Então, ao setarmos valores negativos para `num1`, podemos fazer com que `num2` seja escrito em outros locais de memória fora do escopo de `fun`.

Além disso, a função `hard_checker()`, que nunca retorna a flag, é utilizada de maneira indireta através de um ponteiro.

`void (*check)(char*, size_t) = hard_checker;`

Em vista disso, podemos setar o `num1` para um número negativo para que ele sobrescreva o valor desse poneiro e usarmos `num2` para apontar para o endereço da função `easy_checker()`, para obtermos a flag.

Quando usamos números negativos altos, recebemos segfault

![](/Screenshots/Pasted%20image%2020220320004711.png)

O dmesg nos diz que houve um erro na instrução em `0x080495f8`

![](/Screenshots/Pasted%20image%2020220320004727.png)

Que é quando o programa tenta pegar o conteúdo de uma área da memória (`[ebx+eax*4+0x80]`) e colocar em `ecx`.

Ocorre que o número negativo que colocamos é inserido em `eax` na instrução anterior (`mov eax, [ebp-0x8c]`) e, portanto, é usado ao se tentar acessar o endereço de memória anterior, que é inválido.

![](/Screenshots/Pasted%20image%2020220320004933.png)

Algumas instruções depois, é possível ver que o conteúdo desse endereço que o programa tenta acessar é carregado em `esi`.

![](/Screenshots/Pasted%20image%2020220320020448.png)

Ao analisar o conteúdo (`36 94 04 08`), nota-se que é justamente o endereço da função `hard_checker`. Ou seja, `esi` é o ponteiro para a função que queremos alterar.

![](/Screenshots/Pasted%20image%2020220320020100.png)

Após testar vários valores, descobri que com o valor `-16` no primeiro número, eu consigo manipular o valor de `esi`.

Sabendo disso, bastou um simples brute force para descobrir o valor necessário para o segundo inteiro para que `esi` aponte para `easy_checker()`.

```bash
for i in {1..314}; do
	echo -e "s\n-16\n$i\n" | ./vuln;
	if [ $? -eq 0 ]; then
		echo -e "\n\n\n\n\n\n\n\n"$i"\n\n\n\n\n\n\n"
	fi
done
```

Um dos possíveis valores é 113:

![](/Screenshots/Pasted%20image%2020220320020025.png)

