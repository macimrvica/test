<?php declare(strict_types=1);


namespace App\Films\Application;

use App\Films\Domain\Model\FilmDTO;

interface FilmsGatewayInterface
{
    public function getAll(): array;
    public function getByUrl(string $url): FilmDTO;
}
