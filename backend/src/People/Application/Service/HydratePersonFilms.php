<?php declare(strict_types=1);


namespace App\People\Application\Service;

use App\Films\Application\FilmsGatewayInterface;
use App\People\Domain\Model\PeopleFilmsByPeopleNameResultDTO;
use App\People\Domain\Model\PeopleSearchByNameResultsDTO;

final class HydratePersonFilms
{
    private FilmsGatewayInterface $filmsGateway;
    private array $films;

    public function __construct(FilmsGatewayInterface $filmsGateway)
    {
        $this->filmsGateway = $filmsGateway;
        $this->films = [];
    }

    public function hydrate(PeopleSearchByNameResultsDTO $resultsDTO): PeopleFilmsByPeopleNameResultDTO
    {
        foreach ($resultsDTO->getPeople() as $people) {
            foreach ($people->getFilmUrls() as $filmUrl) {
                $this->films[] = $this->filmsGateway->getByUrl($filmUrl);
            }
        }

        return PeopleFilmsByPeopleNameResultDTO::fromArray($this->films);
    }
}
