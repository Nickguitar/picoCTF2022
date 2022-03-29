O programa tem uma falha de side channel time attack. Dada a maneira com que o programa valida o pin inserido pelo usuário, é possível notar diferenças no tempo de execução do programa a depender do pin inserido.

Quando nenhum dígito do pin está correto, o programa demora um tempo de execução de x ms.

Quando o primeiro dígito do pin está correto, ele demora x+y ms

Quando o segundo dígito do pin está correto, ele demora x+y+z ms

E assim sucessivamente.

Com base nisso, fiz um simples exploit que testa todas as combinações e monta o pin correto com base no tempo de resposta da aplicação.

![](/Screenshots/Pasted%20image%2020220316020115.png)