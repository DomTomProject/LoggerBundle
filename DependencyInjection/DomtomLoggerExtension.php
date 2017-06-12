<?php

namespace DomTomProject\LoggerBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class DomtomLoggerExtension extends Extension {

    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('domtom_logger.writer', $config['writer']);
        $container->setParameter('domtom_logger.log_stack', $config['log_stack']);
        $container->setParameter('domtom_logger.enabled', $config['enabled']);
        
        $container->setParameter('domtom_logger.plain.directory', $config['plain']['directory']);
        
        $container->setParameter('domtom_logger.mongo.manager', $config['mongo']['manager']);
        
        $container->setParameter('domtom_logger.mysql.manager', $config['mysql']['manager']);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('services.yml');
    }

}
