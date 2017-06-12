<?php

namespace DomTomProject\LoggerBundle\Tests\Model\Document;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as TestCase;
use DomTomProject\LoggerBundle\Model\Document\Log;
use DateTime;

class LogTest extends TestCase {

    public function testGetCreatedAt() {
        $log = new Log();

        $this->assertNotEmpty($log->getCreatedAt());
        $this->assertInstanceOf(DateTime::class, $log->getCreatedAt());
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


}
