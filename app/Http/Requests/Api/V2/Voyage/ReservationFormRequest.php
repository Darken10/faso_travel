<?php

namespace App\Http\Requests\Api\V2\Voyage;

use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Voyage\ReservationDTO;

class ReservationFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'seats' => ['required', 'string'],
            'totalPrice' => ['required', 'numeric', 'min:0'],
            'isForSelf' => ['required', 'boolean'],
            'tripType' => ['required', 'in:one-way,round-trip'],

            'passenger.first_name' => ['required_if:isForSelf,false', 'string', 'max:255'],
            'passenger.last_name' => ['required_if:isForSelf,false', 'string', 'max:255'],
            'passenger.email' => ['required_if:isForSelf,false', 'string', 'max:255'],
            'passenger.sexe' => ['required_if:isForSelf,false', 'string', 'max:255'],
            'passenger.numero' => ['required_if:isForSelf,false', 'string', 'max:255'],
            'passenger.numero_identifiant' => ['required_if:isForSelf,false', 'string', 'max:255'],
            'passenger.lien_relation' => ['required_if:isForSelf,false', 'string', 'max:255'],

            'a_bagage' => ['nullable', 'boolean'],
            'bagages_data' => ['nullable', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'seats.required' => 'Les places sont obligatoires.',
            'totalPrice.required' => 'Le prix total est obligatoire.',
            'isForSelf.required' => 'Veuillez indiquer si le ticket est pour vous.',
            'tripType.required' => 'Le type de voyage est obligatoire.',
            'tripType.in' => 'Le type de voyage doit être "one-way" ou "round-trip".',
        ];
    }

    public function toDTO(): ReservationDTO
    {
        return ReservationDTO::fromRequest($this->validated());
    }
}
