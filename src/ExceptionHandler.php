<?php

/*
 * This file is part of the Silex framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mascot;

use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\ErrorHandler\Exception\FlattenException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Default exception handler.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ExceptionHandler implements EventSubscriberInterface
{
    protected $debug;

    public function __construct($debug)
    {
        $this->debug = $debug;
    }

    public function onMascotError(ExceptionEvent $event)
    {
        $handler = new ErrorHandler();
        $handler->setExceptionHandler([$handler, 'renderException']);

        if (! $this->debug) {
            $handler->scopeAt(0, true);
        }

        $exception = $event->getThrowable();

        ob_start();
        $handler->handleException($exception);
        $response = ob_get_clean();

        if (!$exception instanceof FlattenException) {
            $exception = FlattenException::create($exception);
        }

        $response = Response::create($response, $exception->getStatusCode(), $exception->getHeaders())->setCharset(ini_get('default_charset'));

        $event->setResponse($response);
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [KernelEvents::EXCEPTION => ['onMascotError', -255]];
    }
}
