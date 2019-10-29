<?php

/*
 * This file is part of the Adldap2Bundle package.
 * (c) TK-Schulsoftware <https://tk-schulsoftware.de/>
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
        $autoConnect = isset($config['auto_connect']) ? $config['auto_connect'] : false;
        // We have to remove the `auto_connect` param here because the Adldap2 library
        // will thrown an exception because the config option doesn't exist.
        unset($config['auto_connect']);
        $ad = new Adldap();
        $ad->addProvider(new Provider($config));
        $ad->connect();
        if (true === $autoConnect) {
            $ad->connect();
        }

        return $ad;
    }
}
