<?php

namespace FourChimps\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Dashboard controller.
 *
 * @Route("/nav")
 */
class DashboardController extends Controller
{

    /**
     * @Route("/dashboard", name="dashboard")
     * @Template()
     */
    public function dashboardAction() {

        return array();
    }

}