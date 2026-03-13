<?php

namespace App\DTOs\Ticket;

use App\Enums\TypeTicket;

readonly class CreateTicketDTO
{
    public function __construct(
        public string $voyage_instance_id,
        public ?TypeTicket $type = null,
        public bool $autre_personne = false,
        public ?string $nom_autre_personne = null,
        public ?string $prenom_autre_personne = null,
        public ?string $telephone_autre_personne = null,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            voyage_instance_id: $validated['voyage_instance_id'],
            type: isset($validated['type']) ? TypeTicket::tryFrom($validated['type']) : null,
            autre_personne: $validated['autre_personne'] ?? false,
            nom_autre_personne: $validated['nom_autre_personne'] ?? null,
            prenom_autre_personne: $validated['prenom_autre_personne'] ?? null,
            telephone_autre_personne: $validated['telephone_autre_personne'] ?? null,
        );
    }
}
