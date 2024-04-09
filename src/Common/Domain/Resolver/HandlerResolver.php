<?php

namespace App\Common\Domain\Resolver;

use App\Common\Domain\Exception\NotFoundResolverException;
use App\Common\Domain\Exception\NotFoundResolverExceptionInterface;

class HandlerResolver implements ResolverInterface
{
    private array $resolvers;

    /**
     * @param ResolverInterface $resolver
     */
    public function addResolver(ResolverInterface $resolver)
    {
        $this->resolvers [] = $resolver;
    }

    /**
     * @param mixed $data
     * @param string $type
     * @param array $optionParams
     * @return ResolverInterface
     * @throw NotFoundResolverException
     */
    public function resolve(mixed $data, string $type, array $optionParams = []): ResolverInterface
    {
        /** @var ResolverInterface $resolver */
        foreach ($this->resolvers as $resolver) {
            if ($resolver->supports($type)) {
                return $resolver->resolve($data, $type, $optionParams);
            }
        }

        return throw new NotFoundResolverException("resolver not found for type {$type}");
    }

    /**
     * @param string $type
     * @return bool
     */
    public function supports(string $type): bool
    {
        return false;
    }

}