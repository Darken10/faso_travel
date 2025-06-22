<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthService
{
    /**
     * Register a new user
     *
     * @param array $data
     * @return array
     */
    public function register(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    /**
     * Login a user
     *
     * @param array $credentials
     * @return array
     */
    public function login(array $credentials): array
    {
        if (!Auth::attempt($credentials)) {
            throw new \Exception('Email ou mot de passe incorrect');
        }

        $user = User::where('email', $credentials['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    /**
     * Send OTP to user
     *
     * @param string $phoneOrEmail
     * @return bool
     */
    public function sendOtp(string $phoneOrEmail): bool
    {
        // Déterminer si c'est un email ou un téléphone
        $field = filter_var($phoneOrEmail, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        
        // Vérifier si l'utilisateur existe
        $user = User::where($field, $phoneOrEmail)->first();
        
        if (!$user) {
            throw new \Exception('Aucun compte trouvé avec ces informations');
        }
        
        // Générer un code OTP (6 chiffres)
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Stocker l'OTP (dans une table ou cache)
        // Dans un cas réel, on utiliserait une table dédiée ou Redis
        // Pour cet exemple, on utilise le cache
        Cache::put("otp_{$phoneOrEmail}", $otp, now()->addMinutes(15));
        
        // Envoyer l'OTP (par email ou SMS selon le cas)
        // Implémentation à adapter selon les services disponibles
        
        return true;
    }

    /**
     * Verify OTP
     *
     * @param string $phoneOrEmail
     * @param string $otp
     * @return bool
     */
    public function verifyOtp(string $phoneOrEmail, string $otp): bool
    {
        $storedOtp = Cache::get("otp_{$phoneOrEmail}");
        
        if (!$storedOtp || $storedOtp !== $otp) {
            return false;
        }
        
        // Supprimer l'OTP après vérification
        Cache::forget("otp_{$phoneOrEmail}");
        
        return true;
    }

    /**
     * Send password reset link
     *
     * @param string $email
     * @return bool
     */
    public function sendPasswordResetLink(string $email): bool
    {
        $status = Password::sendResetLink(['email' => $email]);
        
        return $status === Password::RESET_LINK_SENT;
    }

    /**
     * Reset password
     *
     * @param string $token
     * @param string $password
     * @param string $email
     * @return bool
     */
    public function resetPassword(string $token, string $password, string $email): bool
    {
        $status = Password::reset(
            [
                'email' => $email,
                'password' => $password,
                'password_confirmation' => $password,
                'token' => $token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                
                $user->save();
                
                event(new PasswordReset($user));
            }
        );
        
        return $status === Password::PASSWORD_RESET;
    }
}
