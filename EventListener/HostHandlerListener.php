<?php

namespace Yoye\Bundle\HostHandlerBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class HostHandlerListener
{

    private $requestFormat;

    /**
     * __construct
     * 
     * @param array $requestFormat 
     */
    public function __construct(array $requestFormat)
    {
        $this->requestFormat = $requestFormat;
    }

    /**
     * Change request
     * 
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($event->getRequestType() === HttpKernelInterface::SUB_REQUEST) {
            return;
        }

        $request = $event->getRequest();

        $host = $request->headers->get('host');

        if (isset($this->requestFormat[$host])) {
            $request->setRequestFormat($this->requestFormat[$host]);
        }
    }

}