<?php
use Symfony\Component\Debug\Debug;

require_once(__DIR__ . '/../vendor/autoload.php');

$app = require __DIR__ . '/../app/app.php';

Debug::enable();

require __DIR__ . '/../app/config/config.php';
require __DIR__ . '/../app/routes.php';

$app->run();
