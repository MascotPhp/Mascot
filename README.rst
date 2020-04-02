Mascot, a simple Web Framework
=============================

Mascot is a fork of Silex, the PHP micro-framework to develop websites
based on `Symfony components`_:

.. code-block:: php

    <?php

    require_once __DIR__.'/../vendor/autoload.php';

    $app = new Mascot\Application();

    $app->get('/hello/{name}', function ($name) use ($app) {
      return 'Hello '.$app->escape($name);
    });

    $app->run();

Mascot works with PHP 7.2 or later.

Installation
------------

The recommended way to install Mascot is through `Composer`_:

.. code-block:: bash

    composer require mascot/mascot

Alternatively, you can download the `mascot.zip`_ file and extract it.

More Information
----------------

Read the `documentation`_ for more information and `changelog
<doc/changelog.rst>`_ for upgrading information.

Tests
-----

To run the test suite, you need `Composer`_ and `PHPUnit`_:

.. code-block:: bash

    composer install
    phpunit

Support
-------

If you have a configuration problem use the `mascot tag`_ on StackOverflow to ask a question.

If you think there is an actual problem in Mascot, please `open an issue`_ if there isn't one already created.

License
-------

Mascot is licensed under the MIT license.

.. _Symfony components: https://symfony.com
.. _Composer:           https://getcomposer.org
.. _PHPUnit:            https://phpunit.de
.. _mascot.zip:          https://mascot.rocks/download
.. _documentation:      https://mascot.rocks/documentation
.. _mascot tag:          https://stackoverflow.com/questions/tagged/mascot
.. _open an issue:      https://github.com/mascotphp/Mascot/issues/new
