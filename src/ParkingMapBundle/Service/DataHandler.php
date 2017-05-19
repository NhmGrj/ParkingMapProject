<?php
namespace ParkingMapBundle\Service;

use Doctrine\ORM\EntityManager;
use ParkingMapBundle\Service\TimeHandler;
// use ParkingMapBundle\Repository\StateRepository;

class DataHandler {
    private $em;
    private $th;

    private $slotsRepository;
    private $stateRepository;

    private $slotsNb;

    public function __construct(EntityManager $em, TimeHandler $th) {

        $this->em = $em;
        $this->th = $th;
        $this->slotsRepository = $this->em->getRepository("ParkingMapBundle:Slots");
        $this->stateRepository = $this->em->getRepository("ParkingMapBundle:State");
    }

    private function setSlotsNb($nb) {
        $this->slotsNb = $nb;
    }

    public function getSlotsNb() {
        return $this->slotsNb;
    }

    public function getEntriesByHoursSpan($hoursNb, $hoursSpan) {
        $hoursSpanArray = $this->th->getSpanHoursArray($hoursNb, $hoursSpan);

        foreach ($hoursSpanArray as $key => $hour) {
            $slots = $this->slotsRepository->findAllStatesByHoursSpan($hour['current'], $hour['prevHour']);
            $this->setSlotsNb(count($slots));


            foreach($slots as $slot) {
                $hoursSpanArray[$key]['counter'][$slot->getId()] = array(
                    'entry' => 0,
                    'exit' => 0
                );
                $hoursSpanArray[$key]['totalEntries'] = 0;
                $hoursSpanArray[$key]['totalExits'] = 0;

                foreach($slot->getStates() as $state) {

                    //If the state change
                    //it means either someone got or leaved the slot
                    if($state->getState() != $state->getLastState()){
                        if(!$state->getState()) {
                            $hoursSpanArray[$key]['counter'][$slot->getId()]['exit']++;// Count one exit for that slot for that hour
                        } else {
                            $hoursSpanArray[$key]['counter'][$slot->getId()]['entry']++;// Count one entry for that hour for that slot
                        }
                    }
                }

                //Sum of all entries/exits for an hour span
                foreach($hoursSpanArray[$key]['counter'] as $values) {
                    $hoursSpanArray[$key]['totalEntries']+= $values['entry'];
                    $hoursSpanArray[$key]['totalExits']+= $values['exit'];
                }


            }
            $this->em->clear();
        }
        return $hoursSpanArray;
    }



}
