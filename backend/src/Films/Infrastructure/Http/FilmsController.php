<?php declare(strict_types=1);


namespace App\Films\Infrastructure\Http;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

use App\Films\Application\FilmsGatewayInterface;
use App\Films\Domain\Model\FilmDTO;

final class FilmsController
{
    private SerializerInterface $serializer;
    private FilmsGatewayInterface $filmsGateway;

    public function __construct(SerializerInterface $serializer, FilmsGatewayInterface $filmsGateway)
    {
        $this->serializer = $serializer;
        $this->filmsGateway = $filmsGateway;
    }

    /**
     * @Route("/films", name="app_get_films", methods={"GET","HEAD"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns all films",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=FilmDTO::class))
     *     )
     * )
     * @SWG\Tag(name="films")
     */
    public function getFilms(): JsonResponse
    {
        $films = $this->filmsGateway->getAll();
        $serializedData = $this->serializer->serialize($films, 'json');

        return new JsonResponse($serializedData, 200, [], true);
    }
}
