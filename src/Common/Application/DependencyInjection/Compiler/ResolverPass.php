<?php

/*
 * Proprietary and confidential.
 *
 * This file is part of the ABTasty API package.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 *
 * Copyright (c) abtasty.com - All Rights Reserved.
 */

namespace App\Common\Application\DependencyInjection\Compiler;

use App\Common\Domain\Resolver\HandlerResolver;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ResolverPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(HandlerResolver::class)) {
            return;
        }

        $resolver = $container->getDefinition(HandlerResolver::class);

        foreach ($container->findTaggedServiceIds('app.resolver') as $id => $tags) {
            $resolver->addMethodCall('addResolver', [new Reference($id)]);
        }

/*


        foreach ($container->findTaggedServiceIds('abtasty.request_reader') as $taggedServiceId => $tags) {
            $resolver->addMethodCall('addReader', [new Reference($taggedServiceId)]);
        }

        // Add all taged services with 'abtasty.response_formatter' to resolver
        foreach ($container->findTaggedServiceIds('abtasty.response_formatter') as $taggedServiceId => $tags) {
            $resolver->addMethodCall('addFormatter', [new Reference($taggedServiceId)]);
        }*/
    }
}
