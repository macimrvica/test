<?php declare(strict_types=1);


namespace App\Films\Application;

use App\Common\Application\RequestFactoryInterface;
use App\Films\Domain\Model\FilmDTO;
use App\Films\Domain\Exception\CouldNotGetFilmsById;

final class FilmsGateway implements FilmsGatewayInterface
{
    private RequestFactoryInterface $requestFactory;

    public function __construct(RequestFactoryInterface $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * @return FilmDTO[]
     */
    public function getAll(): array
    {
        $response = $this->requestFactory->makeGetRequest('https://swapi.dev/api/films/', []);
        $responseBody = $response->getBody()->getContents();
        $decodedData = json_decode($responseBody, true);

        if (json_last_error()) {
            throw CouldNotGetFilmsById::because(sprintf('FilmsGateway returned invalid JSON: "%s"', $responseBody));
        }

        $films = [];
        foreach ($decodedData['results'] as $film) {
            $films[] = FilmDTO::fromArray($film);
        }

        return $films;
    }

    public function getByUrl(string $url): FilmDTO
    {
        $response = $this->requestFactory->makeGetRequest($url, []);
        $responseBody = $response->getBody()->getContents();
        $decodedData = json_decode($responseBody, true);

        if (json_last_error()) {
            throw CouldNotGetFilmsById::because(sprintf('FilmsGateway returned invalid JSON: "%s"', $responseBody));
        }

        return FilmDTO::fromArray($decodedData);
    }
}
