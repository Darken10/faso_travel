<?php

namespace App\Features;

use App\Models\Compagnie\Compagnie;

class CompagnieRulesService
{

    public function __construct(protected Compagnie $compagnie) {}

    public function paiementEnLigneObligatoire(): bool
    {
        return $this->compagnie->getSetting('paiement_en_ligne') === 'true';
    }

    public function delaiAnnulation(): int
    {
        return (int) $this->compagnie->getSetting('delai_annulation', 0);
    }
}
