<?php

namespace Diary\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function indexAction(Application $app)
    {
        return $app['twig']->render('index.twig', array());
    }

    public function helloAction($name)
    {
        return new Response('Hello ' . $name);
    }
}
