<?php

$app['debug'] = true;

$app['twig.path'] = array(__DIR__.'/../views');
$app['twig.options'] = array('cache' => __DIR__.'/../../var/cache/twig');
