<?php
namespace App\Authentication\Application\Controller;

use App\Authentication\Domain\Exception\UserNotFoundException;
use App\Authentication\Domain\UserManager;
use App\Authentication\Infrastructure\Entity\User;
use App\Common\Domain\Resolver\ResolverInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function __construct(private UserManager $userManager, private ResolverInterface $resolver) {}

    /**
     * @param int $id
     * @return JsonResponse
     * @throws UserNotFoundException
     */
    public function getById(int $id): JsonResponse
    {
       // $user =  $this->userManager->findById($id);

        $result = $this->resolver->resolve([], User::class);

        return new  JsonResponse($result ?? [], Response::HTTP_OK);
    }
}
