<?php

namespace DomTomProject\LoggerBundle\Stack;

use DomTomProject\LoggerBundle\Model\LogInterface;

interface LogStackInterface {

    public function add(LogInterface $log): void;

    public function remove(LogInterface $log): void;

    public function save(): void;

    public function failed(): void;
    
    public function getStack(): array;
    
    public function setEnabled(bool $enabled): void;
    
    public function clear(): void;
}
