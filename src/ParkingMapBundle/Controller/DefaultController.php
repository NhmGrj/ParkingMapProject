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
        $dataHandler = $this->container->get('pkm.data_handler');
        $em = $this->container->get('doctrine');
        $slotsRepository = $em->getRepository('ParkingMapBundle:Slots');
        $nbHour = 10;
        $hourSpan = 1;

        $trafficByHoursSpan = $dataHandler->getEntriesByHoursSpan($nbHour, $hourSpan);
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
