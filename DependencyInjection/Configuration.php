<?php

namespace FL\WorldUniversitiesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('fl_world_universities');

        $rootNode
            ->children()
                ->scalarNode('path')
                    ->defaultValue('%kernel.root_dir%/Resources/WorldUniversities')
                ->end()
                ->scalarNode('source')
                    ->defaultValue('https://raw.githubusercontent.com/endSly/world-universities-csv/master/world-universities.csv')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
