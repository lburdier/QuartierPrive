<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Où rediriger les utilisateurs après la réinitialisation du mot de passe.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Affiche le formulaire pour réinitialiser le mot de passe.
     *
     * @param string|null $token
     * @return \Illuminate\View\View
     */
    public function showResetForm($token = null)
    {
        return view('auth.passwords.reset')->with(['token' => $token]);
    }
}
