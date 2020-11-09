<?php declare(strict_types=1);


namespace App\Common\Infrastructure\Http;

use Psr\Http\Message\RequestFactoryInterface;

use Http\Discovery\Psr17FactoryDiscovery;

class HttpRequestFactory
{
    public static function create(): RequestFactoryInterface
    {
        return Psr17FactoryDiscovery::findRequestFactory();
    }
}
