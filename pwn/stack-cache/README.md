Stack buffer overflow normal:

![](/Screenshots/Pasted%20image%2020220317131540.png)

Há duas funções interessantes, `win()` e `UnderConstruction()`.

![](/Screenshots/Pasted%20image%2020220329175052.png)

A primeira carrega a flag na memória com `fgets()`, mas não printa.

A segunda usa `printf()` para printar algumas informações de variáveis vazias, usando *format string*.

Após controlar o EIP e apontar o programa para a função `UnderConstruction()`, são printadas várias informações em hexadecimal, presumivelmente conteúdo vazado da stack.

![](/Screenshots/Pasted%20image%2020220317144219.png)

Sobrescrevendo o endereço de retorno novamente com o endereço da função `UnderConstruction()`, é possível chamá-la mais uma vez, e novos dados são vazados.

![](/Screenshot/Pasted%20image%2020220317155644.png)

Sabendo disso, fiz um exploit simples para entrar na função `win()` (e então carregar a flag na memória), entrar na função `UnderConstruction()` algumas vezes para vazar o conteúdo da memória e então parsear o conteúdo e retornar a flag.

![](/Screenshot/Pasted%20image%2020220317162208.png)