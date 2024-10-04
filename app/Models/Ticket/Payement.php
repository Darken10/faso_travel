<?php

namespace App\Models\Ticket;

use App\Enums\MoyenPayment;
use App\Enums\StatutPayement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payement extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'numero_payment',
        'montant',
        "trans_id",
        "token",
        'code_otp',
        'statut',
        'moyen_payment',
    ];

    protected $casts = [
        'statut'=> StatutPayement::class,
        'moyen_payment' => MoyenPayment::class,
    ];

    function ticket():BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
