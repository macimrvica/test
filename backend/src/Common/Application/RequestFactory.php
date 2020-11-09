<?php declare(strict_types=1);


namespace App\Common\Application;

use RuntimeException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestFactoryInterface;

use App\Common\Application\RequestFactoryInterface as StartWarsClientRequestFactoryInterface;

final class RequestFactory implements StartWarsClientRequestFactoryInterface
{
    private ClientInterface $client;
    private RequestFactoryInterface $requestFactory;

    public function __construct(ClientInterface $client, RequestFactoryInterface $requestFactory)
    {
        $this->client = $client;
        $this->requestFactory = $requestFactory;
    }

    public function makeGetRequest(string $uri, array $parameters): ResponseInterface
    {
        try {
            return $this->client->sendRequest(
                $this->requestFactory->createRequest(
                    'GET',
                    $uri . http_build_query($parameters),
                )
            );
        } catch (ClientExceptionInterface $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
}
