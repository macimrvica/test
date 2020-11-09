<?php declare(strict_types=1);


namespace App\People\Infrastructure\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Webmozart\Assert\Assert;

use App\People\Application\PeopleGatewayInterface;
use App\People\Application\Service\HydratePersonFilms;
use App\People\Application\PeopleStarshipsGatewayInterface;
use App\Films\Domain\Model\FilmDTO;
use App\Starships\Domain\Model\StarshipDTO;

final class PeopleController
{
    private SerializerInterface $serializer;
    private PeopleGatewayInterface $peopleGateway;
    private PeopleStarshipsGatewayInterface $peopleStarshipsGateway;

    public function __construct(SerializerInterface $serializer, PeopleGatewayInterface $peopleGateway, PeopleStarshipsGatewayInterface $peopleStarshipsGateway)
    {
        $this->serializer = $serializer;
        $this->peopleGateway = $peopleGateway;
        $this->peopleStarshipsGateway = $peopleStarshipsGateway;
    }

    /**
     * @Route("/people/{name}/films", name="app_get_people_film_by_person_name", methods={"GET","HEAD"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns films where a given character acts",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=FilmDTO::class))
     *     )
     * )
     * @SWG\Parameter(
     *     name="name",
     *     in="path",
     *     type="string",
     *     description="The field for people name filter"
     * )
     * @SWG\Tag(name="people")
     */
    public function getPersonFilmsByPersonName(string $name, HydratePersonFilms $personFilms): JsonResponse
    {
        $people = $this->peopleGateway->getByName($name);

        if ($people->getCount() === 0) {
            return new JsonResponse('No results found', 200);
        }

        $hydratedResult = $personFilms->hydrate($people);
        $serializedData = $this->serializer->serialize($hydratedResult, 'json');

        return new JsonResponse($serializedData, 200, [], true);
    }

    /**
     * @Route("/people/starships/", name="app_get_people_starships_with_passenger_count_filter", methods={"GET","HEAD"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns starships where passsenger count is higher than provided value",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=StarshipDTO::class))
     *     )
     * )
     * @SWG\Parameter(
     *     name="count",
     *     in="query",
     *     required=true,
     *     type="string",
     *     description="The field for passenger count filter (number)"
     * )
     * @SWG\Tag(name="people")
     */
    public function getPeopleStarshipsWithPassengerCountAbove(Request $request): JsonResponse
    {
        try {
            Assert::keyExists($request->query->all(), 'count');
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(json_encode(['error' => "Expected the key 'count' to exist."]), 400, [], true);
        }

        $starships = $this->peopleStarshipsGateway->getPeopleStarshipsWithPassengerCountAbove(
            (int)$request->query->get('count')
        );
        $serializedData = $this->serializer->serialize($starships, 'json');

        return new JsonResponse($serializedData, 200, [], true);
    }
}
