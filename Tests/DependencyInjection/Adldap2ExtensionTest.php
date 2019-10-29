<?php

/*
 * This file is part of the Adldap2Bundle package.
 * (c) TK-Schulsoftware <https://tk-schulsoftware.de/>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IPHIS\Adldap2Bundle\Tests\DependencyInjection;

use Adldap\Schemas\ActiveDirectory;
use IPHIS\Adldap2Bundle\DependencyInjection\Adldap2Extension;
use IPHIS\Adldap2Bundle\Tests\Builder\BundleConfigurationBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Compiler\ResolveChildDefinitionsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class Adldap2ExtensionTest extends TestCase
{
    public function testPublicServicesAndAliases()
    {
        $container = $this->getContainer();
        $extension = new Adldap2Extension();
        $config = BundleConfigurationBuilder::createBuilderWithBaseValues()->build();
        $extension->load(array($config), $container);
        $this->assertTrue($container->getDefinition('adldap.default')->isPublic());
    }

    public function testDependencyInjectionConfigurationDefaults()
    {
        $container = $this->getContainer();
        $extension = new Adldap2Extension();
        $config = BundleConfigurationBuilder::createBuilderWithBaseValues()->build();
        $extension->load(array($config), $container);

        $this->compileContainer($container);
        $definition = $container->getDefinition('adldap.default');
        $args = $definition->getArguments();

        $this->assertSame(array('corp-dc1.corp.acme.org'), $args[0]['hosts']);
        $this->assertSame('dc=acme,dc=org', $args[0]['base_dn']);
        $this->assertSame('admin', $args[0]['username']);
        $this->assertSame('admin-pw', $args[0]['password']);
        $this->assertSame(ActiveDirectory::class, $args[0]['schema']);
    }

    private function getContainer()
    {
        $map = array();
        $container = new ContainerBuilder(new ParameterBag(array(
            'kernel.name' => 'app',
            'kernel.debug' => false,
            'kernel.bundles' => $map,
            'kernel.cache_dir' => sys_get_temp_dir(),
            'kernel.environment' => 'test',
            'kernel.root_dir' => __DIR__.'/../../', // src dir
        )));

        return $container;
    }

    private function compileContainer(ContainerBuilder $container)
    {
        $container->getCompilerPassConfig()->setOptimizationPasses(array(new ResolveChildDefinitionsPass()));
        $container->getCompilerPassConfig()->setRemovingPasses(array());
        $container->compile();
    }
}
