<?php

namespace DomTomProject\LoggerBundle\Stack;

use DomTomProject\LoggerBundle\Model\LogInterface;

interface LogStackInterface {

    public function add(LogInterface $log);

    public function remove(LogInterface $log);

    public function save();

    public function failed();
}
