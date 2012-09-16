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
            array('name'=>'TagGroup'),
        );

        return array(
            'tables' => $tables
        );
    }

    /**
     * @Route("/{$table}/tablestats", name="tablestats")
     * @Template()
     */
    public function tablestatsAction($table) {

        $repoName = "FourChimpsArticleBundle:{$table}";

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository($repoName);
$x=$repo->getTableStats();
        return array(
            'table' => $table,
            'tableStats' => $repo->getTableStats(),
         //   'metadata' => $repo->getClassMetadata(),
        );

    }


}