<?php

namespace App\Models;

use App\Models\Compagnie\Compagnie;
use Illuminate\Database\Eloquent\Model;

class CompagnieSetting extends Model
{
    protected $fillable = ['compagnie_id', 'key', 'value'];

    public function compagnie(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Compagnie::class);
    }

    public function getCastedValue(): mixed
    {
        return match ($this->key) {
            'paiement_en_ligne', 'piece_identite_obligatoire', 'qr_code_obligatoire' => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
            'delai_annulation' => (int) $this->value,
            default => $this->value,
        };
    }



}
