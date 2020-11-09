<?php declare(strict_types=1);

namespace App\Tests\unit\Common\Application;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

use App\Common\Infrastructure\Http\HttpClientFactory;
use App\Common\Infrastructure\Http\HttpRequestFactory;

class HttpFactoryTest extends TestCase
{
    public function test_create_client()
    {
        $this->assertInstanceOf(ClientInterface::class, HttpClientFactory::create());
    }

    public function test_create_request_factory()
    {
        $this->assertInstanceOf(RequestFactoryInterface::class, HttpRequestFactory::create());
    }
}
