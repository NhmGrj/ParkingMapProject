<?php
namespace ParkingMapBundle\Service;

class TimeHandler {
    public $currentTime;



    public function __construct() {
        $this->currentTime = new \DateTime();
    }

    public function getTime() {
        return $this->currentTime;
    }

    public function subHours($hoursNb) {
        return $this->currentTime->sub(new \DateInterval("PT".$hoursNb."H"));
    }
    public function addMins($minsNb) {
        return $this->currentTime->add(new \DateInterval("PT".$minsNb."M"));
    }

    public function getSpanHoursArray($hoursNb, $hoursSpan) {
        $hoursArray = [];
        $time = new \DateTime();
        for ($i=0; $i <= $hoursNb; $i++) {
            $hoursArray[] = array(
                'current' => new \DateTime($time->format("Y-m-d H:i:s")),
                'prevHour' => new \DateTime($time->sub(new \DateInterval("PT".$hoursSpan."H"))->format("Y-m-d H:i:s")),

            );
        }
        return $hoursArray;
    }


}
