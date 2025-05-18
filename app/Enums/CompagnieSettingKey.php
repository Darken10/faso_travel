<?php

namespace App\Enums;

enum CompagnieSettingKey : string
{

    case PAIEMENT_EN_LIGNE = 'paiement_en_ligne';
    case QR_CODE_OBLIGATOIRE = 'qr_code_obligatoire';
    case PIECE_IDENTITE_OBLIGATOIRE = 'piece_identite_obligatoire';
    case DELAI_ANNULATION = 'delai_annulation';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');

    }

}
