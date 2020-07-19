# Signo

#### Como rodar

Antes de seguir os passos abaixo tenha certeza que o **docker** e **docker-compose** estão instalados na maquina. Para rodar este projeto:

1\. Clone este repositorio e entre na pasta

```
git clone https://github.com/Jhousyfran/signoweb.git
cd sga
```

2\. O arquivo de configurações é o .env.ini (ele já esta configurado)


3\. Faça o build dos containers \, o container **web** vai usar a porta 8000 e o container **db** irá usar a porta 3388, certifique-se que essas portas estejam livre antes de continuar. Se seu usuário não estiver incluido no grupo de permissões do **docker e docker-compose**  será necessário executar os comandos como administrador (sudo)

```
docker network create www_signo
docker-compose up -d
```

4\. Instale as dependências

```
docker-compose run web composer install
```

5\. Faça o build do JS do front\-end da aplicacao

```
docker-compose run node npm run prod
```

6\. Agora você pode acessar aplicação em [localhost:8000 ou clique aqui!](http://localhost:8000)
