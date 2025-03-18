<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 *  Migración para la tabla `users`
 *
 * Esta migración crea la tabla `users` con los campos necesarios para almacenar la información
 * de los usuarios en la base de datos.
 */
return new class extends Migration {
    /**
     *  Método `up()`
     * 
     * Se ejecuta al aplicar la migración (`php artisan migrate`).
     * Crea la tabla `users` con las siguientes columnas:
     *
     *  `id`: Identificador único (autoincremental).
     *  `name`: Nombre del usuario.
     *  `type_document`: Tipo de documento de identidad (CC, TI, Pasaporte, etc.).
     *  `document`: Número de documento (único para cada usuario).
     *  `email`: Correo electrónico (opcional).
     *  `password`: Contraseña (para autenticación).
     *  `email_verified_at`: Fecha y hora de verificación del correo.
     *  `timestamps`: Registra automáticamente `created_at` y `updated_at`.
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental
            $table->string('name'); // Nombre del usuario
            $table->string('type_document'); // Tipo de documento
            $table->string('document')->unique(); // Documento único
            $table->string('email')->nullable(); // Email opcional
            $table->string('password'); // Contraseña del usuario
            $table->timestamp('email_verified_at')->nullable(); // Fecha y hora de verificación de correo electrónico
            $table->timestamps(); // `created_at` y `updated_at`
        });
    }

    /**
     *  Método `down()`
     * 
     * Se ejecuta al revertir la migración (`php artisan migrate:rollback`).
     * Elimina la tabla `users` si existe.
     */
    public function down() {
        Schema::dropIfExists('users');
    }
};
