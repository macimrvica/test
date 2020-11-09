<?php declare(strict_types=1);

namespace App\Common\Application;

use Psr\Http\Message\ResponseInterface;

interface RequestFactoryInterface
{
    public function makeGetRequest(string $uri, array $parameters): ResponseInterface;
}
