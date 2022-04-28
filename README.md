# Prueba tecnica Evertec

## Tecnologías

La aplicación utiliza las siguientes tecnologías:

- [Laravel](https://laravel.com/) - Laravel!
- [Bootstrap](https://getbootstrap.com/) - Cree sitios rápidos y receptivos con Bootstrap
- [MySQL](https://www.mysql.com/) - Sistema de gestión de bases de datos relacional

## Instalación

El aplicativo requiere de  [Composer](https://getcomposer.org/) para la instalación de dependencias.

Instalar dependencias de PHP.

```sh
cd evertec_prueba
composer install
```

Se debe contar con una base de datos en MySQL llamada "laravel" para ejecutar el siguiente comando

```sh
cd evertec_prueba
php artisan migrate:fresh --seed
```


El aplicativo requiere de [Node.js](https://nodejs.org/) para la instalación de dependencias.

Instalar dependencias de node js.

```sh
cd evertec_prueba
npm i
```

## Variables de entorno

Se deben asignar las siguientes variables de entorno para ejecutar de forma exitosa
```sh
APP_URL=                Ruta donde se está ejecutando la aplicación por lo general http://127.0.0.1:8000
URL_BASE_PLACETOPAY=    Url base del servicio placetopay 
LOGIN_PLACETOPAY=       Variable de logueo para hacer uso del servicio placetopay
SECRET_PLACETOPAY=      Variable secret para hacer uso del servicio placetopay
```

## Ejecución

Para la ejecución del aplicativo se requiere el siguiente comando

```sh
cd evertec_prueba
php artisan serve
```
Dirigirse a la dirección dada por la terminal (por lo general => http://127.0.0.1:8000)

## Manual de usuario
A continuación, encontrara un manual de usuario sencillo que describe el funcionamiento básico del aplicativo
- [Manual de usuario](https://laravel.com/)

## Licencia
MIT
