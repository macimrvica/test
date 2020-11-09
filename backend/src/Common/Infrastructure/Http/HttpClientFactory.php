<?php declare(strict_types=1);


namespace App\Common\Infrastructure\Http;

use Psr\Http\Client\ClientInterface;

use Http\Discovery\HttpClientDiscovery;

class HttpClientFactory
{
    public static function create(): ClientInterface
    {
        return HttpClientDiscovery::find();
    }
}
