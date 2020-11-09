<?php declare(strict_types=1);


namespace App\Planets\Application;

use App\Common\Application\RequestFactoryInterface;
use App\Planets\Domain\Exception\CouldNotGetPlanets;
use App\Common\Domain\CreationDate;
use App\Common\Domain\UserFilterCreationDate;
use App\Planets\Domain\Model\PlanetDTO;
use App\Planets\Domain\Model\PaginatedPlanetsDTO;

final class PlanetsGateway implements PlanetsGatewayInterface
{
    private RequestFactoryInterface $requestFactory;

    public function __construct(RequestFactoryInterface $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }

    public function getPaginatedPlanetsCreatedAfter(int $page, UserFilterCreationDate $date): PaginatedPlanetsDTO
    {
        $response = $this->requestFactory->makeGetRequest('https://swapi.dev/api/planets/?', ['page' => $page]);
        $responseBody = $response->getBody()->getContents();
        $decodedData = json_decode($responseBody, true);

        if (json_last_error()) {
            throw CouldNotGetPlanets::because(sprintf('PlanetsGateway returned invalid JSON: "%s"', $responseBody));
        }

        $planets = [];
        foreach ($decodedData['results'] as $planet) {
            $planetCreationDate = CreationDate::fromString($planet['created']);

            if ($planetCreationDate->isInTheFuture($date->toCreationDateFormat())) {
                $planets[] = PlanetDTO::fromArray($planet);
            }
        }

        return PaginatedPlanetsDTO::fromArray(
            [
                'next' => $decodedData['next'],
                'results' => $planets,
            ]
        );
    }
}
