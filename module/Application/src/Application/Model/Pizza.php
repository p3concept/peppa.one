<?php
namespace Application\Model;


class Pizza
{
	public $name;
	public $zutaten;

	public function __construct($name, $zutaten)
	{
	    	 $this->name = $name;
	    	 $this->zutaten = $zutaten;
	}
	
	
}