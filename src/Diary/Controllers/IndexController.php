<?php

namespace Diary\Controllers;

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
