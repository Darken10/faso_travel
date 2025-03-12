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
use App\Models\Voyage\VoyageInstance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Ticket extends Model
{
    use HasFactory,Notifiable;

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
        'retour_validate_by',
        "transferer_at", "valider_by_id", "valider_at", "transferer_a_user_id",
        "retour_validate_at",
        "voyage_instance_id"
    ];

    protected $with = [
        'user',
        'payements',
        'voyage',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('userCompany', function (Builder $builder) {
            if (Auth::check() && request()->is('compagnie/ticket*')) {
                if (Auth::user()->compagnie_id) {
                    $companyId = Auth::user()->compagnie_id;

                    // Filtrer les tickets dont le voyage est rattaché à la compagnie de l'utilisateur
                    $builder->whereHas('voyage', function ($query) use ($companyId) {
                        $query->where('compagnie_id', $companyId);
                    });
                }
            }
        });
    }

    public function canValider(): bool
    {
        return $this->statut === StatutTicket::Payer;
    }

    protected function casts(): array
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

    function villeDepart(){
        return $this->voyage->trajet->depart;
    }

    function villeArriver(){
        return $this->voyage->trajet->arriver;
    }

    function compagnie():Compagnie{
        return $this->voyage->compagnie;
    }

    function heureDepart(){
        return $this->voyage->heure;
    }

    /**
     * @return Carbon
     */
    function heureArriver():Carbon{
        $temps = $this->voyage->temps;
        return $this->voyage->heure->addHours($temps->hour)
                    ->addMinutes($temps->minute)
                    ->addSeconds($temps->second);
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

    function classe(){
        return $this->voyage->classe;
    }

    function autre_personne(): BelongsTo
    {
        return $this->belongsTo(AutrePersonne::class);
    }

    function trajet()
    {
        return $this->voyage->trajet;
    }

    public function prix(): float
    {
        return $this->voyage->getPrix($this->type);
    }

    public function heureRdv():Carbon
    {
        return $this->voyage->heure->subMinutes(10);
    }

    public function voyageInstance():BelongsTo
    {
        return $this->belongsTo(VoyageInstance::class);
    }

}
