<?php

namespace DomTomProject\LoggerBundle\Stack;

use DomTomProject\LoggerBundle\Model\LogInterface;
use DomTomProject\LoggerBundle\Writer\WriterProviderInterface;

class LogStack implements LogStackInterface {

    private $writer;
    private $stack;
    private $isEnabled;

    public function __construct(WriterProviderInterface $writerProvider, bool $isEnabled) {
        $this->writer = $writerProvider->provide();
        $this->stack = [];
        $this->isEnabled = $isEnabled;
    }

    public function add(LogInterface $log) {
        if (!$this->isEnabled) {
            return;
        }

        $this->stack[spl_object_hash($log)] = $log;
    }

    public function remove(LogInterface $log) {
        if (!$this->isEnabled) {
            return;
        }

        unset($this->stack[spl_object_hash($log)]);
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
