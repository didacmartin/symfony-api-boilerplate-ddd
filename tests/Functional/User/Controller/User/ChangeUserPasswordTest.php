<?php

declare(strict_types=1);

namespace App\Tests\Functional\User\Controller\User;

use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChangeUserPasswordTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/user';

    public function testCreateUserAndCheckIt(): void
    {
        $payload = [
            'name' => 'Peter',
            'email' => 'peter2@api.com',
            'address' => 'Fake street 123',
            'age' => 30,
            'password' => '123456',
        ];

        FunctionalTestBase::$authenticatedClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], ['CONTENT_TYPE' => 'application/json'],
        \json_encode($payload));

        $response = FunctionalTestBase::$authenticatedClient->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertArrayHasKey('customerId', $responseData);
        self::assertEquals(36, \strlen($responseData['customerId']));

        $generatedCustomerId = $responseData['customerId'];

        FunctionalTestBase::$authenticatedClient->request(Request::METHOD_GET, \sprintf('/api/user/%s',
            $generatedCustomerId),[],[], ['CONTENT_TYPE' => 'application/json']);

        $response =  FunctionalTestBase::$authenticatedClient->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());

        self::assertArrayHasKey('id', $responseData);
        self::assertArrayHasKey('name', $responseData);
        self::assertArrayHasKey('email', $responseData);
        self::assertArrayHasKey('address', $responseData);
        self::assertArrayHasKey('age', $responseData);

        self::assertEquals($generatedCustomerId, $responseData['id']);
        self::assertEquals($payload['name'], $responseData['name']);
        self::assertEquals($payload['email'], $responseData['email']);
        self::assertEquals($payload['address'], $responseData['address']);
        self::assertEquals($payload['age'], $responseData['age']);
    }
}