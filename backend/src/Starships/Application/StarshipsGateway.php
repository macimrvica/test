<?php declare(strict_types=1);


namespace App\Starships\Application;

use App\Common\Application\RequestFactoryInterface;
use App\Starships\Domain\Exception\CouldNotGetStarships;
use App\Starships\Domain\Model\StarshipDTO;

final class StarshipsGateway implements StarshipsGatewayInterface
{
    private RequestFactoryInterface $requestFactory;

    public function __construct(RequestFactoryInterface $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }

    public function getByUrl(string $url): StarshipDTO
    {
        $response = $this->requestFactory->makeGetRequest($url, []);

        $responseBody = $response->getBody()->getContents();
        $decodedData = json_decode($responseBody, true);

        if (json_last_error()) {
            throw CouldNotGetStarships::because(sprintf('PlanetsGateway returned invalid JSON: "%s"', $responseBody));
        }

        return StarshipDTO::fromArray($decodedData);
    }
}
