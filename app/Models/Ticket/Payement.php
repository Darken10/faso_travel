<?php

namespace App\Models\Ticket;

use App\Enums\MoyenPayment;
use App\Enums\StatutPayement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 
 *
 * @property int $id
 * @property int|null $ticket_id
 * @property int|null $numero_payment
 * @property int $montant
 * @property string|null $trans_id
 * @property string|null $token
 * @property int|null $code_otp
 * @property StatutPayement $statut
 * @property MoyenPayment $moyen_payment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Ticket\Ticket|null $ticket
 * @method static \Illuminate\Database\Eloquent\Builder|Payement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereCodeOtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereMontant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereMoyenPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereNumeroPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereTicketId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereTransId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
