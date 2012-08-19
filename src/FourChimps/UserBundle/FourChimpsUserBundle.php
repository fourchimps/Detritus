<?php

namespace FourChimps\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class FourChimpsUserBundle extends Bundle
{

    public function getParent()
    {
        return 'FOSUserBundle';
    }

}