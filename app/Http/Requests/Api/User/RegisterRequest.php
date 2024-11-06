<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use function Symfony\Component\Translation\t;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string','min:2'],
            'last_name' => ['required', 'string','min:2'],
            'sexe'=> ['required', 'string','min:2'],
            'numero'=> ['required', 'string','min:2','unique:users,numero'],
            'numero_identifiant' => ['required', 'string','min:2'],
            'email' => ['required', 'string','email','unique:users,email'],
            'password' => ['required', 'string','min:2'],
            'profile_photo_path' => ['string'],
            'role'=> ['required', 'string','min:2']
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => true,
            'message' => 'Erreur de validation',
            'error_list'=> $validator->errors(),
        ]));
    }


}
