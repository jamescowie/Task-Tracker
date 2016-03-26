<?php

namespace Snippets\Controllers;

//use Diary\Entities\Task;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function indexAction(Application $app, Request $request)
    {
        return $app['twig']->render('index.twig', array('message' => 'hello world'));
    }
}
