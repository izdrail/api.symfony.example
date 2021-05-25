<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

/**
 * Class ExpensesControllerTest
 * @package App\Tests\Controller
 */
class ExpensesControllerTest extends WebTestCase
{
    protected Client $client;

    protected array $apiCredentials = [
        'admin',
        'admin'
    ];

    protected function setUp() : void
	{
		$mock = new MockHandler([new Response(200, [])]);
		$handler = HandlerStack::create($mock);
		$this->client = new Client(['handler' => $handler]);
	}


    public function testGetExpenses(): void
    {

        $response = $this->client->get('/api/expenses', [
            'auth' => $this->apiCredentials,
        ]);

        self::assertEquals(200, $response->getStatusCode());
    }

    public function testGetOneExpense(): void
    {
        $response = $this->client->get('/api/expenses/1', [
            'auth' => $this->apiCredentials,
        ]);

        self::assertEquals(200, $response->getStatusCode());
    }

    public function testSaveExpense(): void
    {
        $response = $this->client->post('/api/expenses', [
            'auth' => $this->apiCredentials,
            'json' => [
                'description' => 'Some description of the expense',
                'value' => '29.99'
            ]
        ]);

        self::assertEquals(200, $response->getStatusCode());

    }

    public function testUpdateExpense(): void
    {
        $response = $this->client->put('/api/expenses/6', [
            'auth' => $this->apiCredentials,
            'json' => [
                'description' => 'my Book PHP',
                'value' => '19.99'
            ]
        ]);

        self::assertEquals(200, $response->getStatusCode());
    }


    public function testDeleteExpense(): void
    {
        $response = $this->client->delete('/api/expenses/8', [
            'auth' => $this->apiCredentials,
        ]);

        self::assertEquals(200, $response->getStatusCode());
    }
}
