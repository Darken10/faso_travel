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

/**
 *
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $voyage_id
 * @property bool|null $a_bagage
 * @property string|null $bagages_data
 * @property \Illuminate\Support\Carbon $date
 * @property TypeTicket $type
 * @property StatutTicket $statut
 * @property string $numero_ticket
 * @property int|null $numero_chaise
 * @property string $code_sms
 * @property string $code_qr
 * @property string|null $image_uri
 * @property string|null $pdf_uri
 * @property string|null $code_qr_uri
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_my_ticket
 * @property int|null $autre_personne_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket\Payement> $payements
 * @property-read int|null $payements_count
 * @property-read User|null $user
 * @property-read Voyage|null $voyage
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereABagage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereAutrePersonneId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereBagagesData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCodeQr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCodeQrUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCodeSms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereImageUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereIsMyTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereNumeroChaise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereNumeroTicket($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePdfUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereVoyageId($value)
 * @mixin \Eloquent
 */
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
        'is_my_ticket',
        'autre_personne_id',
    ];

    protected $with = [
        'user',
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
        return $this->voyage->compagnie;
    }

    function heureDepart(){
        return $this->voyage->heure;
    }

    function heureArriver(){
        #TODO: je doit calculer la date d'arriver

        return 'a calculer';
    }

    function gareDepart():Gare{
        return $this->voyage->gareDepart;
    }

    function gareArriver():Gare{
        return $this->voyage->gareArriver;
    }

    function conforts(){
        return $this->voyage->conforts;
    }

    function autre_personne()
    {
        return $this->belongsTo(AutrePersonne::class);
    }

}
