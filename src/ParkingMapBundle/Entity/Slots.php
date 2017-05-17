<?php

namespace ParkingMapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Slots
 *
 * @ORM\Table(name="slots")
 * @ORM\Entity(repositoryClass="ParkingMapBundle\Repository\SlotsRepository")
 */
class Slots
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="State", mappedBy="Slot")
     */
     private $states;

     public function __construct() {
        $this->states = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
