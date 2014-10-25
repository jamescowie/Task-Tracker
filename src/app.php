<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;

$app = new Application();

$app->register(new TwigServiceProvider());
$app->register(new Whoops\Provider\Silex\WhoopsServiceProvider);

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    return $twig;
}));

return $app;
