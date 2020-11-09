<?php declare(strict_types=1);


namespace App\People\Application;

interface PeopleGatewayInterface
{
    public function getByName(string $name);
    public function getAllPeople(int $page = 1): array;
}
