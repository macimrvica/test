<?php declare(strict_types=1);


namespace App\People\Domain\Model;

final class PeopleSearchByNameResultsDTO
{
    private int $count;
    private array $people;

    private function __construct()
    {
        $this->people = [];
    }

    public static function fromArray(array $data): self
    {
        $dto = new static();
        $dto->count = $data['count'];

        foreach ($data['results'] as $result) {
            $dto->people[] = PeopleDTO::fromArray($result);
        }

        return $dto;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function getPeople(): array
    {
        return $this->people;
    }
}
