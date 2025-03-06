<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo User que representa la tabla 'users' en la base de datos.
 */
class User extends Model {
    use HasFactory; // Permite el uso de fábricas para generar datos de prueba.

    /**
     * @var array $fillable
     * Define los campos que pueden ser asignados masivamente con métodos como create() o update().
     * Esto protege contra ataques de asignación masiva.
     */
    protected $fillable = ['name', 'type_document', 'document', 'email'];

    /**
     * @var bool $timestamps
     * Laravel, por defecto, gestiona automáticamente los campos 'created_at' y 'updated_at'.
     * Si la tabla 'users' no tiene estos campos, es necesario desactivar esta funcionalidad.
     */
    // public $timestamps = false; // Cambia a 'true' si la tabla tiene timestamps.
}
