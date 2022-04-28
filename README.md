# Prueba tecnica Evertec

## Tecnologías

La aplicación utiliza las siguientes tecnologías:

- [Laravel](https://laravel.com/) - Laravel!
- [Bootstrap](https://getbootstrap.com/) - Cree sitios rápidos y receptivos con Bootstrap
- [MySQL](https://www.mysql.com/) - Sistema de gestión de bases de datos relacional

## Instalación

Los siguientes comandos deben ejecutarse sobre el directorio de la prueba "evertec_prueba"

El aplicativo requiere de  [Composer](https://getcomposer.org/) para la instalación de dependencias.

Instalar dependencias de PHP.

```sh
composer install
```

Generar llave unica de la aplicación.

```sh
php artisan key:generate
```

El aplicativo requiere de [Node.js](https://nodejs.org/) para la instalación de dependencias.

Instalar dependencias de node js.

```sh
npm i
```
## Variables de entorno

1. Crear un archivo .env a partir del archivo .env.example
2. Se deben asignar las siguientes variables de entorno para ejecutar de forma exitosa
```sh
APP_URL=                Ruta donde se está ejecutando la aplicación por lo general http://127.0.0.1:8000
URL_BASE_PLACETOPAY=    Url base del servicio placetopay 
LOGIN_PLACETOPAY=       Variable de logueo para hacer uso del servicio placetopay
SECRET_PLACETOPAY=      Variable secret para hacer uso del servicio placetopay
```
## Bases de datos

Se debe contar con una base de datos en MySQL llamada "laravel" para ejecutar el siguiente comando

```sh
php artisan migrate:fresh --seed
```

## Ejecución

Para la ejecución del aplicativo se requiere el siguiente comando

```sh
php artisan serve
```

Dirigirse a la dirección dada por la terminal (por lo general => http://127.0.0.1:8000)

## Ejecución tareas programadas

El aplicativo cuenta con tareas programas para la consulta y actualización de registros de órdenes de compra
para la ejecución de dicho proceso es necesario ejecutar el siguiente comando en una terminal aparte situada sobre el directorio del aplicativo

```sh
php artisan schedule:work
```
## Ejecución pruebas unitarias

El aplicativo cuenta con pruebas unitarias que validan la correcta comunicación con el servicio Placetopay, para correr dichas pruebas, se debe ejecutar el siguiente comando

```sh
php artisan test
```

## Manual de usuario
A continuación, encontrara un manual de usuario sencillo que describe el funcionamiento básico del aplicativo
- [Manual de usuario](https://laravel.com/)

## Licencia
MIT
