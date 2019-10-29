<?php

/*
 * This file is part of the Adldap2Bundle package.
 * (c) TK-Schulsoftware <https://tk-schulsoftware.de/>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IPHIS\Adldap2Bundle\Tests\Builder;

class BundleConfigurationBuilder
{
    /** @var array */
    private $configuration;

    public static function createBuilder()
    {
        return new self();
    }

    public static function createBuilderWithBaseValues()
    {
        $builder = new self();
        $builder->addBaseConnection();

        return $builder;
    }

    public function addBaseConnection()
    {
        $this->addConnection('default', array(
            'hosts' => array(
                'corp-dc1.corp.acme.org',
            ),
            'base_dn' => 'dc=acme,dc=org',
            'username' => 'admin',
            'password' => 'admin-pw',
        ));

        return $this;
    }

    public function addConnection($name, $config)
    {
        $this->configuration[$name] = $config;

        return $this;
    }

    public function build()
    {
        return $this->configuration;
    }
}
