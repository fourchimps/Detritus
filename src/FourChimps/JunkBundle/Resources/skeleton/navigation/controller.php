<?php

namespace {{ namespace }}\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
{% if 'annotation' == format -%}
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
{%- endif %}

/**
 * Dashboard controller.
 *
{% if 'annotation' == format %}
 * @Route("/nav")
{% endif %}
 */
class DashboardController extends Controller
{
    {% include 'actions/dashboard.php' %}
}
