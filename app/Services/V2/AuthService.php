<?php

namespace App\Services\V2;

use Carbon\Carbon;
use App\Models\User;
use App\Enums\SexeUser;
use App\Enums\UserRole;
use Illuminate\Support\Str;
use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\DTOs\Auth\VerifyOtpDTO;
use App\DTOs\Auth\ResetPasswordDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Exceptions\AuthenticationException;

class AuthService
{
    public function register(RegisterDTO $dto): array
    {
        $user = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'first_name' => $dto->first_name ?? $dto->name,
            'last_name' => $dto->last_name ?? '',
            'sexe' => $dto->sexe ?? SexeUser::Homme,
            'numero' => $dto->numero,
            'numero_identifiant' => $dto->numero_identifiant ?? '+226',
            'role' => $dto->role ?? UserRole::User,
            'compagnie_id' => $dto->compagnie_id,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(LoginDTO $dto): array
    {
        if (!Auth::attempt(['email' => $dto->email, 'password' => $dto->password])) {
            throw AuthenticationException::invalidCredentials();
        }

        $user = User::where('email', $dto->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * Logout user (revoke token)
     *
     * @return bool
     */
    public function logout(): bool
    {
        // Utilisation de request()->user() au lieu de Auth::user() pour accéder à l'utilisateur authentifié par token
        if (request()->user()) {
            request()->user()->tokens()->delete();
        }
        return true;
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
        
        // Stocker l'OTP en cache pour une durée limitée (10 minutes)
        Cache::put('otp_' . $user->id, $otp, Carbon::now()->addMinutes(10));
        
        // Envoyer l'OTP (par email ou SMS selon le cas)
        // Implémentation à adapter selon les services disponibles
        
        return true;
    }

    public function verifyOtp(VerifyOtpDTO $dto): bool
    {
        $storedOtp = Cache::get("otp_{$dto->phone_or_email}");

        if (!$storedOtp || $storedOtp !== $dto->otp) {
            return false;
        }

        Cache::forget("otp_{$dto->phone_or_email}");

        return true;
    }

    /**
     * Send password reset link
     *
     * @param string $email
     * @return bool
     */
    public function forgotPassword(string $email): bool
    {
        $status = Password::sendResetLink(['email' => $email]);
        
        return $status === Password::RESET_LINK_SENT;
    }

    public function resetPassword(ResetPasswordDTO $dto): bool
    {
        $status = Password::reset(
            [
                'email' => $dto->email,
                'password' => $dto->password,
                'password_confirmation' => $dto->password,
                'token' => $dto->token,
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
