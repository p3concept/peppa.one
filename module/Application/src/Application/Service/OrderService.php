<?php

namespace Application\Service;

use Application\Model\Order;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;

class OrderService implements EventManagerAwareInterface 
{
    protected $events;
    
    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(__CLASS__, get_called_class()));
        $this->events = $events;
        return $this;
    }
    
    public function getEventManager()
    {
        if (null === $this->events) 
        {
            $this->setEventManager(new EventManager());
        }
        return $this->events;
    }
    
    public function saveOrder(Order $order)
    {
        $order->id = 99;
        $this->getEventManager()->trigger('preOrder' , __CLASS__);
        $mq[] = "Save order : " . $order->id;
        $mq[] = "OrderService ClassName: " . __CLASS__;
        $this->getEventManager()->trigger('postOrder' , __CLASS__);
        return $mq;
    }
    
}