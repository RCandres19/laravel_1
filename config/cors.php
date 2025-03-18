<?php

return [

    /*
    |--------------------------------------------------------------------------
    |  Configuración de CORS (Cross-Origin Resource Sharing)
    |--------------------------------------------------------------------------
    |
    | Este archivo define las reglas de seguridad para el intercambio de recursos
    | entre distintos dominios. Es crucial para permitir peticiones API desde
    | el frontend (Vue.js) hacia el backend (Laravel).
    |
    |  IMPORTANTE: En producción, se recomienda restringir los dominios y métodos
    | permitidos para mayor seguridad.
    |
    |   Recomendaciones para producción
    |        Restringe los dominios en allowed_origins para evitar accesos no deseados.
    |        Limita los métodos HTTP a los que realmente necesitas.
    |        Define solo los encabezados necesarios en allowed_headers.
    |  
    |    Esta configuración de CORS garantiza que tu API pueda ser consumida de forma segura desde el frontend. 
    |
    */

    //  Rutas protegidas por CORS (afecta la API)
    'paths' => ['api/*'], // Eliminamos 'sanctum/csrf-cookie' ya que usamos JWT

    //  Métodos HTTP permitidos (En producción, puedes limitarlo a ['GET', 'POST', 'PUT', 'DELETE'])
    'allowed_methods' => ['*'], // Permite todos los métodos HTTP

    //  Dominios permitidos para hacer peticiones a la API
    //  En producción, reemplaza '*' por el dominio específico del frontend
    'allowed_origins' => ['*'], // Permite cualquier origen (poco seguro en producción)

    //  Permite definir patrones de dominios con expresiones regulares
    'allowed_origins_patterns' => [],

    //  Encabezados HTTP permitidos en las peticiones
    'allowed_headers' => ['*'], // Permite cualquier encabezado

    //  Permite enviar cookies o tokens de autenticación en las solicitudes CORS
    'supports_credentials' => true,

];
