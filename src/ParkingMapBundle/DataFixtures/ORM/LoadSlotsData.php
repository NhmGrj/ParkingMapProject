<?php
namespace ParkingMapBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ParkingMapBundle\Entity\Slots;
use ParkingMapBundle\Entity\State;

class LoadSlotsData implements FixtureInterface {

    public function load(ObjectManager $manager)
    {
        // $timesArray = [];

        // hoursArray instanciation
        // for ($h=0; $h <= 24; $h++) {
        //     $timesArray[] = $time;
        // }

        //Set up 10 slots
        for ($i=0; $i < 10; $i++) {
            $time = new \DateTime();
            $slot = new Slots();

            //Set up states data related to each slot, for each last 24h
            for ($h=0; $h <= 24; $h++) {
                $time->sub(new \DateInterval('PT1H'));
                $state = new State();
                $state->setDate($time);
                $state->setState(rand(0, 1));
                $state->setSlot($slot);
                $manager->persist($state);
                $manager->flush();


                $slot->getStates()->add($state);
            }
            $manager->persist($slot);
            $manager->flush();
        }



    }
}
