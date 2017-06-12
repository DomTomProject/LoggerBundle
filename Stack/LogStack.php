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

    public function add(LogInterface $log): void {
        if (!$this->isEnabled) {
            return;
        }

        $this->stack[spl_object_hash($log)] = $log;
    }

    public function remove(LogInterface $log): void {
        if (!$this->isEnabled) {
            return;
        }

        unset($this->stack[spl_object_hash($log)]);
    }

    public function save(): void {
        if (empty($this->stack) || !$this->isEnabled) {
            return;
        }
        $this->writer->save($this->stack);
    }

    public function failed(): void {
        if (empty($this->stack)) {
            return;
        }

        foreach ($this->stack as &$log) {
            $log->setFailure(true);
        }
    }

    public function getStack(): array {
        return $this->stack;
    }

    public function clear(): void {
        $this->stack = [];
    }

    public function setEnabled(bool $enabled): void {
        $this->isEnabled = $enabled;
    }

}
