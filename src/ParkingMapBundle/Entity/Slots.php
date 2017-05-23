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
     * @ORM\OneToMany(targetEntity="State", mappedBy="slot")
     */
     private $states;

     private $curentState;

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

    /**
     * Get states
     *
     * @return ArrayCollection
     */
     public function getStates() {
         return $this->states;
     }

     /**
      * Get current State
      *
      * @return State
      */
      public function getCurrentState() {
          $states = $this->states->toArray();
          $states = array_reverse($states);
          $currentState = array_shift($states);

          return $currentState;
      }

      /**
       * Get if the slot is free or not
       *
       * If Current state is true, the slot isn't Free
       * If Current state is false, the slot is actually Free
       *
       * @return bool
       */
      public function isFree() {
          return $this->getCurrentState()->getState();
      }


}
