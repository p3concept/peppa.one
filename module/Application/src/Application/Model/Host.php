<?php
namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Host
{
	public $id;
	public $ip;
	public $usage;
	protected $inputFilter;

	
	public function exchangeArray($data)
	{
		$this->id     = (isset($data['id']))                  ? $data['id']          : null;
		$this->ip = (isset($data['ip']))                      ? $data['ip']           : null;
		$this->usage  = (isset($data['usage']))       ? $data['usage']   : null;
	}
	
	// InputFilter methods:
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}
	
    public function getInputFilter()
    	{
    		if (!$this->inputFilter) {
    			$inputFilter = new InputFilter();
    			$factory = new InputFactory();
    
    			$inputFilter->add($factory->createInput(array(
    					'name'     => 'id',
    					'required' => true,
    					'filters'  => array(
    							array('name' => 'Int'),
    					),
    			)));
    
    			$inputFilter->add($factory->createInput(array(
    					'name'     => 'ip',
    					'required' => true,
    					'filters'  => array(
    							array('name' => 'StripTags'),
    							array('name' => 'StringTrim'),
    					),
    					'validators' => array(
    							array(
    									'name'    => 'StringLength',
    									'options' => array(
    											'encoding' => 'UTF-8',
    											'min'      => 1,
    											'max'      => 100,
    									),
    							),
    					),
    			)));
    
    			$inputFilter->add($factory->createInput(array(
    					'name'     => 'usage',
    					'required' => true,
    					'filters'  => array(
    							array('name' => 'Int'),
    					),
    			)));
    			
    			$this->inputFilter = $inputFilter;
    		}
    
    		return $this->inputFilter;
    	}	
}