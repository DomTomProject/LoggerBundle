<?php

namespace DomTomProject\LoggerBundle\Listener;

use Symfony\Component\HttpKernel\Event\PostResponseEvent;
use DomTomProject\LoggerBundle\Stack\LogStackProviderInterface;

class WriteLogListener {
    
    private $logStack;
    
    public function __construct(LogStackProviderInterface $provider){
        $this->logStack = $provider->provide();
    }
     
    public function onKernelTerminate(PostResponseEvent $event){
        $this->logStack->save();
    }
    
}
