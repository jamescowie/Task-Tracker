<?php

namespace Diary\Entity;

use Doctrine\ORM\Mapping\Table;

/**
 * Class Task
 * @package Diary\Entity
 *
 * @Entity Task
 * @Table(name="tasks")
 */
class Tasks
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="text") */
    private $desciption;

    /** @Column(type="varchar") */
    private $title;

    /** @Column(type="datetime") */
    private $start_date;

    /** @Column(type="datetime") */
    private $end_date;

    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
    }

    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    public function setDescription($description)
    {
        $this->desciption = $description;
    }
} 
