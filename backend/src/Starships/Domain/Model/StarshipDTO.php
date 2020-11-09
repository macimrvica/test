<?php declare(strict_types=1);


namespace App\Starships\Domain\Model;

final class StarshipDTO
{
    private string $id;
    private string $name;
    private string $model;
    private string $manufacturer;
    private string $costInCredits;
    private string $maxAtmosphericSpeed;
    private string $crew;
    private int $passengers;
    private string $starshipClass;
    private string $url;

    public static function fromArray(array $data): self
    {
        $dto = new static();

        $dto->id = md5($data['url']);
        $dto->name = $data['name'];
        $dto->model = $data['model'];
        $dto->manufacturer = $data['manufacturer'];
        $dto->costInCredits = $data['cost_in_credits'];
        $dto->maxAtmosphericSpeed = $data['max_atmosphering_speed'];
        $dto->crew = $data['crew'];
        $dto->passengers = (int)$data['passengers'];
        $dto->starshipClass = $data['starship_class'];
        $dto->url = $data['url'];

        return $dto;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function getCostInCredits(): string
    {
        return $this->costInCredits;
    }

    public function getMaxAtmosphericSpeed(): string
    {
        return $this->maxAtmosphericSpeed;
    }

    public function getCrew(): string
    {
        return $this->crew;
    }

    public function getPassengers(): int
    {
        return $this->passengers;
    }

    public function getStarshipClass(): string
    {
        return $this->starshipClass;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
