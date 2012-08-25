<?php

namespace FourChimps\CKEditorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * SevenCity CKEditor configuration
 *
 * Based on IvoryCKEditor by GeLo <geloen.eric@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fourchimps_ckeditor');

        return $treeBuilder;
    }
}
