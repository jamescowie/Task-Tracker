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

            $this->save($data, $app);

            $app['session']->getFlashBag()->add('message', 'Task saved to database');
            $app->redirect('/');
        }

        return $app['twig']->render('index.twig', array('form' => $form->createView()));
    }

    public function allAction(Application $app)
    {
         $tasks = $app['db.orm.em']->getRepository('Diary\Entity\Task');

         return $app['twig']->render('tasks.twig', array('tasks' => $tasks->findBy(array(), array('start_date' => 'DESC'))));
    }

    public function completeAction(Application $app, Request $request, $id)
    {
        $tasks = $app['db.orm.em']->find('Diary\Entity\Task', $id);

        $tasks->setEndDate();

        $app['db.orm.em']->persist($tasks);
        $app['db.orm.em']->flush();

        $app['session']->getFlashBag()->add('message', 'Finished task');
        return $app->redirect('/');
    }


    protected function save($data, Application $app)
    {
        $task = new Task();
        $task->setTitle($data['task']);
        $task->setStartDate();
        $app['db.orm.em']->persist($task);
        $app['db.orm.em']->flush();
    }

}
