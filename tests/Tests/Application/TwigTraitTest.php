<?php

/*
 * This file is part of the Silex framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Mascot\Tests\Application;

use PHPUnit\Framework\TestCase;
use Mascot\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TwigTraitTest extends TestCase
{
    public function testRender()
    {
        $app = $this->createApplication();

        $app['twig'] = $twig = $this->getMockBuilder('Twig\Environment')->disableOriginalConstructor()->getMock();
        $twig->expects($this->once())->method('render')->will($this->returnValue('foo'));

        $response = $app->render('view');
        $this->assertEquals('Symfony\Component\HttpFoundation\Response', get_class($response));
        $this->assertEquals('foo', $response->getContent());
    }

    public function testRenderKeepResponse()
    {
        $app = $this->createApplication();

        $app['twig'] = $twig = $this->getMockBuilder('Twig\Environment')->disableOriginalConstructor()->getMock();
        $twig->expects($this->once())->method('render')->will($this->returnValue('foo'));

        $response = $app->render('view', [], new Response('', 404));
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testRenderForStream()
    {
        $app = $this->createApplication();

        $app['twig'] = $twig = $this->getMockBuilder('Twig\Environment')->disableOriginalConstructor()->getMock();
        $twig->expects($this->once())->method('display')->will($this->returnCallback(function () { echo 'foo'; }));

        $response = $app->render('view', [], new StreamedResponse());
        $this->assertEquals('Symfony\Component\HttpFoundation\StreamedResponse', get_class($response));

        ob_start();
        $response->send();
        $this->assertEquals('foo', ob_get_clean());
    }

    public function testRenderView()
    {
        $app = $this->createApplication();

        $app['twig'] = $twig = $this->getMockBuilder('Twig\Environment')->disableOriginalConstructor()->getMock();
        $twig->expects($this->once())->method('render');

        $app->renderView('view');
    }

    public function createApplication()
    {
        $app = new TwigApplication();
        $app->register(new TwigServiceProvider());

        return $app;
    }
}