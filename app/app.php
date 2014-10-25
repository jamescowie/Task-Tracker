<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Diary\Controllers\IndexController;

$app = new Application();

$app->register(new TwigServiceProvider());
$app->register(new Whoops\Provider\Silex\WhoopsServiceProvider);
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

// Register plugins
$app['twig'] = $app->share(
    $app->extend(
        'twig',
        function ($twig, $app) {
            return $twig;
        }
    )
);

// Register controllers
$app['index.controller'] = $app->share(
    function () use ($app) {
        return new IndexController($app);
    }
);

return $app;
