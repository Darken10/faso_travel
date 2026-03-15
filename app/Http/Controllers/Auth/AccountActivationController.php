<?php

namespace App\Http\Controllers\Auth;

use App\Models\AccountActivation;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AccountActivationController extends Controller
{
    public function show(string $token)
    {
        $activation = AccountActivation::where('token', $token)->first();

        if (!$activation) {
            return redirect()->route('login')->with('error', 'Lien d\'activation invalide.');
        }

        if ($activation->isUsed()) {
            return redirect()->route('login')->with('error', 'Ce compte a déjà été activé.');
        }

        if ($activation->isExpired()) {
            return redirect()->route('login')->with('error', 'Ce lien d\'activation a expiré. Contactez votre administrateur pour en obtenir un nouveau.');
        }

        $user = $activation->user;

        return view('auth.activate-account', [
            'token' => $token,
            'user' => $user,
            'companyName' => $user->compagnie?->name ?? 'Votre entreprise',
        ]);
    }

    public function activate(Request $request, string $token)
    {
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $activation = AccountActivation::where('token', $token)->first();

        if (!$activation || !$activation->isValid()) {
            return redirect()->route('login')->with('error', 'Lien d\'activation invalide ou expiré.');
        }

        $user = $activation->user;
        $user->password = Hash::make($validated['password']);
        $user->email_verified_at = now();
        $user->statut = \App\Enums\StatutUser::Active;
        $user->save();

        $activation->update(['used_at' => now()]);

        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Votre compte a été activé avec succès !');
    }
}
