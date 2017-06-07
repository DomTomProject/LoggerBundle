<?php

namespace DomTomProject\LoggerBundle\Stack;

use DomTomProject\LoggerBundle\Model\LogInterface;
use DomTomProject\LoggerBundle\Writer\WriterProviderInterface;

class LogStack implements LogStackInterface {

    private $writer;
    private $stack;

    public function __construct(WriterProviderInterface $writerProvider) {
        $this->writer = $writerProvider->provide();
        $this->stack = [];
    }

    public function add(LogInterface $log) {
        $this->stack[$log->getCreatedMicrotime()] = clone $log;
    }

    public function remove(LogInterface $log) {
        unset($this->stack[$log->getCreatedMicrotime()]);
    }

    public function update(LogInterface $log) {
        $id = $log->getCreatedMicrotime();
        if (isset($this->stack[$id])) {
            $this->stack[$id] = clone $log;
            return;
        }
        $this->stack[] = clone $log;
    }

    public function save() {
        if (empty($this->stack)) {
            return;
        }
        $this->writer->save($this->stack);
    }

    public function failed() {
        if (empty($this->stack)) {
            return;
        }
        
        foreach ($this->stack as &$log) {
            $log->setFailure(true);
        }
        $this->writer->save($this->stack);
    }

}
