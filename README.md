# Authoring Tools API 
API Rest da Ferramenta de Autoria. Fornece os dados necessários para as operações na aplicação.
 
### Requisitos de Sistema

- PHP >= 5.6.4
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Mongo DB drive
- PHPUnit
- Redis Drive

### Instalação

IMPORTANTE: configurar o .env (copiar .env.example) na raiz da aplicação com as variáveis de desenvolvimento: conexões com MySQL e Mongo, APP Ids dos servições de autenticação (google, facebook).

```sh
$ composer install
$ php artisan jwt:secret
$ php artisan migrate
$ php artisan db:seed
$ php -S localhost:8000 -t public
```

Servidor de desenvolvimento local: http://localhost:8000

### Pacotes Utilizados

- Lumen Micro Framework [https://lumen.laravel.com/docs/5.4/]
- Socialite [https://github.com/laravel/socialite]
- JWT Auth [https://github.com/tymondesigns/jwt-auth/]
- Laravel MongoDB [https://github.com/jenssegers/laravel-mongodb]
- Predis [https://github.com/nrk/predis]

### Modularização

A aplicação está arquitetada em Módulos. Cada módulo tem responsabilidade definida e
 camadas. O modelo padrão de um módulo segue a seguinte estrutura:
 
 ```
 app
 └───Modules
 │   │   Controllers
 │   │   Events
 │   │   Listeners
 │   │   Middlewares
 │   │   Models
 │   │   Supports
 │   │   Tests
 │   │   routes.php
 ```
 
### Roteamento

As rotas são definidas no arquivos routes.php dentro do diretório raiz de cada módulo.
O RouteServiceProvider é responsável pelo load das rotas de cada módulo definido no config/modules.php. Não sendo preciso instânciar novas chamadas

### Composição dos endpoints

- Modelo : localhost:8000/v1/ + namespace do módulo + ação + parâmetros, 
por exemplo: http://localhost:8000/v1/oauth/login/google e http://localhost:8000/v1/oauth/login/google/callback

### Testes
Existem dois tipos de testes: Integração e Unitário. O diretório padrão onde devem estar os casos é /Tests dentro do módulo em desenvolvimento.
Para testes de integração usar o padrão de nomenclatura "teste + tipo + Test", por exemplo: LoginIntegrationTest (teste: Login, tipo: Integration).

Rodar os testes usando o comando referenciando o testsuite como 'unit' ou 'integration':
```sh
$ phpunit --testsuite integration
$ phpunit --testsuite unit
```