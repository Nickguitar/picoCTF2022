Buffer overflow ret2win básico. Para obter a flag, basta sobrescrever o buffer e alterar o endereço de retorno para o da função `win()`, que retorna a flag.

![](/Screenshots/Pasted%20image%2020220315212458.png)

Endereço da função `win()` = `0x080491f6`

![](/Screenshots/Pasted%20image%2020220315212521.png)

Fuzz para descobrir o offset do EIP

![](/Screenshots/Pasted%20image%2020220329110423.png)

Com 44 bytes nós alcançamos o EIP.

![](/Screenshots/Pasted%20image%2020220329110455.png)

Agora basta enviar 44 bytes + endereço da função `win()` para o programa:

![](/Screenshots/Pasted%20image%2020220329110607.png)
