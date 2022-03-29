O programa tem uma format string vulnerability que permite ler dados arbitrários da stack através dos dos *format specifiers* `%s`, `%x`, etc..

![](/Screenshots/Pasted%20image%2020220329163333.png)

![](/Screenshots/Pasted%20image%2020220316101119.png)

Como a função `printf()` do C pode ter um número variável de argumentos (a depender de quantas variáveis serão formatadas), podemos inserir vários `%x` para enganar essa função e fazer ela entender que há vários argumentos para serem printados.

Como os argumentos das funções são carregados na stack, ao fazermos isso nós conseguimos vazar parte do conteúdo da stack (que é onde a flag está, já que foi carregada lá pela função `fgets()` em `readflag()`).

![](/Screenshots/Pasted%20image%2020220316101415.png)

Podemos usar a seguinte feature do printf: quando usamos `printf("%3$d", 1,2,3,4,5)`, ele printa o terceiro argumento (que é 3) do printf. Se usarmos `printf("%2$s", "a", "b", "c")`, ele printa o segundo argumento (que é "b") do printf.

Em suma, podemos usar `%n$s` e passar um valor inteiro no lugar de `n`. Isso tentará printar em forma de string o `n`-ésimo argumento da função `printf` e irá vazar dados da stack em forma de string. Com um simples bruteforce, conseguimos descobrir a posição na stack onde a flag se encontra:

![](/Screenshots/Pasted%20image%2020220329164812.png)

Com a posição em mãos (24), basta usar o exploit no servidor:

![](/Screennshots/Pasted%20image%2020220316111609.png)
