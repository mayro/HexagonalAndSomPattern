<?php

namespace App\Domain\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;

interface NotFoundExceptionInterface extends \Throwable
{
    /**
     * Generates response.
     *
     * @return JsonResponse
     */
    public function getResponse(): JsonResponse;

}