<?php

declare(strict_types=1);

namespace App\User\Adapter\Framework\Http\Controller\User;

use App\User\Adapter\Framework\Http\DTO\CreateUserRequestDTO;
use App\User\Application\UseCase\User\CreateUser\CreateUser as CreateUserService;
use App\User\Application\UseCase\User\CreateUser\DTO\CreateUserInputDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateUserController extends AbstractController
{
    public function __construct(private readonly CreateUserService $service)
    {
    }

    #[Route('', name: 'create_user', methods: ['POST'])]
    public function __invoke(CreateUserRequestDTO $request): Response
    {
        $responseDTO = $this->service->handle(CreateUserInputDTO::create($request->name, $request->email,
            $request->address, $request->age, $request->password, null));

        return $this->json(['customerId' => $responseDTO->id], Response::HTTP_CREATED);
    }
}