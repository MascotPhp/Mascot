<?php

/*
 * This file is part of the Silex framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mascot\Provider\Session;

use Pimple\Container;
use Pimple\Psr11\Container as Psr11Container;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\EventListener\TestSessionListener as BaseTestSessionListener;

/**
 * Simulates sessions for testing purpose.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TestSessionListener extends BaseTestSessionListener
{
    private $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
        $container = new Psr11Container($app);
        parent::__construct($container);
    }

    protected function getSession(): ?SessionInterface
    {
        if (!isset($this->app['session'])) {
            return null;
        }

        return $this->app['session'];
    }
}
