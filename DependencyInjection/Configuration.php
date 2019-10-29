<?php

/*
 * This file is part of the FOSUserBundle package.
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IPHIS\Adldap2Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('iphis_adldap2');

        $treeBuilder->getRootNode()
            ->children()
            ->arrayNode('connection_settings')
            ->children()
            ->arrayNode('domain_controllers')
            ->prototype('scalar')->end()
            ->isRequired()
            ->requiresAtLeastOneElement()
            ->end()
            ->integerNode('port')
            ->end()
            ->scalarNode('account_suffix')
            ->end()
            ->scalarNode('base_dn')
            ->isRequired()
            ->cannotBeEmpty()
            ->end()
            ->scalarNode('admin_username')
            ->isRequired()
            ->cannotBeEmpty()
            ->end()
            ->scalarNode('admin_password')
            ->isRequired()
            ->cannotBeEmpty()
            ->end()
            ->booleanNode('follow_referrals')
            ->defaultFalse()
            ->end()
            ->booleanNode('use_ssl')
            ->defaultFalse()
            ->end()
            ->booleanNode('use_tls')
            ->defaultFalse()
            ->end()
            ->booleanNode('use_sso')
            ->defaultFalse()
            ->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
