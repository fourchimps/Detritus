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
        $tables = array(
            array('name'=>'Article'),
            array('name'=>'Tag'),
            array('name'=>'Tag Group'),
        );

        return array(
            'tables' => $tables
        );
    }

    /**
     * @Route("/{$table}/tablestats", name="tablestats")
     * @Template()
     */
    public function tableAction($table) {

        $repoName = "FourChimpsArticleBundle:{$table}";

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository($repoName);

        return array(
            'tablestats ' => $repo->getTableStats(),
            'metadata' => $repo->getClassMetadata(),
        );

    }


}