# Symfony 4 - RESTful API 

> Under construction

## Version

- symfony/skeleton

```sh
$ php bin/console --version
Symfony 4.1.0
```


## Installing

Clone this repository

```sh
$ git clone https://github.com/migueabellan/sf4-api
```

Install symfony with composer

```sh
$ composer install
```

Create jwt directory

```sh
$ mkdir config/jwt
```

Generate private and public phrase pass JWT_PASSPHRASE (.env)

```sh
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

Create database and update scheme (.env)
```sh
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force
```

Run symfony
```sh
$ php bin/console server:run
```

## API REST ful

```sh
localhost:8000/api/doc
```
