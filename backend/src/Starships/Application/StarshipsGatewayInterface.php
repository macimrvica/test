<?php declare(strict_types=1);


namespace App\Starships\Application;

use App\Starships\Domain\Model\StarshipDTO;

interface StarshipsGatewayInterface
{
    public function getByUrl(string $url): StarshipDTO;
}
