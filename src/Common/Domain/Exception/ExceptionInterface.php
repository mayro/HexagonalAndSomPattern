<?php

namespace App\Common\Domain\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;

interface ExceptionInterface extends \Throwable
{
    /**
     * Generates response.
     *
     * @return JsonResponse
     */
    public function getResponse(): JsonResponse;
}