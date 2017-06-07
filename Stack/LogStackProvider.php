<?php

namespace DomTomProject\LoggerBundle\Stack;

use DomTomProject\LoggerBundle\ServiceBag;
use Symfony\Component\DependencyInjection\Container;

class LogStackProvider implements LogStackProviderInterface {

    private $logStack;

    public function __construct(Container $container) {
        $logStackServiceName = $container->getParameter(ServiceBag::LOG_STACK);
        $this->logStack = $container->get($logStackServiceName);
    }

    public function provide(): LogStackInterface {
        return $this->logStack;
    }

}
