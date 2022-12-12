<?php
declare(strict_types=1);

namespace App\User\Adapter\Database\ORM\Doctrine\Repository;

use App\User\Domain\Repository\UserRepository;
use App\Shared\Domain\Exception\ResourceNotFoundException;
use App\User\Domain\Model\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;

class UserDoctrineRepository implements UserRepository
{
    private readonly ServiceEntityRepository $repository;
    private readonly ObjectManager|EntityManagerInterface $manager;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->repository = new ServiceEntityRepository($managerRegistry, User::class);
        $this->manager = $managerRegistry->getManager('user_em');
    }

    public function findOneByIdOrFail(string $id): User
    {
        if (null === $User = $this->repository->find($id)) {
            throw ResourceNotFoundException::createFromClassAndId(User::class, $id);
        }

        return $User;
    }
    public function findOneByEmailOrFail(string $email): User
    {
        if (null === $user = $this->repository->findOneBy(['email' => $email])) {
            throw ResourceNotFoundException::createFromClassAndEmail(User::class, $email);
        }

        return $user;
    }

    public function save(User $User): void
    {
        $this->manager->persist($User);
        $this->manager->flush();
    }

    public function remove(User $User): void
    {
        $this->manager->remove($User);
        $this->manager->flush();
    }
}