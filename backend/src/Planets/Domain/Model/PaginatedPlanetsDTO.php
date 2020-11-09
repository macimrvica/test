<?php


namespace App\Planets\Domain\Model;

class PaginatedPlanetsDTO
{
    private ?string $next;
    private array $planets;

    private function __construct()
    {
        $this->planets = [];
    }

    public static function fromArray(array $data): self
    {
        $dto = new static();

        $dto->next= $data['next'] ?? null;
        $dto->planets = $data['results'];

        return $dto;
    }

    public function getNext(): ?string
    {
        return $this->next;
    }

    public function hasNext(): bool
    {
        return $this->next !== null;
    }

    public function getPlanets(): array
    {
        return $this->planets;
    }
}
