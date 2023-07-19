<?php

namespace App\Domain\EventSubscriber;

use App\Domain\Exception\NotFoundExceptionInterface;
use App\Domain\Exception\UserNotFoundException;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    /**
     * @param ExceptionEvent $exceptionEvent
     */
    public function onUpdateResponse(ExceptionEvent $exceptionEvent)
    {
        $exception = $exceptionEvent->getThrowable();

        if(!$exception instanceof NotFoundExceptionInterface) {
            return;
        }

        $exceptionEvent->setResponse($exception->getResponse());
    }

    #[ArrayShape([KernelEvents::EXCEPTION => "string"])] public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onUpdateResponse',
        ];
    }
}
