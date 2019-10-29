<?php

/*
 * This file is part of the Adldap2Bundle package.
 * (c) TK-Schulsoftware <https://tk-schulsoftware.de/>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IPHIS\Adldap2Bundle\DependencyInjection;

use Adldap\Adldap;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class Adldap2Extension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        foreach (array_keys($config) as $connectionName) {
            $connectionSettings = $config[$connectionName];
            if (!empty($connectionSettings['account_suffix']) && !stristr($connectionSettings['account_suffix'], '@')) {
                $connectionSettings['account_suffix'] = '@'.$connectionSettings['account_suffix'];
            } elseif (empty($connectionSettings['account_suffix'])) {
                unset($connectionSettings['account_suffix']);
            }

            $service = $container->register('adldap.'.$connectionName, Adldap::class);
            $service->setFactory(
                array(
                    Adldap2Factory::class,
                    'createConnection',
                )
            );
            $service->setArguments(
                array(
                    $connectionSettings,
                )
            );
        }
    }

    public function getAlias()
    {
        return 'adldap2';
    }
}
