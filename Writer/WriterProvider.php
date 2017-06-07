<?php

namespace DomTomProject\LoggerBundle\Writer;

use DomTomProject\LoggerBundle\ServiceBag;

class WriterProvider implements WriterProviderInterface {

    private $writer;
    
    public function __construct(Container $container) {
        $writerServiceName = $container->getParameter(ServiceBag::PARAM_WRITER);
        $this->writer = $container->get($writerServiceName);
    }

    public function provide(): WriterInterface {
        return $this->writer;
    }

}
