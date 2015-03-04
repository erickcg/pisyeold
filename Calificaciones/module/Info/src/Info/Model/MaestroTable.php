<?php
namespace Info\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class MaestroTable
{
	protected $tableGateway;
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function saveMaestro(Maestro $maestro)
	{
		$data = array(
			'nombre' => $maestro->nombre
			);

		$id = (int) $maestro->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getMaestro($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('No existe');
			}
		}
	}

	public function getMaestro($id)
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