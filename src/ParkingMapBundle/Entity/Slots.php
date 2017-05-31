<?php

namespace ParkingMapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use ParkingMapBundle\Entity\State as State;

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
     * @ORM\Column(name="current_state", type="boolean")
     */
     private $currentState = true;

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
      * Get current State
      *
      * @return State
      */
      public function getCurrentState() {
          return $this->currentState;
      }

      /**
       * Set current State
       *
       * @return $this
       */
       public function setCurrentState($state) {
           $this->currentState = $state;
           return $this;
       }

      /**
       * Get if the slot is free or not
       *
       * If Current state is false, the slot isn't Free
       * If Current state is true, the slot is actually Free
       *
       * @return bool
       */
      public function isFree() {
          return $this->getCurrentState();
      }


}
