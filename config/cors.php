<?php

return [
    // Rutas protegidas por CORS (afecta la API y la autenticación con Sanctum)
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Métodos HTTP permitidos (en producción puedes limitarlo a ['GET', 'POST', 'PUT', 'DELETE'])
    'allowed_methods' => ['*'],

    // Dominios permitidos (en producción, reemplaza '*' por tu dominio)
    'allowed_origins' => ['*'],

    // Permite definir patrones de dominios (se deja vacío si no es necesario)
    'allowed_origins_patterns' => [],

    // Encabezados HTTP permitidos (en producción, puedes restringirlos)
    'allowed_headers' => ['*'],

    // Permite el uso de credenciales como cookies o tokens de sesión
    'supports_credentials' => true,
];
