<?php
declare(strict_types=1);

namespace App\User\Adapter\Framework\Http\Controller\User;

use App\User\Adapter\Framework\Http\DTO\ChangeUserPasswordRequestDTO;
use App\User\Application\UseCase\User\ChangeUserPassword\ChangeUserPassword;
use App\User\Application\UseCase\User\ChangeUserPassword\DTO\ChangeUserPasswordInputDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChangeUserPasswordController extends AbstractController
{
    public function __construct(private readonly ChangeUserPassword $service)
    {
    }
    #[Route('/{id}/change-password', name: 'change_user_password', methods: ['POST'])]
    public function __invoke(ChangeUserPasswordRequestDTO $changeUserPasswordRequestDTO)
    {
        $this->service->handle(ChangeUserPasswordInputDTO::create(
            $changeUserPasswordRequestDTO->id,
            $changeUserPasswordRequestDTO->oldPassword,
            $changeUserPasswordRequestDTO->newPassword
        ));

        return $this->json(null,Response::HTTP_OK);
    }
}