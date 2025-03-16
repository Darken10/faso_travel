<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'a_bagage' =>['nullable'],
            'bagages' =>['nullable','json'],
            'voyage_instance_choise' =>['required','exists:voyage_instances,id'],
            'type' => ['required'],
            'accepter'=>['required'],
            'autre_personne_id'=>['nullable'],
            'numero_chaise'=>['required'],
        ];
    }
}
