<?php

namespace App\Common\Domain\Resolver;
/**
 * selects a resolver for a given resource.
 */
interface ResolverInterface
{
    public function resolve(mixed $data, string $type, array $optionParams);
    public function supports(string $type): bool;
}