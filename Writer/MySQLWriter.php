<?php


namespace DomTomProject\LoggerBundle\Writer;

use Doctrine\ORM\EntityManagerInterface;

class MySQLWriter implements WriterInterface{
    
    private $em;
    
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }
    
    public function save(array $logs): void {
        foreach($logs as $log){
            $this->em->persist($log);
        }
        $this->em->flush();
    }

    
}
