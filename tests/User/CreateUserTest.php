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
}
