<?php

namespace App\Models\Ticket;

use App\Models\User;
use App\Enums\TypeTicket;
use App\Enums\StatutTicket;
use App\Models\Compagnie\Compagnie;
use App\Models\Compagnie\Gare;
use App\Models\Ville\Ville;
use App\Models\Voyage\Confort;
use App\Models\Voyage\Voyage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'voyage_id',
        "a_bagage",
        "bagages_data",
        'date',
        'type',
        'statut',
        'numero_ticket',
        'numero_chaise',
        'code_sms',
        'code_qr',
        'image_uri',
        'pdf_uri',
        'code_qr_uri',
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

    function payements():HasMany
    {
        return $this->hasMany(Payement::class);
    }

    function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function voyage():BelongsTo{
        return $this->belongsTo(Voyage::class);
    }

    #----------------------------------------------------------------

    function villeDepart():Ville{
        return $this->voyage->trajet->depart;
    }

    function villeArriver():Ville{
        return $this->voyage->trajet->arriver;
    }

    function compagnie():Compagnie{
        return $this->voyage->commpagnie;
    }

    function heureDepart(){
        return $this->voyage->heure;
    }

    function heureArriver(){
        #TODO: je doit calculer la date d'arriver

        return 'a calculer';
    }

    function gareDepart():Gare{
        return $this->voyage->depart;
    }

    function gareArriver():Gare{
        return $this->voyage->arrive;
    }

    function conforts(){
        return $this->voyage->conforts;
    }


}
