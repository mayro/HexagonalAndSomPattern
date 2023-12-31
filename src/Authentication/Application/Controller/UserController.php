<?php
namespace App\Authentication\Application\Controller;

use App\Authentication\Domain\Exception\UserNotFoundException;
use App\Authentication\Domain\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function __construct(public UserManager $userManager) {}

    /**
     * @param int $id
     * @return JsonResponse
     * @throws UserNotFoundException
     */
    public function getById(int $id): JsonResponse
    {
        $user =  $this->userManager->findById($id);

        return new  JsonResponse([], Response::HTTP_OK);
    }
}
