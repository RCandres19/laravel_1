<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Notifications\VerifyEmailNotification;



class User extends Authenticatable implements JWTSubject, MustVerifyEmail //  Implementar MustVerifyEmail
{
    use HasFactory, CanResetPassword, Notifiable; //  Agregar el trait

    protected $fillable = ['name', 'type_document', 'document', 'email', 'password', 'role']; //  Agregar role y password

    protected $hidden = ['password', 'remember_token']; //  Ocultar contraseña y remember_token

    // Métodos requeridos por JWTSubject
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Método para verificar si el usuario es administrador
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    // Métodos relacionados con la verificación de correo electrónico
    public function sendEmailVerificationNotification()
    {
        // Método que puedes personalizar para enviar un correo de verificación
        $this->notify(new VerifyEmailNotification());
    }
}
