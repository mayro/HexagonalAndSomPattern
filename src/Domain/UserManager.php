<?php

namespace App\Domain;

use App\Domain\Exception\UserNotFoundException;
use App\Infrastructure\Entity\User;
use App\Infrastructure\Repository\UserRepository;

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
}