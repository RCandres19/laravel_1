<?php

/*
 * Este archivo es parte de jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * Para obtener la información completa sobre derechos de autor y licencia,
 * consulta el archivo LICENSE distribuido con esta fuente.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Secreto de Autenticación JWT
    |--------------------------------------------------------------------------
    |
    | No olvides establecer esto en tu archivo .env, ya que se usará para
    | firmar tus tokens. Hay un comando de ayuda para esto:
    | `php artisan jwt:secret`
    |
    | Nota: Esto se usará solo para algoritmos simétricos (HMAC),
    | ya que RSA y ECDSA usan una combinación de clave pública/privada.
    |
    */

    'secret' => env('JWT_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Claves de Autenticación JWT
    |--------------------------------------------------------------------------
    |
    | El algoritmo que uses determinará si tus tokens están firmados con una
    | cadena aleatoria (definida en `JWT_SECRET`) o con las siguientes claves
    | pública y privada.
    |
    | Algoritmos Simétricos:
    | HS256, HS384 y HS512 usarán `JWT_SECRET`.
    |
    | Algoritmos Asimétricos:
    | RS256, RS384 y RS512 / ES256, ES384 y ES512 usarán las claves a continuación.
    |
    */

    'keys' => [

        /*
        |--------------------------------------------------------------------------
        | Clave Pública
        |--------------------------------------------------------------------------
        |
        | Una ruta o recurso a tu clave pública.
        |
        | Ejemplo: 'file://ruta/a/la/clave/publica'
        |
        */

        'public' => env('JWT_PUBLIC_KEY'),

        /*
        |--------------------------------------------------------------------------
        | Clave Privada
        |--------------------------------------------------------------------------
        |
        | Una ruta o recurso a tu clave privada.
        |
        | Ejemplo: 'file://ruta/a/la/clave/privada'
        |
        */

        'private' => env('JWT_PRIVATE_KEY'),

        /*
        |--------------------------------------------------------------------------
        | Contraseña de la Clave Privada
        |--------------------------------------------------------------------------
        |
        | La contraseña de tu clave privada. Puede ser null si no hay ninguna.
        |
        */

        'passphrase' => env('JWT_PASSPHRASE'),

    ],

    /*
    |--------------------------------------------------------------------------
    | Tiempo de Vida del Token JWT
    |--------------------------------------------------------------------------
    |
    | Especifica la duración (en minutos) que el token será válido.
    | Por defecto es 1 hora.
    |
    | También puedes establecer esto en null para que el token nunca expire.
    | No se recomienda, pero algunas aplicaciones móviles lo usan.
    |
    | Nota: Si estableces esto en null, debes eliminar el elemento 'exp'
    | de la lista 'required_claims'.
    |
    */

    'ttl' => env('JWT_TTL', 5), // Cambiado a 5 minutos solo para prueba

    /*
    |--------------------------------------------------------------------------
    | Tiempo de Vida para Refrescar el Token
    |--------------------------------------------------------------------------
    |
    | Especifica la duración (en minutos) en la que el token puede ser refrescado.
    | Es decir, el usuario puede actualizar su token dentro de este período antes
    | de que tenga que autenticarse nuevamente.
    |
    | Por defecto, es de 2 semanas (20160 minutos).
    |
    */

    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160),

    /*
    |--------------------------------------------------------------------------
    | Algoritmo de Hashing JWT
    |--------------------------------------------------------------------------
    |
    | Especifica el algoritmo de hashing que se utilizará para firmar el token.
    |
    */

    'algo' => env('JWT_ALGO', Tymon\JWTAuth\Providers\JWT\Provider::ALGO_HS256),

    /*
    |--------------------------------------------------------------------------
    | Claims Requeridos
    |--------------------------------------------------------------------------
    |
    | Especifica los claims que deben existir en cada token.
    | Si falta alguno, se lanzará una excepción TokenInvalidException.
    |
    */

    'required_claims' => [
        'iss', // Emisor
        'iat', // Fecha de emisión
        'exp', // Fecha de expiración
        'nbf', // No válido antes de
        'sub', // Usuario autenticado
        'jti', // Identificador único del token
    ],

    /*
    |--------------------------------------------------------------------------
    | Claims Persistentes
    |--------------------------------------------------------------------------
    |
    | Especifica qué claims deben persistir cuando se refresca un token.
    |
    */

    'persistent_claims' => [
        // 'foo',
        // 'bar',
    ],

    /*
    |--------------------------------------------------------------------------
    | Bloquear el Sujeto
    |--------------------------------------------------------------------------
    |
    | Determina si un claim 'prv' se agrega automáticamente al token.
    | Esto evita que múltiples modelos de autenticación compartan el mismo ID.
    |
    */

    'lock_subject' => true,

    /*
    |--------------------------------------------------------------------------
    | Margen de Tolerancia (Leeway)
    |--------------------------------------------------------------------------
    |
    | Permite un margen de tiempo para los claims de tiempo del JWT
    | (`iat`, `nbf`, `exp`) para compensar pequeñas diferencias de reloj.
    |
    | Se especifica en segundos.
    |
    */

    'leeway' => env('JWT_LEEWAY', 0),

    /*
    |--------------------------------------------------------------------------
    | Habilitar Lista Negra
    |--------------------------------------------------------------------------
    |
    | Para invalidar tokens, debes habilitar la lista negra.
    | Si no necesitas esta funcionalidad, establece esto en false.
    |
    */

    'blacklist_enabled' => env('JWT_BLACKLIST_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Período de Gracia para Lista Negra
    |--------------------------------------------------------------------------
    |
    | Evita que las solicitudes paralelas fallen si el token se regenera
    | en cada petición.
    |
    | Se especifica en segundos.
    |
    */

    'blacklist_grace_period' => env('JWT_BLACKLIST_GRACE_PERIOD', 0),

    /*
    |--------------------------------------------------------------------------
    | Proveedores
    |--------------------------------------------------------------------------
    |
    | Especifica los proveedores utilizados en el paquete.
    |
    */

    'providers' => [

        /*
        |--------------------------------------------------------------------------
        | Proveedor JWT
        |--------------------------------------------------------------------------
        |
        | Especifica el proveedor que se usa para crear y decodificar tokens.
        |
        */

        'jwt' => Tymon\JWTAuth\Providers\JWT\Lcobucci::class,

        /*
        |--------------------------------------------------------------------------
        | Proveedor de Autenticación
        |--------------------------------------------------------------------------
        |
        | Especifica el proveedor utilizado para autenticar usuarios.
        |
        */

        'auth' => Tymon\JWTAuth\Providers\Auth\Illuminate::class,

        /*
        |--------------------------------------------------------------------------
        | Proveedor de Almacenamiento
        |--------------------------------------------------------------------------
        |
        | Especifica el proveedor que almacena tokens en la lista negra.
        |
        */

        'storage' => Tymon\JWTAuth\Providers\Storage\Illuminate::class,

    ],

];
