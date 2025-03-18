<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Handle the incoming request to verify the user's email.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home'); // Redirige a una página de inicio si el correo ya está verificado
        }

        $user->sendEmailVerificationNotification(); // Enviar correo de verificación nuevamente

        return redirect()->route('verification.notice');
    }
}
