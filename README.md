<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Controle de Estoque

## Sobre o projeto
Projeto criado para fazer o cadastro de produtos com controle de estoque vinculado aos mesmos.


## Fluxo de funcionamento do Controle de Estoque

## Regras e validações
- É preciso criar um produto para ser possível controlar o estoque do mesmo.
- Ao dar entrada em um produto(/products/buy/{id}), o valor do mesmo é atualizado para o da compra.
- Ao dar entrada em um produto(/products/buy/{id}), é criado um registro na tabela de histórico do tipo input contendo quantidade e valor.
- Ao dar entrada em um produto(/products/sell/{id}), é criado um registro na tabela de histórico do tipo output contendo quantidade e valor.
- Ao dar entrada em um produto(/products/buy/{id}), é ajustado (acrescido) a quantidade atual do estoque.
- Ao dar entrada em um produto(/products/sell/{id}), é ajustado (decrescido) a quantidade atual do estoque.
- Valida a quantidade em estoque de acordo com os registros do histórico.

### Rodando o projeto
Caso for a primera execução, execute o comando:
```shell
docker-compose up -d --build
```

Se ja tiver executado o projeto antes, execute o comando:
```shell
docker-compose up -d
```


Para iniciar o banco de dados execute:
~~~shell
php /var/www/artisan migrate
~~~


Para iniciar o banco de dados execute:
~~~shell
docker exec -it iebt_api php artisan migrate
~~~

### Documentação 
Uma documentação básica e mínima foi adicionada no projeto utilizando o Scribe ()
http://api.tvs:8000/docs/#

Para gerar a documentação basta rodar o comando abaixo:
```shell
docker exec -u root -it iebt_api php artisan scribe:generate
```


### Rotas do projeto
| Tipo | Rota | Descrição |
| :--- | :--- | :--- |
| GET | /products | Exibe todos os produtos | 
| POST | /products | Cria um novo produtos |
| GET | /products/ID | Exibe um produtos específico |
| PATCH | /products/ID | Atualiza dados de um produtos |
| DELETE |/products/ID | Exclui um produtos |
| POST | /products/ID/buy | Compra um produto (adiciona ao estoque) |
| POST | /products/ID/sell | Vende um produto (decresce do estoque) |
| GET | /products/validate-stock | Verifica se existe alguma inconsistência no estoque e caso haja corrije baseado no histórico |


### Testes/QA

Para rodar os testes:
```shell
docker exec -it iebt_api php artisan test
```


### Roadmap
- Configurando o docker e variáveis de ambiente.
- Definido PestPHP como framework de testes.
- Criando as migrations e models iniciais do projeto.
- CRUD de produtos implementado.,
- Histórico de entradas e saídas de produtos implementados.
- Implementando a validação de estoque a partir da entrada e saída de produtos.
- Implementando testes unitários com o PestPHP.
- Refatorando e corrigindo erros de percurso.
- Criando Repository e Interface para Produtos

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
