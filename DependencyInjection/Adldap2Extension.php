<?php

/*
 * This file is part of the FOSUserBundle package.
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
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
        $connectionSettings = $config['connection_settings'];
        if (!empty($connectionSettings['account_suffix'])) {
            $connectionSettings['account_suffix'] = '@'.$connectionSettings['account_suffix'];
        } else {
            unset($connectionSettings['account_suffix']);
        }
        $service = $container->register('adldap2', Adldap::class);
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

    public function getAlias()
    {
        return 'adldap2';
    }
}
