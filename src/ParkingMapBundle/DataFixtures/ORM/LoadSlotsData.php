<?php
namespace ParkingMapBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ParkingMapBundle\Entity\Slots;
use ParkingMapBundle\Entity\State;

class LoadSlotsData implements FixtureInterface {

    public function load(ObjectManager $manager)
    {
        //Time Specification ISO 8601.
        //https://en.wikipedia.org/wiki/ISO_8601#Durations
        $tenHours = "PT10H";
        $fifteenMinutes = "PT15M"

        //Set up 10 slots, with potential state update every 10 min
        //from 10h than currentTime for each slots.
        for ($i=0; $i <= 10; $i++) {
            $time = new \DateTime();
            $time = $time->sub(new \DateInterval($tenHours));
            $slot = new Slots();

            //Set up states data related to each slot
            for ($it=0; $it <= 40; $it++) {
                $state = new State();
                $state->setDate($time);

                //Let's simulate that slots state can change
                // every 15 min.
                if($it == 0) {
                    // Let's assume all slots were free at the beginning
                    $state->setState(true);
                    $lastState = $state->getState();
                } else {
                    // If it is not the first iteration, let's
                    // randomly change the state or not
                    // if the state change, it means someone leave,
                    // or occupied the the slot.
                    $state->setLastState($lastState);
                    $state->setState(rand(0, 1) ? !$lastState : $lastState);
                    $lastState = $state->getState();
                }
                $state->setSlot($slot);
                $manager->persist($state);
                // $manager->flush();

                $time->add(new \DateInterval($fifteenMinutes));
            }

            $manager->persist($slot);
        }


        $manager->flush();

    }
}
