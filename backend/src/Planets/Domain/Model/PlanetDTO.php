<?php declare(strict_types=1);


namespace App\Planets\Domain\Model;

class PlanetDTO
{
    private string $name;
    private string $rotationPeriod;
    private string $orbitalPeriod;
    private string $diameter;
    private string $climate;
    private string $gravity;
    private string $terrain;
    private string $surfaceWater;
    private string $population;
    private string $created;
    private string $url;

    public static function fromArray(array $data): self
    {
        $dto = new static();

        $dto->name = $data['name'];
        $dto->rotationPeriod = $data['rotation_period'];
        $dto->orbitalPeriod = $data['orbital_period'];
        $dto->diameter = $data['diameter'];
        $dto->climate = $data['climate'];
        $dto->gravity = $data['gravity'];
        $dto->terrain = $data['terrain'];
        $dto->surfaceWater = $data['surface_water'];
        $dto->population = $data['population'];
        $dto->created = $data['created'];
        $dto->url = $data['url'];

        return $dto;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRotationPeriod(): string
    {
        return $this->rotationPeriod;
    }

    public function getOrbitalPeriod(): string
    {
        return $this->orbitalPeriod;
    }

    public function getDiameter(): string
    {
        return $this->diameter;
    }

    public function getClimate(): string
    {
        return $this->climate;
    }

    public function getGravity(): string
    {
        return $this->gravity;
    }

    public function getTerrain(): string
    {
        return $this->terrain;
    }

    public function getSurfaceWater(): string
    {
        return $this->surfaceWater;
    }

    public function getPopulation(): string
    {
        return $this->population;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
