<?php
namespace Application\Model;


class Order
{
    public $id;
    public $customer;
    public $items;
    
	public function __construct()
	{
	    	 $this->id = 0;
	}
	
	
}