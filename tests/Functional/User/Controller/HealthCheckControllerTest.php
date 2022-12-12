<?php

declare(strict_types=1);

namespace App\Tests\Functional\User\Controller;

use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckControllerTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/user/health-check';

    public function testUserHealthCheck(): void
    {
        FunctionalTestBase::$authenticatedClient->request(Request::METHOD_GET, self::ENDPOINT);

        $response = FunctionalTestBase::$authenticatedClient->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals('Module User up and running!', $responseData['message']);
    }
}