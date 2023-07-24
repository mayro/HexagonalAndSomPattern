<?php

namespace App\Authentication\Domain\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserNotFoundException extends \Exception implements NotFoundExceptionInterface
{
    /**
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct($message, Response::HTTP_NOT_FOUND);
    }

    /**
     * @return JsonResponse
     */
    public function getResponse(): JsonResponse
    {
        return new JsonResponse(['error' => $this->getMessage()], $this->getCode());
    }
}