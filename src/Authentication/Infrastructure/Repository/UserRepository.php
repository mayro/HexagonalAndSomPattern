<?php

namespace App\Authentication\Infrastructure\Repository;

use App\Authentication\Domain\Exception\UserNotFoundException;
use App\Authentication\Infrastructure\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserLoaderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $identifier
     * @return UserInterface|null
     * @throws UserNotFoundException
     */
    public function loadUserByIdentifier(string $identifier): ?UserInterface
    {
        $user = $this->findOneBy(['email' => $identifier]);

        if(!$user) {
            throw new UserNotFoundException('User with {$email} not exist');
        }

        return $user;
    }
}
