<?php

namespace DomTomProject\LoggerBundle\Writer;

use DomTomProject\LoggerBundle\Writer\WriterInterface;
use Doctrine\ODM\MongoDB\DocumentManager;

class MongoDBWriter implements WriterInterface {
    
    private $dm;
    
    public function __construct(DocumentManager $dm) {
        $this->dm = $dm;
    }
    
    public function save(array $logs): void {
        foreach($logs as $log){
            $this->dm->persist($log);
        }
        $this->dm->flush();
    }

}
