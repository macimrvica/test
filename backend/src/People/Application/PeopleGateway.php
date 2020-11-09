<?php declare(strict_types=1);


namespace App\People\Application;

use App\Common\Application\RequestFactoryInterface;
use App\People\Domain\Exception\CouldNotGetPeopleByName;
use App\People\Domain\Model\PeopleDTO;
use App\People\Domain\Model\PeopleSearchByNameResultsDTO;

final class PeopleGateway implements PeopleGatewayInterface
{
    private RequestFactoryInterface $requestFactory;

    public function __construct(RequestFactoryInterface $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }

    public function getByName(string $name): PeopleSearchByNameResultsDTO
    {
        $response = $this->requestFactory->makeGetRequest('https://swapi.dev/api/people/?', ['search' => $name]);
        $responseBody = $response->getBody()->getContents();
        $decodedData = json_decode($responseBody, true);

        if (json_last_error()) {
            throw CouldNotGetPeopleByName::because(sprintf('PeopleGateway returned invalid JSON: "%s"', $responseBody));
        }

        return PeopleSearchByNameResultsDTO::fromArray($decodedData);
    }

    /**
     * @return PeopleDTO[]
     */
    public function getAllPeople(int $page = 1): array
    {
        $people = [];
        do {
            $response = $this->requestFactory->makeGetRequest('https://swapi.dev/api/people/?', ['page' => $page]);
            $responseBody = $response->getBody()->getContents();
            $decodedData = json_decode($responseBody, true);

            foreach ($decodedData['results'] as $person) {
                $people[] = PeopleDTO::fromArray($person);
            }

            $page++;
        } while ($decodedData['next'] !== null);

        return $people;
    }
}
