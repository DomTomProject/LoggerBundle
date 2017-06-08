<?php

namespace DomTomProject\LoggerBundle\Writer;

class PlainWriter implements WriterInterface {

    private $directory;

    public function __construct(string $directory) {
        $this->directory = $directory;
    }

    public function save(array $logs): void {
        $data = [];
        foreach ($logs as $log) {
            $methods = $this->getAllGetters($log);
            $filename = $this->getFilename($log);

            $line = '';
            foreach ($methods as $method) {
                $fieldName = '';
                $maxReplacements = 1;
                if (substr($method, 0, 3) === 'get') {
                    $fieldName = str_replace('get', '', $method, $maxReplacements);
                }
                if (substr($method, 0, 2) === 'is') {
                    $fieldName = str_replace('is', '', $method, $maxReplacements);
                }

                if ($method === 'getCreatedAt') {
                    $line = $log->$method()->format('Y-M-d h-i-s')  . $line;
                    continue;
                }

                $value = $log->$method();
                if ($value !== null) {
                    $line .= ' | ' . $fieldName . ' : ' . strval($value);
                }
            }
            $line = $line . "\n";
            $data[$filename] = $line;
        }

        foreach ($data as $filename => $line) {
            if (!is_dir($this->directory)) {
                mkdir($this->directory);
            }

            file_put_contents($this->directory . '/' . $filename . '.log', $line, FILE_APPEND);
        }
    }

    private function getAllGetters($log): array {
        $allMethods = get_class_methods(get_class($log));
        $filteredMethods = array_map(function($method) {
            if ((substr($method, 0, 3) === 'get' || substr($method, 0, 2) === 'is') && $method !== 'getUnique') {
                return $method;
            }
        }, $allMethods);

        return array_filter($filteredMethods);
    }

    private function getFilename($log) {
        $class = explode('\\', get_class($log));
        return end($class);
    }

}
