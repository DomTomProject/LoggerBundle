<?php

namespace DomTomProject\LoggerBundle\Writer;

use Doctrine\ORM\EntityManagerInterface;
use DomTomProject\LoggerBundle\EntityManagerProvider;

class MySQLWriter implements WriterInterface {

    private $em;
    public function __construct(EntityManagerProvider $em) {
        $this->em = $em->provide();
    }

    public function save(array $logs): void {
        foreach ($logs as $log) {
            $this->em->persist($log);
        }
        $this->em->flush();
    }

}
