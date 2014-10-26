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
class Task
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    private $id;

    /** @Column(type="text") */
    private $description;

    /** @Column(length=250) */
    private $title;

    /** @Column(type="datetime") */
    private $start_date;

    /** @Column(type="datetime") */
    private $end_date;

    public function setEndDate()
    {
        $this->end_date = new \DateTime('now');
    }

    public function setStartDate()
    {
        $this->start_date = new \DateTime('now');
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
} 
