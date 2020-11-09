<?php declare(strict_types=1);


namespace App\People\Domain\Model;

final class PeopleDTO
{
    private string $name;
    private string $height;
    private string $mass;
    private string $gender;
    private array $filmUrls;
    private array $starshipUrls;

    private function __construct()
    {
        $this->filmUrls = [];
        $this->starshipUrls = [];
    }

    public static function fromArray(array $data): self
    {
        $dto = new static();

        $dto->name = $data['name'];
        $dto->height = $data['height'];
        $dto->mass = $data['mass'];
        $dto->gender = $data['gender'];

        foreach ($data['films'] as $filmUrl) {
            $dto->filmUrls[] = $filmUrl;
        }

        foreach ($data['starships'] as $starshipUrl) {
            $dto->starshipUrls[] = $starshipUrl;
        }

        return $dto;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function getMass(): string
    {
        return $this->mass;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getFilmUrls(): array
    {
        return $this->filmUrls;
    }

    public function getStarshipUrls(): array
    {
        return $this->starshipUrls;
    }
}
