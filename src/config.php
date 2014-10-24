<?php

$app['debug'] = true;

$app['twig.path'] = array(__DIR__.'/templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');
