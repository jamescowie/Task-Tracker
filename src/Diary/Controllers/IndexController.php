<?php

namespace Diary\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    private $app;

    function __construct($app)
    {
        $this->app = $app;
    }

    public function indexAction()
    {
        return $this->app['twig']->render('index.twig', array());
    }
}
