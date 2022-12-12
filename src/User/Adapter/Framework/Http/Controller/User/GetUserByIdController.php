<?php

declare(strict_types=1);

namespace App\User\Adapter\Framework\Http\Controller\User;

use App\User\Adapter\Framework\Http\DTO\GetUserByIdRequestDTO;
use App\User\Application\UseCase\User\GetUserById\DTO\GetUserByIdInputDTO;
use App\User\Application\UseCase\User\GetUserById\GetUserById;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetUserByIdController extends AbstractController
{
    public function __construct(
        private readonly GetUserById $useCase
    ) {
    }

    #[Route('/{id}', name: 'get_customer_by_id', methods: ['GET'])]
    public function __invoke(GetUserByIdRequestDTO $request): Response
    {
        $responseDTO = $this->useCase->handle(GetUserByIdInputDTO::create($request->id));

        return $this->json($responseDTO);
    }
}