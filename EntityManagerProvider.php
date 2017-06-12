<?php

namespace DomTomProject\LoggerBundle;

use Symfony\Component\DependencyInjection\Container;
use Doctrine\ORM\EntityManagerInterface;

class EntityManagerProvider {

    private $em;

    public function __construct(Container $container) {
        $emName = $container->getParameter('domtom_logger.mysql.manager');
        if ($emName === 'default') {
            $this->em = $container->get('doctrine.orm.entity_manager');
        }
        $this->em = $container->get('doctrine.orm.' . $emName . '_entity_manager');
    }

    public function provide(): EntityManagerInterface {
        return $this->em;
    }

}
