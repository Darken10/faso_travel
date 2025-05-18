<?php

namespace App\Helper;

use App\Enums\StatutPayement;
use App\Enums\StatutTicket;
use App\Models\Compagnie\Gare;
use App\Models\Post\Post;
use App\Models\Ticket\Payement;
use App\Models\Ticket\Ticket;
use App\Models\Voyage\Voyage;
use App\Models\Voyage\VoyageInstance;
use Eloquent;
use Illuminate\Database\Query\Builder;

class QueryHelpers
{
    public static function AllUsersOfMyCompagnie()
    {
        return auth()->user()->compagnie->users();
    }

    public static function AllPostsOfMyCompagnie()
    {
        return Post::whereIn('user_id',self::AllUsersOfMyCompagnie()->get()->pluck(['id'])->toArray());
    }

    public static function AllGaresOfMyCompagnie()
    {
        return Gare::whereIn('user_id',self::AllUsersOfMyCompagnie()->get()->pluck(['id'])->toArray());
    }

    public static function AllVoyagesOfMyCompagnie(): \Illuminate\Database\Eloquent\Builder|Voyage
    {
        return Voyage::whereBelongsTo(auth()->user()->compagnie);

    }

    public static function AllVoyagesInstanceOfMyCompagnie(): \Illuminate\Database\Eloquent\Builder|VoyageInstance
    {

        $voyages = Voyage::whereBelongsTo(auth()->user()->compagnie)->get()->pluck(['id'])->toArray();
        return VoyageInstance::whereIn('voyage_id',$voyages);

    }

    public static function AllTicketOfMyCompagnie(?StatutTicket $statutTicket=null): \Illuminate\Database\Eloquent\Collection|Ticket|\Illuminate\Database\Eloquent\Builder|\LaravelIdea\Helper\App\Models\Ticket\_IH_Ticket_QB|Builder
    {
        if ($statutTicket !== null ){
            /*return Ticket::whereStatut($statutTicket)->whereHas("voyageInstance.voyage",function (Builder $query) {
                return $query->whereCompagnieId(auth()->user()->compagnie->id);
            })->get();*/
            return Ticket::whereStatut($statutTicket)->whereIn('voyage_instance_id',self::AllVoyagesInstanceOfMyCompagnie()->get()->pluck(['id'])->toArray());
        }
        return Ticket::whereIn('voyage_instance_id',self::AllVoyagesInstanceOfMyCompagnie()->get()->pluck(['id'])->toArray());

    }

    public static function AllPaymentsOfMyCompagnie(?StatutPayement $statutPayement=StatutPayement::Complete,?StatutTicket $statutTicket=null): \Illuminate\Database\Eloquent\Builder|Payement|Builder
    {
        return Payement::whereStatut($statutPayement)->whereIn('ticket_id',self::AllTicketOfMyCompagnie($statutTicket)->get()->pluck(['id'])->toArray());
    }

}
