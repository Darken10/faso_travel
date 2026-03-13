<?php

namespace App\Http\Requests\Api\V2\Ticket;

use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Ticket\CreateTicketDTO;

class CreateTicketFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'voyage_instance_id' => ['required', 'exists:voyage_instances,id'],
            'type' => ['sometimes', 'string'],
            'autre_personne' => ['sometimes', 'boolean'],
            'nom_autre_personne' => ['required_if:autre_personne,true', 'string', 'max:255'],
            'prenom_autre_personne' => ['required_if:autre_personne,true', 'string', 'max:255'],
            'telephone_autre_personne' => ['required_if:autre_personne,true', 'string', 'max:20'],
        ];
    }

    public function toDTO(): CreateTicketDTO
    {
        return CreateTicketDTO::fromRequest($this->validated());
    }
}
