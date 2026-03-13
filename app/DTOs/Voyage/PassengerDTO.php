<?php

namespace App\DTOs\Voyage;

use App\Enums\SexeUser;
use App\Enums\LienRelationAutrePersonneTicket;

readonly class PassengerDTO
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public ?string $email = null,
        public ?SexeUser $sexe = null,
        public ?string $numero = null,
        public ?string $numero_identifiant = null,
        public ?LienRelationAutrePersonneTicket $lien_relation = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            first_name: $data['first_name'],
            last_name: $data['last_name'],
            email: $data['email'] ?? null,
            sexe: isset($data['sexe']) ? SexeUser::tryFrom($data['sexe']) : null,
            numero: $data['numero'] ?? null,
            numero_identifiant: $data['numero_identifiant'] ?? null,
            lien_relation: isset($data['lien_relation']) ? LienRelationAutrePersonneTicket::tryFrom($data['lien_relation']) : null,
        );
    }

    public function fullName(): string
    {
        return strtoupper($this->first_name) . ' ' . $this->last_name;
    }
}
