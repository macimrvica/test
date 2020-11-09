<?php declare(strict_types=1);


namespace App\Planets\Application;

use App\Common\Domain\UserFilterCreationDate;

interface PlanetsGatewayInterface
{
    public function getPaginatedPlanetsCreatedAfter(int $page, UserFilterCreationDate $date);
}
