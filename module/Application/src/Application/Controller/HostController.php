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
use Application\Model\Host;
use Application\Form\HostForm;

class HostController extends AbstractActionController
{
    protected  $hostTable;
    
    public function indexAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0); /* get url parameter */
        return new ViewModel(
	       array('hostlist' => $this->getHostTable()->fetchAllOrdered(), 'id' => $id)
        );
    }

    public function addAction()
    {
    	$form = new HostForm();
    	$form->get('submit')->setValue('Neuen Host jetzt anlegen');
    
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$host = new Host();

    		$form->setInputFilter($host->getInputFilter());
    		$form->setData($request->getPost());
    		
    		if ($form->isValid()) {
    			$host->exchangeArray($form->getData());
    			$this->getHostTable()->saveHost($host);
    
    			// Redirect to list of hosts
    			return $this->redirect()->toRoute('host');
    		}
    	}
    	return array('form' => $form);
    }
        
    public function populateAction()
    {
        $host = new Host();
        $host->id = 0;
        
        for ($i=1; $i<=12; $i++) {
   		   $host->ip = '192.168.178.' . rand(1,255);
   		   $host->usage = rand(0,100) ;
    	   $this->getHostTable()->saveHost($host);
        }
    	return new ViewModel (
    	    array('newhost' => array('id'=>99, 'ip'=>'xxxxxxx', 'usage'=>99))
    	);
    }
    
    public function getHostTable()
    {
    	if (!$this->hostTable) {
    		$sm = $this->getServiceLocator();
        	$this->hostTable = $sm->get('Application\Model\HostTable');
    	}
    	return $this->hostTable;
    }
    

}

