<?php

namespace DomTomProject\LoggerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use DomTomProject\LoggerBundle\ServiceBag;

class Configuration implements ConfigurationInterface {

    public function getConfigTreeBuilder(): TreeBuilder {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('domtom_logger');

        $rootNode
                ->children()
                    ->scalarNode('enabled')->defaultValue(true)->cannotBeEmpty()->end()
                    ->scalarNode('writer')->defaultValue(ServiceBag::WRITER_MYSQL)->cannotBeEmpty()->end()
                    ->scalarNode('log_stack')->defaultValue(ServiceBag::LOG_STACK)->cannotBeEmpty()->end()
                    ->arrayNode('mysql')->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('manager')->defaultValue('default')->cannotBeEmpty()->end()
                            ->end() 
                    ->end()
                    ->arrayNode('mongo')->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('manager')->defaultValue('default')->cannotBeEmpty()->end()
                        ->end() 
                    ->end()
                    ->arrayNode('plain')->addDefaultsIfNotSet()
                       ->children()
                            ->scalarNode('directory')->defaultValue('%kernel.root_dir%/Resources/logs')->end()
                        ->end() 
                    ->end()
                ->end();

        return $treeBuilder;
    }

}
