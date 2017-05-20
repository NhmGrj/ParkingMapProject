<?php
namespace ParkingMapBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ParkingMapBundle\Entity\Slots;
use ParkingMapBundle\Entity\State;

class LoadSlotsData implements FixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    public function load(ObjectManager $manager)
    {
        $th = $this->container->get('pkm.time_handler');
        $slotNb = 12;
        $hoursNb = 10;
        $itByHour = 4;
        $maxIt = $hoursNb * $itByHour;

        for ($i=0; $i <= ($slotNb - 1); $i++) {
            $slot = new Slots();

            //Set up states data related to each slot
            $th->subHours($hoursNb);
            for ($it=1; $it <= $maxIt; $it++) {

                $state = new State();
                $state->setDate($th->getTime());
                //Let's simulate that slots state can change
                // every 15 min.
                if($it == 1) {
                    // Let's assume all slots were free at the beginning
                    $state->setState(true);
                    $lastState = $state->getState();
                } else {
                    // If it is not the first iteration, let's
                    // randomly change the state or not
                    // if the state change, it means someone leave,
                    // or occupied the the slot.
                    $state->setLastState($lastState);
                    // var_dump(rand(0, 10) < 10);
                    $state->setState((rand(0, 10) < 5) ? $lastState : (!$lastState));
                    $lastState = $state->getState();
                }

                $state->setSlot($slot);
                $manager->persist($state);
                $manager->flush();

                $th->addMins(60/$itByHour);
            }

            $manager->persist($slot);
        }


        $manager->flush();

    }
}
