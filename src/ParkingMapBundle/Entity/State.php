<?php

namespace ParkingMapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ParkingMapBundle\Entity\Slots as Slots;

/**
 * State
 *
 * @ORM\Table(name="state")
 * @ORM\Entity(repositoryClass="ParkingMapBundle\Repository\StateRepository")
 */
class State
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="state", type="boolean")
     */
    private $state;

    /**
     * @var bool
     *
     * @ORM\Column(name="last_state", type="boolean")
     */
    private $last_state = true;

    /**
     * @ORM\ManyToOne(targetEntity="Slots", inversedBy="states", cascade={"persist"})
     */
    private $slot;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return State
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set state
     *
     * @param boolean $state
     *
     * @return State
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * True = Disponible / False = Occupied
     * @return bool
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set last_state
     *
     * @param boolean $last_state
     *
     * @return State
     */
    public function setLastState($last_state)
    {
        $this->last_state = $last_state;

        return $this;
    }

    /**
     * Get last_state
     *
     * @return bool
     */
    public function getLastState()
    {
        return $this->last_state;
    }

    /**
     * Get slot
     *
     * @return ParkingMapBundle\Entity\Slots
     */
     public function getSlot()
     {
         return $this->slot;
     }

     /**
      * Set slot
      */
      public function setSlot($slot)
      {
          $this->slot = $slot;
          $slot->getStates()->add($this);
          $slot->setCurrentState($this->state);

          return $this;
      }
}
