<?php

namespace Diary\Entities;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\DBAL\Types\Type;
use Silex\Application;

class TaskRepository extends EntityRepository
{
    public function saveTask($data, Application $app)
    {
        $task = new Task();

        $task->setTitle($data['task']);
        $task->setStartDate();

        $app['db.orm.em']->persist($task);
        $app['db.orm.em']->flush();
    }
} 
