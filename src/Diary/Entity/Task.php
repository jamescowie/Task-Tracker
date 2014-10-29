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

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get start_date
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Get end_date
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->end_date;
    }
}
