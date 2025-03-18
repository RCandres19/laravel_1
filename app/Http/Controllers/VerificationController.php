<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    /**
     * Handle the incoming email verification request.
     *
     * @param  Request  $request
     * @param  int  $id
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        // Verificar que el hash coincida
        if (hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            if ($user->hasVerifiedEmail()) {
                return redirect()->route('home'); // O a alguna página específica si ya está verificado
            }

            $user->markEmailAsVerified();

            event(new Verified($user));

            // Redirigir a una página después de la verificación
            return redirect()->route('home');
        }

        return redirect()->route('verification.notice')->withErrors(['email' => 'Este enlace de verificación es inválido.']);
    }
}
