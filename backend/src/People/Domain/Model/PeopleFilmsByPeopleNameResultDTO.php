<?php declare(strict_types=1);


namespace App\People\Domain\Model;

final class PeopleFilmsByPeopleNameResultDTO
{
    private array $films;

    private function __construct()
    {
        $this->films = [];
    }

    public static function fromArray(array $films): self
    {
        $dto = new static();

        $dto->films = $films;

        return $dto;
    }

    public function getFilms(): array
    {
        return $this->films;
    }
}
