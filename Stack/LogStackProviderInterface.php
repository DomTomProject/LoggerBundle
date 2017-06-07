<?php

namespace DomTomProject\LoggerBundle\Stack;

interface LogStackProviderInterface {
    
    public function provide() : LogStackInterface;
    
}
