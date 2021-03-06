# Iniciando o projeto
1. Clone o projeto através do comando

```
$ git clone https://github.com/xStarman/crud-gazin.git
``` 

2. Execute os comandos para entrar no diretório e iniciar o docker
```
$ cd crud-gazin
$ docker-compose up -d
```

> Feito isto, três containers serão criados: gazin-back, gazin-front e db, rodando respectivamente nas portas 8080, 8081 e 3306. Tenha certeza que estas portas não estão em uso antes de subir os containers


# Estrutura principal do projeto
> Este projeto utiliza Laravel com PHP (https://laravel.com/docs/8.x/) para o back-end, mysql como banco de dados e Quasar Framework com Vuejs (https://quasar.dev/) para o front-end 
```
backend
|   ├─── app
|   |     ├─── Http
|   |     |     └─── Controllers - diretório contendo os controllers
|   |     └─── Models -  diretório contendo os models
|   ├─── database
|   |     └─── migrations - diretório contendo as migrations estrutura do banco
|   └─── tests
|   └─── Features - diretório contendo os testes
|
frontend
|   └─── src
|         ├─── Components - componentes .vue
|         └─── Pages - páginas .vue
|
dbdata - arquivos do banco de dados
docker-compose.yml

```
# Comandos
#### Iniciar containers docker
> `$ docker-compose up -d`
#### Gerar tabelas do banco de dados
> `$ docker exec gazin-back "php /var/www/html/application/artisan migrate"`
#### Executar testes
> `$ docker exec -it gazin-back php /var/www/html/application/artisan test --env=test`


# Endpoints
#### GET /developers/{id} 
> Retorna um unico desenvolvedor de acordo com o id informado

```json
Status 200
{
  "id": 1,
  "nome": "Edson Junior",
  "sexo": "M",
  "idade": 25,
  "hobby": "Instrumentos musicais",
  "datanascimento": "1995-02-23",
  "created_at": "2020-10-08T22:13:17.000000Z",
  "updated_at": "2020-10-08T22:13:17.000000Z"
}

```
```json
Status 404
{}
```

#### GET /developers?page={page}&perPage={perPage}&q={queryString}
> Retorna uma lista de desenvolvedores de acordo com os parâmetros

parâmetro | tipo | obrigatório | descrição
:--------- | :--------- | :--------- | :--------- 
page | integer | não | Número da página
perPage | integer | não | Quantidade de registros por página
queryString | string | não | Nome completo ou parcial do desenvolvedor

```json
Status 200
{
  "current_page": 1,
  "data": [
    {
     "id": 1,
     "nome": "Edson Junior",
     "sexo": "M",
     "idade": 25,
     "hobby": "Instrumentos musicais",
     "datanascimento": "1995-02-23",
     "created_at": "2020-10-08T22:13:17.000000Z",
     "updated_at": "2020-10-08T22:13:17.000000Z"
    },
    >> [... outros registros] <<
  ],
  "first_page_url": "/developers?page=1",
  "from": 1,
  "last_page": 1,
  "last_page_url": "/developers?page=1",
  "next_page_url": null,
  "path": "/developers",
  "per_page": "2",
  "prev_page_url": null,
  "to": 2,
  "total": 2
}

```
```json
Status 404
[]
```

#### POST /developers
> Insere um novo desenvolvedor

parâmetro | tipo | obrigatório | descrição
:--------- | :--------- | :--------- | :--------- 
nome | string | sim | Nome do desenvolvedor
sexo | char | sim | Gênero do desenvolvedor [F => feminino, M => masculino, O => outro]
hobby | string | sim | Hobby do desenvolvedor
datanascimento | date | sim | Data de nascimento do desenvolvedor

```json
Status 200
{
  "id": 1,
  "nome": "Edson Junior",
  "sexo": "M",
  "idade": 25,
  "hobby": "Instrumentos musicais",
  "datanascimento": "1995-02-23",
  "created_at": "2020-10-08T22:13:17.000000Z",
  "updated_at": "2020-10-08T22:13:17.000000Z"
}

```
```json
Status 400
{
  "nome": [
    "O nome é obrigatório."
  ],
  "sexo": [
    "O sexo é obrigatório."
  ],
  "hobby": [
    "O hobby é obrigatório."
  ],
  "datanascimento": [
    "A data de nascimento é obrigatória."
  ]
}
```

#### PUT /developers/{id}
> Atualiza um desenvolvedor de acordo com o id informado

parâmetro | tipo | obrigatório | descrição
:--------- | :--------- | :--------- | :--------- 
nome | string | sim | Nome do desenvolvedor
sexo | char | sim | Gênero do desenvolvedor [F => feminino, M => masculino, O => outro]
hobby | string | sim | Hobby do desenvolvedor
datanascimento | date | sim | Data de nascimento do desenvolvedor

```json
Status 204
Empty

```
```json
Status 400
{
  "id" : [
    "O id informado é inválido"
  ],
  "nome": [
    "O nome é obrigatório."
  ],
  "sexo": [
    "O sexo é obrigatório."
  ],
  "hobby": [
    "O hobby é obrigatório."
  ],
  "datanascimento": [
    "A data de nascimento é obrigatória."
  ]
}
```

#### DELETE /developers/{id}
> Remove o desenvolvedor pelo id informado

```json
Status 204
Empty

```
```json
Status 400
{
  "id" : [
    "O id informado é inválido"
  ]
}
```

