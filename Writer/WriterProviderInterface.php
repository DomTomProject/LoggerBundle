<?php

namespace DomTomProject\LoggerBundle\Writer;

interface WriterProviderInterface {
    
    public function provide() : WriterInterface;
    
}
