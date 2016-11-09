<?php

namespace UserBundle;

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 09/11/2016
 * Time: 15:19
 */

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}