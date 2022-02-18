<?php

namespace App\Tests\User;


use http\Client;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateUserTest extends WebTestCase
{
    /**
     * @dataProvider userCreationSuccessfulProvider
     */
    public function testCreateUserSuccessful($data)
    {
        $client = static::createClient();

        $response = $client->request('Post','/users/register', $data);
        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('result', $response->getContent());

    }

    public function userCreationSuccessfulProvider()
    {
        yield [
            [
                'name' => 'theo',
                'email' => 'email',
                'password' => 'password'
            ]
        ];
    }

    /**
     * @dataProvider fieldCreatedFailureProvider
     */
    public function testCreatedTagFailure($data, $errors)
    {
        $response = $this->jsonRequest('POST', '/api/v1/items/tags', $data);
        $this->assertJson($response->getContent());
        $this->assertSame(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $responseContent = json_decode($response->getContent(), true);
        $this->assertSame(false, $responseContent['result']);

        foreach ($errors as $e) {
            $this->errorContainsField($e, $responseContent['errors']);
        }
    }

    public function fieldCreatedFailureProvider()
    {
        yield [
            ['name' => ''],
            ['name']
        ];
        yield [
            ['name' => 'a'],
            ['name']
        ];
    }
}
