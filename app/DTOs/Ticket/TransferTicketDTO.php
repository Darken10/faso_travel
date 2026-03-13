<?php

namespace App\DTOs\Ticket;

readonly class TransferTicketDTO
{
    public function __construct(
        public string $nom,
        public string $prenom,
        public string $telephone,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            nom: $validated['nom'],
            prenom: $validated['prenom'],
            telephone: $validated['telephone'],
        );
    }
}
