## Librería para la autenticación de LoginSV para Laravel.
[![Latest Stable Version](http://poser.pugx.org/leolopez/loginsv/v)](https://packagist.org/packages/leolopez/loginsv) 
[![Total Downloads](http://poser.pugx.org/leolopez/loginsv/downloads)](https://packagist.org/packages/leolopez/loginsv) 
[![Latest Unstable Version](http://poser.pugx.org/leolopez/loginsv/v/unstable)](https://packagist.org/packages/leolopez/loginsv) 
[![License](http://poser.pugx.org/leolopez/loginsv/license)](https://packagist.org/packages/leolopez/loginsv) 
[![PHP Version Require](http://poser.pugx.org/leolopez/loginsv/require/php)](https://packagist.org/packages/leolopez/loginsv)

### Instalación

Instalar el paquete usando el siguiente comando,

    composer require leolopez/loginsv
    
## Registrar el proveedor de servicios

Agregar el proveedor de servicios en `config/app.php` dentro de la sección de `providers`.
    
    Leolopez\LoginSv\LoginSvServiceProvider::class

## Publicar los recursos

Correr el siguiente comando para la publicación del archivo de configuración en `config/loginsv.php` y el controlador
en `App\Http\Controller\LoginSvController.php`.

    php artisan vendor:publish --provider="Leolopez\Loginsv\LoginSvServiceProvider"
    
## Registrar las credenciales

Agregar las credenciales dentro del `.env`.

    LOGIN_SV_CLIENT_ID='client_id'
    LOGIN_SV_CLIENT_SECRET='client_secret'
    LOGIN_SV_REDIRECT='https://project_url/callback'
    
## Registrar credenciales en Services.php

Agregar las referencias del controlador dentro del archivo de configuración `config/services.php`

    'loginsv' => [
        'client_id' => env('LOGIN_SV_CLIENT_ID'),
        'client_secret' => env('LOGIN_SV_CLIENT_SECRET'),
        'redirect' => env('LOGIN_SV_REDIRECT'),
    ],
    
## Rutas disponibles

Esta ruta redirige a la ruta del proveedor para ser autenticado.
    
    /redirectToProvider
    
Esta ruta es la que retorna el proveedor luego de ser autenticado.

    /callback

