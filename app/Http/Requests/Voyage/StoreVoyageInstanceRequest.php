<?php

namespace App\Http\Requests\Voyage;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoyageInstanceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "voyage_id" => ["required", "exists:voyages"],
            "care_id" => ["nullable", "integer"],
            "date" => ["required", "date"],
            "heure" => ["required", "date"],
            "nb_place" => ["required", "integer","min:1"],
            "chauffer_id" => ["nullable", "integer","exists:chauffers,id"],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
