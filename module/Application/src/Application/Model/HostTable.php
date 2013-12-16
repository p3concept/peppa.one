<?php
namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;
use Application\Model\Host;

class HostTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
    
	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
        return $resultSet;
	}
	
	public function fetchAllOrdered()
	{
		$resultSet = $this->tableGateway->select(function (Select $select) {
       		$select->order('usage DESC');
		});
		return $resultSet;
	}
	
	public function getHost($id) 
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Host: Could not find row $id");
		}
		return $row;
	}
	
	
	public function saveHost(Host $host)
	{
		$data = array(
		        'ID' => $host->id,
				'IP' => $host->ip,
				'Usage'  => $host->usage,
		);

		$id = (int)$host->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getHost($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Host: Form id does not exist');
			}
		}
	}
	
	
}