<?php

namespace App\Authentication\Domain;

use App\Authentication\Domain\Exception\UserNotFoundException;
use App\Authentication\Infrastructure\Entity\User;
use App\Authentication\Infrastructure\Repository\UserRepository;

class UserManager
{
    public function __construct(public UserRepository $userRepository) {}

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function findById(int $id): User
    {
        $user = $this->userRepository->find($id);

        if(!$user) {
            throw new UserNotFoundException("User with id $id is not found");
        }

        return $user;
    }

    /**
     * @param string $email
     * @return User
     * @throws UserNotFoundException
     */
    public function findByEmail(string $email): User
    {
        $user = $this->userRepository->findOneBy(['email' => $email]);

        if(!$user) {
            throw new UserNotFoundException("User with email $email is not found");
        }

        return $user;
    }
}