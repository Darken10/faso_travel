<?php

namespace App\Enums;

enum TypeNotification: string
{
    case CreationPost = 'Createion Post';
    case PayerTicket = 'Payer Ticket';
    case UpdateTicket = 'Update Ticket';
    case TransactionTicket = 'Transaction Ticket';
    case RecevoirTicket = 'Recevoir Ticket';

}
