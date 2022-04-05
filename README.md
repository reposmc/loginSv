## Autenticación LoginSV para Laravel.

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

