<?php declare(strict_types=1);


namespace App\Tests\functional\People\Infrastructure\Http;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetPeopleFilmsTest extends WebTestCase
{
    public function test_returns_response_with_valid_input()
    {
        $client = static::createClient();
        $client->request('GET', '/api/people/Luke/films');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function test_returns_error_with_invalid_input()
    {
        $client = static::createClient();
        $client->request('GET', '/api/people/123456/films');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('No results found', json_decode($client->getResponse()->getContent()));
    }
}
