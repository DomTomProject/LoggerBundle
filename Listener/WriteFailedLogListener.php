<?php

namespace DomTomProject\LoggerBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use DomTomProject\LoggerBundle\Stack\LogStackProviderInterface;

class WriteFailedLogListener {
    
    private $logStack;
    
    public function __construct(LogStackProviderInterface $provider){
        $this->logStack = $provider->provide();
    }
     
    public function onKernelException(GetResponseForExceptionEvent $event){
        $this->logStack->failed();
        $this->logStack->save();
    }
    
}
