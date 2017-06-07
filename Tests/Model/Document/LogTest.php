<?php

namespace DomTomProject\LoggerBundle\Tests\Model\Document;

use PHPUnit_Framework_TestCase as TestCase;
use DomTomProject\LoggerBundle\Model\Document\Log;
use DateTime;

class LogTest extends TestCase {

    public function testGetCeatedAt() {
        $log = new Log();

        $this->assertNotEmpty($log->getCeatedAt());
        $this->assertInstanceOf(DateTime::class, $log->getCeatedAt());
    }

    public function testGetId() {
        $log = new Log();

        $this->assertEmpty($log->getId());
    }

    public function testGetPriority() {
        $log = new Log();
        
        $this->assertEquals(Log::PRIORITY_LOW, $log->getPriority());
    }

    public function testIsFailure() {
        $log = new Log();

        $this->assertFalse($log->isFailure());

        $log->setFailure(true);

        $this->assertTrue($log->isFailure());
    }

    public function testGetCreatedMicrotime() {
        $log = new Log();
        
        $this->assertNotEmpty($log->getCreatedMicrotime());
        $this->assertInternalType('float', $log->getCreatedMicrotime());
    }

}
