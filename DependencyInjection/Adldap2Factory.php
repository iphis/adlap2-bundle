<?php

/*
 * This file is part of the FOSUserBundle package.
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IPHIS\Adldap2Bundle\DependencyInjection;

use Adldap\Adldap;
use Adldap\Connections\Provider;

class Adldap2Factory
{
    public static function createConnection(array $config)
    {
        $ad = new Adldap();
        $ad->addProvider(new Provider($config));
        $ad->connect();

        return $ad;
    }
}
