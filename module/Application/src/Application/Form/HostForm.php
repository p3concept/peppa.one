<?php
namespace Application\Form;

use Zend\Form\Form;

class HostForm extends Form
{
	public function __construct($name = null)
	{
		parent::__construct('host');
	    $this->setAttribute('method', 'post');

		$this->add(array(
				'name' => 'id',
				'attributes' => array(
						'type'  => 'hidden',
				),
		));
		$this->add(array(
				'name' => 'ip',
				'attributes' => array(
						'type'  => 'text',
				),
				'options' => array(
						'label' => 'IP Address',
				),
		));
		$this->add(array(
				'name' => 'usage',
				'attributes' => array(
						'type'  => 'int',
				),
				'options' => array(
						'label' => 'Usage',
				),
		));
		$this->add(array(
				'name' => 'submit',
				'attributes' => array(
						'type'  => 'submit',
						'value' => 'Neuen_Host_eintragen',
						'id' => 'submitbutton',
				),
		));
	}
}