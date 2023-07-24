<?php

namespace App\Common\Domain\Security\Provider;

use App\Authentication\Domain\Exception\UserNotFoundException;
use App\Authentication\Domain\UserManager;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AppUserProvider implements UserProviderInterface
{
    private UserManager $userManager;

    /**
     * @param string $email
     * @return UserInterface
     * @throws UserNotFoundException
     */
    public function loadUserByIdentifier(string $email): UserInterface
    {
        return $this->userManager->findByEmail($email);
    }

    /**
     * @param UserInterface $user
     * @return UserInterface
     * @throws UserNotFoundException
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        $class = \get_class($user);

        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }

        return $this->userManager->findById($user->getId());
    }

    public function supportsClass(string $class): bool
    {
        return $class instanceof UserInterface;
    }

}