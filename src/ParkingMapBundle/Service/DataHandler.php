<?php
namespace ParkingMapBundle\Service;

use Doctrine\ORM\EntityManager;
use ParkingMapBundle\Service\TimeHandler;
// use ParkingMapBundle\Repository\StateRepository;

class DataHandler {
    private $em;
    private $th;

    private $slotsRepository;


    public function __construct(EntityManager $em, TimeHandler $th) {

        $this->em = $em;
        $this->th = $th;
        $this->slotsRepository = $this->em->getRepository("ParkingMapBundle:Slots");
    }

    public function getEntriesByHoursSpan($hoursNb, $hoursSpan) {
        $hoursSpanArray = $this->th->getSpanHoursArray($hoursNb, $hoursSpan);

        foreach ($hoursSpanArray as $key => $hour) {
            $hoursSpanArray[$key]['counter'] = array();
            $hoursSpanArray[$key]['totalEntries'] = 0;
            $hoursSpanArray[$key]['totalExits'] = 0;

            $slots = $this->slotsRepository->findAllStatesByHoursSpan($hour['current'], $hour['prevHour']);

            foreach($slots as $slot) {
                $hoursSpanArray[$key]['counter'][$slot->getId()] = array(
                    'entry' => 0,
                    'exit' => 0
                );

                foreach($slot->getStates() as $state) {
                    if($state->getState() != $state->getLastState()){
                        if($state->getState()) {
                            $hoursSpanArray[$key]['counter'][$slot->getId()]['entry']++;// Count one entry for that hour for that slot
                            $hoursSpanArray[$key]['totalEntries']++;
                        } else {
                            $hoursSpanArray[$key]['counter'][$slot->getId()]['exit']++;// Count one exit for that slot for that hour
                            $hoursSpanArray[$key]['totalExits']++;
                        }
                    }
                }
            }
            $this->em->clear();
        }
        return $hoursSpanArray;
    }



}
