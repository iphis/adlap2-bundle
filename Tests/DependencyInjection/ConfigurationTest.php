<?php

/*
 * This file is part of the Adldap2Bundle package.
 * (c) TK-Schulsoftware <https://tk-schulsoftware.de/>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IPHIS\Adldap2Bundle\Tests\DependencyInjection;

use IPHIS\Adldap2Bundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * Whether or not this test should preserve the global state when
     * running in a separate PHP process.
     *
     * PHPUnit hack to avoid currently loaded classes to leak to
     * testGetConfigTreeBuilderDoNotUseDoctrineCommon that is run in separate process.
     *
     * @var bool
     */
    protected $preserveGlobalState = false;

    /**
     * @runInSeparateProcess
     */
    public function testGetConfigTreeBuilderDoNotUseDoctrineCommon()
    {
        $configuration = new Configuration();
        $configuration->getConfigTreeBuilder();
        $this->assertFalse(class_exists('Adldap\Adldap', false));
    }
}
