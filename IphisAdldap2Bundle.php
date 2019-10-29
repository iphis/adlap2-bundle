<?php

/*
 * This file is part of the Adldap2Bundle package.
 * (c) TK-Schulsoftware <https://tk-schulsoftware.de/>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IPHIS\Adldap2Bundle;

use IPHIS\Adldap2Bundle\DependencyInjection\Adldap2Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class IphisAdldap2Bundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            return new Adldap2Extension();
        }

        return $this->extension;
    }
}
