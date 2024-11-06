<?php

namespace App\Helper;

use App\Enums\StatutPayement;
use App\Enums\StatutTicket;
use App\Models\Compagnie\Gare;
use App\Models\Post\Post;
use App\Models\Ticket\Payement;
use App\Models\Ticket\Ticket;
use App\Models\Voyage\Voyage;
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

    public static function AllTicketOfMyCompagnie(?StatutTicket $statutTicket=null): Ticket|\Illuminate\Database\Eloquent\Builder|Builder
    {
        if ($statutTicket !== null ){
            return Ticket::whereStatut($statutTicket)->whereIn('voyage_id',self::AllVoyagesOfMyCompagnie()->get()->pluck(['id'])->toArray());
        }
        return Ticket::whereIn('voyage_id',self::AllVoyagesOfMyCompagnie()->get()->pluck(['id'])->toArray());

    }

    public static function AllPaymentsOfMyCompagnie(?StatutPayement $statutPayement=StatutPayement::Complete,?StatutTicket $statutTicket=null): \Illuminate\Database\Eloquent\Builder|Payement|Builder
    {
        return Payement::whereStatut($statutPayement)->whereIn('ticket_id',self::AllTicketOfMyCompagnie($statutTicket)->get()->pluck(['id'])->toArray());
    }

}
