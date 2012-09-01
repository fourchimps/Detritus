<?php

namespace FourChimps\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Navigation controller.
 *
 * @Route("/nav")
 */
class NavigationController extends Controller
{

    /**
     * @Route("/sidebar", name="_admin_sidebar")
     * @Template()
     */
    public function _sidebarAction() {

        $links = array(
            array('name'=>'Article', 'path' => $this->generateUrl('admin_article')),
            array('name'=>'Tag', 'path' => $this->generateUrl('admin_tag')),
            array('name'=>'Tag Group', 'path' => $this->generateUrl('admin_taggroup')),
        );

        return array(
            'links' => $links,
        );
    }

}