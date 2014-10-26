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

            $task = new Task();
            $task->setTitle($data['task']);
            $task->setStartDate();
            $app['db.orm.em']->persist($task);
            $app['db.orm.em']->flush();

            $app['session']->getFlashBag()->add('message', 'Task saved to database');
            $app->redirect('/');
        }

        return $app['twig']->render('index.twig', array('form' => $form->createView()));
    }

    public function helloAction($name)
    {
        return new Response('Hello ' . $name);
    }
}
