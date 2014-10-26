<?php

namespace Diary\Controllers;

use Diary\Entity\Task;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function indexAction(Application $app, Request $request)
    {
        $form = $app['form.factory']->createBuilder('form')
            ->add('task')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isvalid()) {
            $data = $form->getData();

            $post = new Task();
            $post->setContent('Hello World');
            $app['db.orm.em']->persist($post);
            $app['db.orm.em']->flush();
        }

        return $app['twig']->render('index.twig', array('form' => $form->createView()));
    }

    public function helloAction($name)
    {
        return new Response('Hello ' . $name);
    }
}
