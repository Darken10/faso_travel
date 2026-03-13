<?php

namespace App\Http\Requests\Api\V2\Ticket;

use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Ticket\TransferTicketDTO;

class TransferTicketFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:20'],
        ];
    }

    public function toDTO(): TransferTicketDTO
    {
        return TransferTicketDTO::fromRequest($this->validated());
    }
}
