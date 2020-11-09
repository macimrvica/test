<?php declare(strict_types=1);


namespace App\People\Application;

interface PeopleStarshipsGatewayInterface
{
    public function getPeopleStarshipsWithPassengerCountAbove(int $count);
}
