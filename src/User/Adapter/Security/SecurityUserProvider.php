<?php
declare(strict_types=1);

namespace App\User\Adapter\Security;

use App\User\Domain\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class SecurityUserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Symfony calls this method if you use features like switch_user
     * or remember_me. If you're not using these features, you do not
     * need to implement this method.
     *
     * @throws UserNotFoundException if the user is not found
     */
    public function loadUserByIdentifier(string $identifier): UserInterface
{
    if (null === ($user = $this->userRepo->findOneByEmailOrFail($identifier))) {
        throw new UserNotFoundException(sprintf('No user found for "%s"', $identifier));
    }

    return new SecurityUser($user);
}

    /**
     * Refreshes the user after being reloaded from the session.
     *
     * When a user is logged in, at the beginning of each request, the
     * User object is loaded from the session and then this method is
     * called. Your job is to make sure the user's data is still fresh by,
     * for example, re-querying for fresh User data.
     *
     * If your firewall is "stateless: true" (for a pure API), this
     * method is not called.
     *
     * @return UserInterface
     */
    public function refreshUser(UserInterface $userToRefresh)
{
    if (!$userToRefresh instanceof SecurityUser) {
        throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($userToRefresh)));
    }

    if (null === ($user = $this->userRepo->findOneByEmailOrFail($userToRefresh->getUserIdentifier()))) {
        throw new UserNotFoundException(sprintf('No user found for "%s"', $userToRefresh->getUserIdentifier()));
    }

    return new SecurityUser($user);
}

    /**
     * Tells Symfony to use this provider for this User class.
     */
    public function supportsClass(string $class)
{
    return SecurityUser::class === $class || is_subclass_of($class, SecurityUser::class);
}

    /**
     * Upgrades the hashed password of a user, typically for using a better hash algorithm.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
{
    // TODO: when hashed passwords are in use, this method should:
    // 1. persist the new password in the user storage
    // 2. update the $user object with $user->setPassword($newHashedPassword);
}
}