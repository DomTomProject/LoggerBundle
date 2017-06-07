<?php

namespace DomTomProject\LoggerBundle\Writer;

interface WriterInterface {
    
    public function save(array $logs): void;
   
}
