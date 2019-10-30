<?php

/*
 * This file is part of the Adldap2Bundle package.
 * (c) TK-Schulsoftware <https://tk-schulsoftware.de/>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IPHIS\Adldap2Bundle\DependencyInjection;

use Adldap\Schemas\ActiveDirectory;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        /** @noinspection PhpParamsInspection */
        $treeBuilder = new TreeBuilder('adldap2');
        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
	        /** @scrutinizer ignore-deprecated */
            $rootNode = $treeBuilder->root('adldap2');
        }

        $rootNode
	        /** @scrutinizer ignore-call */
	        ->requiresAtLeastOneElement()
            ->useAttributeAsKey('name')
            ->prototype('array')

            ->arrayNode('hosts')->prototype('scalar')->end()->isRequired()->requiresAtLeastOneElement()->end()
            ->scalarNode('base_dn')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('username')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('password')->isRequired()->cannotBeEmpty()->end()
            ->integerNode('port')->defaultValue(389)->end()
            ->scalarNode('schema')->defaultValue(ActiveDirectory::class)->end()
            ->booleanNode('auto_connect')->defaultTrue()->end()
            ->scalarNode('account_prefix')->end()
            ->scalarNode('account_suffix')->end()
            ->booleanNode('follow_referrals')->defaultFalse()->end()
            ->booleanNode('use_ssl')->defaultFalse()->end()
            ->booleanNode('use_tls')->defaultFalse()->end()
            ->scalarNode('version')->defaultValue(3)->end()
            ->scalarNode('timeout')->defaultValue(5)->end()
            ->end();

        return $treeBuilder;
    }
}
