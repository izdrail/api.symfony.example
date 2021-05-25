# Stefan Izdrail

Simple example of an API REST with Symfony 5.2

## Install with Composer

```
    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar install or composer install
```

## Setting Environment

```
    $ cp .env.dist .env
```

## Setup Database

```
Setup your database credentials in the env file
```



## Running migrations

```
php bin/console doctrine:migrations:migrate

```

## Running fixture
```
php bin/console doctrine:fixtures:load
```

## View Documentation

```
visit https://localhost/doc for the documentation endpoint
```



## Getting with Curl

```
    $ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/expenses
    $ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/expenses/:id
    $ curl -H 'content-type: application/json' -v -X POST -d '{"description":"Foo bar","value":"19.99"}' http://127.0.0.1:8000/api/expenses
    $ curl -H 'content-type: application/json' -v -X PUT -d '{"description":"Foo bar","value":"19.99"}' http://127.0.0.1:8000/api/expenses/:id
    $ curl -H 'content-type: application/json' -v -X DELETE http://127.0.0.1:8000/api/expenses/remove/:id
```

## Credentials

```
For testing use admin:admin
```


## User Authentication with Curl

```
    $ curl -H 'content-type: application/json' -v -X GET http://127.0.0.1:8000/api/expenses  -H 'Authorization:Basic username:password or email:password'
```

## Running the  Phpunit tests

```
    $ phpunit or ./bin/phpunit
```


