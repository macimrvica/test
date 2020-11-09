<?php declare(strict_types=1);


namespace App\Planets\Infrastructure\Http;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

use App\Planets\Application\PlanetsGatewayInterface;
use App\Common\Domain\UserFilterCreationDate;
use App\Planets\Domain\Model\PlanetDTO;

final class PlanetsController
{
    private SerializerInterface $serializer;
    private PlanetsGatewayInterface $planetsGateway;

    public function __construct(SerializerInterface $serializer, PlanetsGatewayInterface $planetsGateway)
    {
        $this->serializer = $serializer;
        $this->planetsGateway = $planetsGateway;
    }

    /**
     * @Route("/planets/{date}", name="app_get_planets_created_after", methods={"GET","HEAD"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns planets created after date",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=PlanetDTO::class))
     *     )
     * )
     * @SWG\Parameter(
     *     name="date",
     *     in="path",
     *     type="string",
     *     description="The filed for date filter (Y-m-d)"
     * )
     * @SWG\Tag(name="planets")
     */
    public function getPlanetsCreatedAfter(string $date)
    {
        $comparisonDate = UserFilterCreationDate::fromString($date);

        $page = 1;
        $result = [];

        /* @TODO pagination could be ok here */
        do {
            $paginatedPlanetsDTO = $this->planetsGateway->getPaginatedPlanetsCreatedAfter($page, $comparisonDate);
            if (($planets = $paginatedPlanetsDTO->getPlanets()) && $planets !== []) {
                array_map(function ($planet) use (&$result) {
                    $result[] = $planet;
                }, $planets);
            }

            $page++;
        } while ($paginatedPlanetsDTO->getNext());

        $serializedData = $this->serializer->serialize($result, 'json');

        return new JsonResponse($serializedData, 200, [], true);
    }
}
