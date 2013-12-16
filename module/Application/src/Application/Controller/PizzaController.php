<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Pizza;
use Application\Model\Order;
use Zend\EventManager\EventManager;
use Application\Service\OrderService;
use Application\Model\Log;


class PizzaController extends AbstractActionController
{
    // Logger with table
    protected $logTable;

    public function logMessage($message, $priority)
    {
    	if (!$this->logTable) {
    		$sm = $this->getServiceLocator();
    		$this->logTable = $sm->get('Application\Model\LogTable');
    	}
    	$log = new Log();
    	$log->message = __CLASS__ . " : " . $message;
    	$log->priority = $priority;
    	$this->logTable->saveLog($log);
    	return $this;
    }
    // Logger
    
    
    public function indexAction()
    {
        $pizza = new Pizza("Pizza Mafia", array("Schinken", "Pepperoni", "Tomaten"));
        print_r ($pizza);
        print "<br />";
        
        $eventManager = new EventManager();

        $eventManager->attach('postOrder', function($e){
            print "300 Send order confirmation<br />";
        }, 300);
        $eventManager->attach('postOrder', function($e){
        	print "100 Update Stock<br />";
        }, 100);
        $eventManager->attach('postOrder', function($e){
        	print "200 Bake the pizza<br />";
        }, 200);
            
        $eventManager->attach('preOrder', function($e){
        	print "Check stock<br />";
        });
        
        $orderService = new OrderService();
        $orderService->setEventManager($eventManager);
        
        $order = new Order();
        $order->customer = "Juergen Pemsel";
        $order->items = array('Pizza Mafia', 'Pizza Napoli');
        print_r($order);
        print "<br />";
        
        // $this->logMessage('Neue Nachricht ins Log schreiben', 100);
        

        // Create the view
        $layout = $this->layout();
        $logview = new ViewModel(
        	array (
        	   'logmessage' => "Montag, 9. Dezember 2013 LogMessage"
            )
        );
        $logview->setTemplate('layout/log');
        $layout->addChild($logview, 'log');
        
        $view = new ViewModel(
	       array(
	           'pizza' => "Pizza",
	           'numbers' => array(1, 2, 3, 4, 5, 6),
               'messageQueue' => $orderService->saveOrder($order)
	       )
        );
        $view->setTemplate('application/pizza/index');

        return $view;
        
    }
}


