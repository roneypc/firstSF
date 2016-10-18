<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//session_start();
class LuckyController extends Controller {

    /**
     * @Route("/lucky/number")
     */
    public function numberAction() {
		if(!isset($_SESSION["attemp_counter"])) {
			$_SESSION["attemp_counter"] = 0;
		}
		$attemps = $_SESSION["attemp_counter"];
		$attemps += 1;
		$_SESSION["attemp_counter"] = $attemps;

        $number = mt_rand(0, 100);

        if($attemps % 5 == 0) {
	        $this->get('session')->getFlashBag()->add(
	            'notice',
	            'Has llegado a ' . $attemps . '!!!'
	        );        	
        }

        return $this->render('lucky/number.html.twig', array(
            'number' => $number,
            'attemps' => $attemps
        ));
    }
}