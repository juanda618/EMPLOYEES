<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre el proyecto

Este proyecto tiene como bojetivo servir de backend para ser consumido por una palicacion basada en RECTJS esta configurado en laravel 10 con php 8.1
tiene autenticacion para las rutas protegidas basado en tokens jwt ademas ademas  contiene servicio de mensajeria via "Email" 

## Proyecto Backend para emprea unow



### Consideraciones
es necesario hacer publish a la libreria de JWTAuth
- php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider" 
- php artisan jwt:secret 

## Instalacion

descargar el proyecto usando git o dando click en el boton verde sobre el proyecto

- ejecutar composer install
- php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider" 
- php artisan jwt:secret 

## License

Juan David Vicuña Salazar
