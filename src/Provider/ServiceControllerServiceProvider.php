<?php

/*
 * This file is part of the Silex framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mascot\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Mascot\ServiceControllerResolver;

class ServiceControllerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app->extend('resolver', function ($resolver, $app) {
            return new ServiceControllerResolver($resolver, $app['callback_resolver']);
        });
    }
}
