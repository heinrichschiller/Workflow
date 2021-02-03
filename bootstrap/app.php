<?php

/**
 *
 * MIT License
 *
 * Copyright (c) 2019-2020 Heinrich Schiller
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

declare(strict_types = 1);

use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

error_reporting(-1);
ini_set('display_errors', '1');

require __DIR__ . '/../app/constants.php';
require __DIR__ . '/../app/helper.php';
require ROOT_DIR . 'vendor/autoload.php';

/*
|----------------------------------------------------------------------------
| Loads environment variables from .env
|----------------------------------------------------------------------------
|
| You should never store sensitive credentials in your code.
| https://github.com/vlucas/phpdotenv
|
*/
$dotenv = Dotenv::createImmutable(ROOT_DIR);
$dotenv->load();

$containerBuilder = new ContainerBuilder();

// Set up settings
$settings = require ROOT_DIR . 'app/settings.php';
$settings($containerBuilder);

$container = $containerBuilder->build();

(require ROOT_DIR . 'app/container.php')($container);

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->addRoutingMiddleware();

$app->addErrorMiddleware(true, true, true);

/*
|----------------------------------------------------------------------------
| Routes with nikic/fast-route
|----------------------------------------------------------------------------
|
| This library provides a fast implementation of a regular expression based
| router.
|
*/
(require ROOT_DIR . '/routes/api.php')($app);

/*
|----------------------------------------------------------------------------
| Routes with nikic/fast-route
|----------------------------------------------------------------------------
|
| This library provides a fast implementation of a regular expression based
| router.
|
*/
(require ROOT_DIR . 'routes/web.php')($app);

return $app;