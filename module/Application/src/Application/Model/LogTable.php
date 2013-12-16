<?php
namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\Log;

class LogTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function saveLog(Log $log)
	{
		$data = array(
				'message' => $log->message,
				'priority' => $log->priority,
		);
		$this->tableGateway->insert($data);
	}
		
}