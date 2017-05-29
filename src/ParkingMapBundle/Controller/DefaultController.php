<?php

namespace ParkingMapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->container->get('doctrine');
        $th = $this->container->get('pkm.time_handler');
        $slotsRepository = $em->getRepository('ParkingMapBundle:Slots');
        $statesRepository = $em->getRepository('ParkingMapBundle:State');
        $nbHours = 10;
        $hoursSpan = 1;
        $hoursSpanArray = $th->getSpanHoursArray($nbHours, $hoursSpan);


        $trafficByHoursSpan = $slotsRepository->getEntriesByHoursSpan($hoursSpanArray);
        $slotsNb = $slotsRepository->getSlotsNb();
        $slots = $slotsRepository->findAll();
        $freeSlotsNb = $slotsRepository->getFreeSlotsNb();
        $freeSlots = $slotsRepository->getFreeSlots();

        return $this->render('ParkingMapBundle:Default:index.html.twig', array(
            "trafficByHoursSpan"  => $trafficByHoursSpan,
            "slotsNb"             => $slotsNb,
            "slots"               => $slots,
            "freeSlotsNb"         => $freeSlotsNb
        ));
    }
}
