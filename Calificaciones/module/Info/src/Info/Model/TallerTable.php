<?php
namespace Info\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class TallerTable
{
	protected $tableGateway;
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function saveTaller(Taller $taller)
	{
		$data = array(
			'nombre' => $taller->nombre,
			'informacion' => $taller->informacion,
			'carrera' => $taller->carrera
			);

		$id = (int) $taller->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getTaller($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('No existe');
			}
		}
	}

	public function getTaller($id)
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