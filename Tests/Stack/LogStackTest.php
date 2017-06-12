<?php

namespace DomTomProject\LoggerBundle\Tests\Stack;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as TestCase;
use DomTomProject\LoggerBundle\ServiceBag;
use DomTomProject\LoggerBundle\Model\Log;
use DomTomProject\LoggerBundle\Stack\LogStack;
use DomTomProject\LoggerBundle\Writer\WriterProvider;

class LogStackTest extends TestCase {

    protected static $container;
    private $log;

    public static function setUpBeforeClass() {
        $kernel = self::createKernel();
        $kernel->boot();

        self::$container = $kernel->getContainer();
    }

    public function setUp() {
        $this->log = new Log();
    }

    public function testAdd() {
        $logstack = self::$container->get(ServiceBag::LOG_STACK);
        $logstack->add($this->log);

        $this->assertContains($this->log, $logstack->getStack());
    }

    public function testRemove() {
        $logstack = self::$container->get(ServiceBag::LOG_STACK);
        $logstack->add($this->log);
        $logstack->remove($this->log);

        $this->assertNotContains($this->log, $logstack->getStack());
    }

    public function testSave() {
        $logstack = self::$container->get(ServiceBag::LOG_STACK);
        $logstack->add($this->log);

        $logstack->setEnabled(false);
        $this->assertEmpty($logstack->save());
        
        $logstack->setEnabled(true);
    }

    public function testFailure() {
        $logstack = self::$container->get(ServiceBag::LOG_STACK);
        $logstack->add($this->log);

        $this->assertEmpty($logstack->failed());
        $this->assertTrue(array_values($logstack->getStack())[0]->isFailure());
    }
    
    public function testGetStack(){
        $this->testAdd();
    }
    
    public function testClear(){
        $logstack = self::$container->get(ServiceBag::LOG_STACK);
        $logstack->add($this->log);
        $logstack->clear();
        
        $this->assertNotContains($this->log, $logstack->getStack());
    }
    
    public function testSetEnabled(){
        $logstack = self::$container->get(ServiceBag::LOG_STACK);
        $logstack->add($this->log);
        
        $this->assertContains($this->log, $logstack->getStack());
        
        $logstack->clear();
        $logstack->setEnabled(false);
        $logstack->add($this->log);
        
        $this->assertNotContains($this->log, $logstack->getStack());
        
        $logstack->setEnabled(true);
        
    }

}
