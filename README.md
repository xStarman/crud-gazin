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
{}
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
