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
                if ($method === 'getCreatedAt') {
                    $line = $method . ' - ' . $line;
                    continue;
                }
                $line .= ' ' . $method;
            }

            $data[$filename] = $line;
        }

        foreach ($data as $filename => $line) {
            if (!is_dir($this->directory)) {
                mkdir($this->directory);
            }

            file_put_contents($this->directory . '/' . $filename, $line, FILE_APPEND);
        }
    }

    private function getAllGetters($log): array {
        $allMethods = get_class_methods(get_class($log));

        $filteredMethods = array_map(function($method) {
            if (substr($method, 0, 3) === 'get' || substr($method, 0, 2) === 'is') {
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
