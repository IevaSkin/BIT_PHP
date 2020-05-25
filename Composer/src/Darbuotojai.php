<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="darbuotojai")
 */
class Darbuotojai
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    

    protected $id;

    /**
     * Many employees have one project.
     * @ORM\ManyToOne(targetEntity="Projektai")
     * @ORM\JoinColumn(name="proj_id", referencedColumnName="id")
     */

    protected $name;

}