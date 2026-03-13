<?php

namespace App\Http\Requests\Api\V2\Voyage;

use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Voyage\SearchTripsDTO;

class SearchTripsFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'departureCity' => ['nullable', 'integer', 'exists:villes,id'],
            'arrivalCity' => ['nullable', 'integer', 'exists:villes,id'],
            'date' => ['nullable', 'date_format:Y-m-d'],
            'company' => ['nullable', 'integer', 'exists:compagnies,id'],
            'passengers' => ['nullable', 'integer', 'min:1'],
            'vehicleType' => ['nullable', 'string', 'in:bus,train,ferry'],
        ];
    }

    public function toDTO(): SearchTripsDTO
    {
        return SearchTripsDTO::fromRequest($this->validated());
    }
}
