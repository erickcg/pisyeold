<?php
namespace Info\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class ClaseTable
{
	protected $tableGateway;
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function saveClase(Clase $clase)
	{
		$data = array(
			'nombre' => $clase->nombre
			);

		$id = (int) $clase->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getClase($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('No existe');
			}
		}
	}

	public function getClase($id)
	{
		$id  = (int)$id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
	
	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}
}