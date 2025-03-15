<?php

return [

    /*
    |--------------------------------------------------------------------------
    |  Configuración de Autenticación
    |--------------------------------------------------------------------------
    |
    | Este archivo define la configuración de autenticación para la aplicación,
    | incluyendo los "guards" (métodos de autenticación), los "providers" 
    | (fuentes de datos de los usuarios) y el sistema de restablecimiento de 
    | contraseñas.
    |
    */

    'defaults' => [
        /**
         *  Guard por defecto: `api`
         * Laravel usará este guard por defecto para la autenticación.
         *
         *  Configuración de recuperación de contraseña: `users`
         * Define qué conjunto de usuarios utilizará el sistema de recuperación de contraseñas.
         */
        'guard' => 'api',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    |  Guards de Autenticación
    |--------------------------------------------------------------------------
    |
    | Los "guards" definen la manera en que los usuarios se autentican.
    | En este caso, usamos JWT (JSON Web Token) para autenticación vía API.
    |
    */

    'guards' => [
        'api' => [
            'driver' => 'jwt', // Usa JWT en lugar de sesiones
            'provider' => 'users', // Utiliza la fuente de datos 'users'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    |  Proveedores de Usuarios (User Providers)
    |--------------------------------------------------------------------------
    |
    | Un "provider" define cómo Laravel obtiene los usuarios de la base de datos.
    | En este caso, usamos Eloquent con el modelo `User`.
    |
    |  Alternativamente, se podría usar la base de datos directamente 
    | con el driver `database`.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent', // Usa Eloquent ORM
            'model' => App\Models\User::class, // Modelo User
        ],

        //  Alternativa: Usar la base de datos directamente
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    |  Configuración de Restablecimiento de Contraseñas
    |--------------------------------------------------------------------------
    |
    | Laravel incluye un sistema de restablecimiento de contraseñas.
    | Esta sección configura el tiempo de expiración y el tiempo mínimo
    | entre solicitudes de restablecimiento.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users', // Usa la fuente de datos 'users'
            'table' => 'password_reset_tokens', // Tabla donde se almacenan los tokens
            'expire' => 60, // El token expira en 60 minutos
            'throttle' => 60, // Tiempo de espera entre solicitudes
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    |  Tiempo de Espera para Confirmación de Contraseña
    |--------------------------------------------------------------------------
    |
    | Define el tiempo en segundos antes de que Laravel solicite nuevamente
    | la contraseña del usuario para confirmar ciertas acciones sensibles.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800), // 3 horas

];
