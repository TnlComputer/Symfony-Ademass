# Curso Symfony

## Ademass.com

### Dictado por dfbastidas

Contiene de 23 videos

##Se necesita tener instalado

Node, Xampp o Wamp, PHP 8.0 o superior, Composer, Scoop Symfony.cli
Enlaces de interés:

### Xampp:

https://www.apachefriends.org/es/inde...

### Composer:

https://getcomposer.org/

Symfony:

https://symfony.com/doc/current/setup...

Scoop https://scoop.sh/

### Como instalar scoop

abrimos el cmd

Set-ExecutionPolicy RemoteSigned -scope CurrentUser

iex (new-object net.webclient).downloadstring('https://get.scoop.sh')

scoop install symfony-cli

### crear proyecto symfony para proyectos web

symfony new --webapp my_project

### Dentro del proyecto ejecutar

composer require symfony/webpack-encore-bundle de ser necesitario

### crear pryecto symfony para proyectos

symfony new my_project

### ejecutar el serve

symfony serve
