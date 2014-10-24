<?php
use Symfony\Component\Debug\Debug;

require_once(__DIR__ . '/../vendor/autoload.php');

$app = require __DIR__ . '/../src/app.php';

Debug::enable();

require __DIR__ . '/../src/config.php';
require __DIR__ . '/../src/controllers.php';


$app->run();
