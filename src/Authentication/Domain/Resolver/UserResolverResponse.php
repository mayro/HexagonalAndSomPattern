<?php

namespace App\Authentication\Domain\Resolver;

use App\Authentication\Infrastructure\Entity\User;
use App\Common\Domain\Resolver\ResolverInterface;

class UserResolverResponse implements ResolverInterface
{

    public function resolve(mixed $data, string $type, array $optionParams)
    {
        die('je ss la ');
        // TODO: Implement resolve() method.
    }

    public function supports(string $type): bool
    {
        return $type === User::class;
    }
}