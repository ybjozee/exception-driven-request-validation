<?php

namespace App\EventSubscriber;

use App\Exception\MissingParameterException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class MissingParameterEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        if ($exception instanceof MissingParameterException) {
            $event->setResponse(new JsonResponse([
                'message' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST));
        }
        //Allow the kernel deal with the exception
        return $exception;
    }
}
