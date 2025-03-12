<?php


namespace App\DTOs;
readonly class VoyageInstanceRequestDTO
{
    public function __construct(
        public int $voyage_id,
        public string $date,
        public int $care_id,
        public string $heure,
        public int $nb_place,
        public int $chauffer_id
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            voyage_id: $data['voyage_id'],
            date: $data['date'],
            care_id: $data['care_id'],
            heure: $data['heure'],
            nb_place: $data['nb_place'],
            chauffer_id: $data['chauffer_id']
        );
    }

    public function toArray(): array
    {
        return [
            'voyage_id' => $this->voyage_id,
            'date' => $this->date,
            'care_id' => $this->care_id,
            'heure' => $this->heure,
            'nb_place' => $this->nb_place,
            'chauffer_id' => $this->chauffer_id,
        ];
    }

}
