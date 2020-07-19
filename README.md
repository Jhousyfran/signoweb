# Signo

Este é um projeto em PHP puro usando Orientação a Objetos e usando o padrão MVC. O projeto também faz uso do composer para aproveitar o autoload além da PSR-4 e obter beneficios como namespaces;

![image](https://raw.githubusercontent.com/Jhousyfran/signoweb/master/app/Public/img/Screenshot.png)

##### A estrura do projeto:

\|\- app   \-    \|

\|                \|\- Controllers // controllers da Aplicação

\|                \|\- Model        // models da Aplicação

\|                \|\- Views        // View da Aplicação

\|               Rotas\.php    // Url amigaveis

\|\- config  \- \|

\|                autoload\.php

\|                configuracoes\.php

\|                helpers\.php

\|\- documentacao

\|\- initdb

\|\- src

\|\- composer\.json

\|\- docker\-compse\.yml

\|\- \.env\.ini

\|\- index\.php

\|\- README\.md

<br>
**OBS: Se apagarmos os arquivos da pasta app/Controllers, app/Model/, e app//Views/ e limparmos o arquivo app/Rotas.php, teremos uma estrutura pronta para ser usada como um micro-framework capaz de atender as necessidades básicas de uma aplicação, como esta.**


#### A estrura do banco de dados:

![image](https://raw.githubusercontent.com/Jhousyfran/signoweb/master/Documentacao/db_modelagem.png)

**OBS: A estrutura poderia ser mais simples, poderiamos ter apenas uma coluna na tabela "enquete\_respostas" para contabilizar os votos de cada resposta, sempre que alguém votasse poderiamos incrementar o valor, mas esta estrutura foi feita da forma mostrada a cima pois assim, podemos guardar o momento exatato em que cada voto acontece, isso seria util no futuro para uma possível auditoria, talvez ficaria melhor ainda se criássemos mais uma coluna na tabela "enquete\_votos" para guardar o ip de quem vota, e poderiamos guardar outras informações (navegador, etc) mais que seriam utéis...**

## O Desafio

#### Requisitos

1. Não utilizar framework, o desenvolvimento deve utilizar seus conhecimentos da
2. linguagem.
3. Banco de dados MYSQL
4. Linguagem de programação PHP OO

#### SISTEMA DE VOTAÇÃO

Criar um back (crud completo de criação/edição/exclusão) com gerenciamento de enquete e
opções.
\- A enquete deve ter um título e uma data programada para início e para término\.

\- O cadastro de opções de respostas da enquete devem ser dinâmicas\, é obrigatório mínimo 3 opções\.

Visualização da enquete

\- Listar todas as enquetes cadastradas no banco com o título e data de início e término\, apresentar todas as enquetes\, não iniciadas/em andamento/finalizadas\.

\- Criar tela de apresentar a enquete com opções de resposta\, com a data de início e término\. Essa tela deve obedecer:

\- Ao lado de cada opção\, apresentar os números de votação total do lado de cada opção\.

\- Se a enquete não estiver ativa entre data/hora início e data/hora fim\, as opções e o botão de votar deve estar desabilitado\.

\- \* Os números de resultados devem ser apresentados sempre que houver novo voto \(realtime\)
<br>
## A solução

#### Como rodar

**Antes de seguir os passos abaixo tenha certeza que o docker e docker-compose estão instalados na maquina. Para rodar este projeto:**

1\. Clone este repositorio  e entre na pasta

```
git clone [https://github.com/Jhousyfran/signoweb.git](https://github.com/Jhousyfran/signoweb.git) 
cd signoweb
```

2\. O arquivo de configurações é o \.env\.ini \(ele já esta configurado\)\, mas você pode dá uma olhada e conferir :\)

3\. Faça o build dos containers \, o container **web** vai usar a porta 80 e o container **db** irá usar a porta 8306, certifique-se que essas portas estejam livre antes de continuar. Se seu usuário não estiver incluido no grupo de permissões do **docker e docker-compose**  será necessário executar os comandos como administrador (sudo)

```
docker network create www_signo
docker-compose up -d
```

4\. Instale as dependências

```
docker-compose run web composer install
```

5\. Agora você pode acessar aplicação em [localhost ou clique aqui!](http://localhost)
<br>
### ~~Como rodar sem docker~~
<br>
1\. Clone este repositorio \(na diretorio do seu serviço http \- apache ou nginx \-\) e entre na pasta\.

```
git clone [https://github.com/Jhousyfran/signoweb.git](https://github.com/Jhousyfran/signoweb.git)
cd signoweb
```
<br>
2\. O arquivo de configurações é o \.env\.ini \(ele já esta configurado\)\, mas você pode dá uma olhada e conferir  Se não estiver usando docker então modifique as variaveis para apontar para seu banco de dados\.

3\. É necessário ter o composer na sua máquina\.
<br>
```
composer install
```
<br>
4\. Importe para seu banco de dados o arquivo em **initdb/setup.sql**

5\. Acesse a aplicação pelo seu serviço Http \(seja apache o nginx\);
