<?php
require_once '../vendor/autoload.php';
use Snippets\Application;

$app = new Application(
    [
        'debug' => true,
        'base.path' => __DIR__ . '/../app'
    ]
);

$app->run();
