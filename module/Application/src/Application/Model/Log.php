<?php
namespace Application\Model;

class Log
{
    public $id;
	public $message;
	public $priority;

	public function __construct()
	{
	    	 $this->logmessage = "Empty Message";
	}

	public function exchangeArray($data)
	{
		$this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->message     = (isset($data['message'])) ? $data['message'] : null;
        $this->priority     = (isset($data['priority'])) ? $data['priority'] : null;
	}
	
}