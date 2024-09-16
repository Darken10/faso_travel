<?php

namespace App\Models\Ticket;

use App\Models\User;
use App\Enums\TypeTicket;
use App\Enums\StatutTicket;
use App\Models\Voyage\Voyage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'voyage_id',
        'a_bagage',
        'bagages',
        'date',
        'type',
        'statut',
        'code_ticket',
        'code_qr',
        'ticket_image',
        'ticket_pdf',
    ];


    protected function casts()
    {
        return [
            'type'=> TypeTicket::class,
            'a_bagage'=> 'boolean',
            'date'=> 'date',
            'bagages'=> 'array',
            'statut'=>StatutTicket::class,
        ];
    }

    function payement():HasMany
    {
        return $this->hasMany(Payement::class);
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function voyage():BelongsTo{
        return $this->belongsTo(Voyage::class);
    }
}
