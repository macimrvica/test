<?php declare(strict_types=1);


namespace App\People\Application;

use App\Common\Application\StarWarsClientStarWarsClientRequestFactory;
use App\Common\Application\RequestFactoryInterface;
use App\Starships\Application\StarshipsGatewayInterface;
use App\Starships\Domain\Model\StarshipDTO;

final class PeopleStarshipsGateway implements PeopleStarshipsGatewayInterface
{
    private RequestFactoryInterface $requestFactory;
    private PeopleGatewayInterface $peopleGateway;
    private StarshipsGatewayInterface $starshipsGateway;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        PeopleGatewayInterface $peopleGateway,
        StarshipsGatewayInterface $starshipsGateway
    ) {
        $this->requestFactory = $requestFactory;
        $this->peopleGateway = $peopleGateway;
        $this->starshipsGateway = $starshipsGateway;
    }

    /**
     * @return StarshipDTO[]
     */
    public function getPeopleStarshipsWithPassengerCountAbove(int $count): array
    {
        $people = $this->peopleGateway->getAllPeople();

        $starships = [];
        foreach ($people as $person) {
            foreach ($person->getStarshipUrls() as $starshipUrl) {
                $starshipDTO = $this->starshipsGateway->getByUrl($starshipUrl);
                if (!in_array($starshipDTO->getId(), $starships, true) && $starshipDTO->getPassengers() >= $count) {
                    $starships[$starshipDTO->getId()] = $starshipDTO;
                }
            }
        }

        return array_values($starships);
    }
}
