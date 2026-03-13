<?php

namespace App\DTOs\Article;

readonly class ArticleFiltersDTO
{
    public function __construct(
        public int $perPage = 15,
        public ?int $category_id = null,
        public ?string $search = null,
    ) {}

    public static function fromRequest(array $query): self
    {
        return new self(
            perPage: (int) ($query['per_page'] ?? 15),
            category_id: isset($query['category_id']) ? (int) $query['category_id'] : null,
            search: $query['search'] ?? null,
        );
    }
}
