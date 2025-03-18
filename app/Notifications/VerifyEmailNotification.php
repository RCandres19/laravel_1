<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends Notification
{
    /**
     * El canal por el cual debe ser entregada la notificación.
     *
     * @var array
     */
    public $channels = ['mail'];

    /**
     * Crea una nueva notificación de verificación de correo.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct()
    {
        // Aquí puedes hacer cualquier inicialización si es necesario
    }

    /**
     * Enviar la notificación por correo.
     *
     * @param  \Illuminate\Notifications\Messages\MailMessage  $mailMessage
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($user)
    {
        return (new MailMessage)
                    ->subject('Verificación de correo electrónico')
                    ->line('Por favor, haz clic en el enlace siguiente para verificar tu dirección de correo electrónico.')
                    ->action('Verificar correo', url(route('verification.notice')))
                    ->line('Gracias por usar nuestra aplicación.');
    }
}

