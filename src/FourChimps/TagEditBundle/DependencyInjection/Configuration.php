<?php

namespace FourChimps\TagEditBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * FourChimps TagEdit configuration
 *
 * @author Shaun Masterman < shaun@masterman.com >
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fourchimps_tag_edit');

        return $treeBuilder;
    }
}
