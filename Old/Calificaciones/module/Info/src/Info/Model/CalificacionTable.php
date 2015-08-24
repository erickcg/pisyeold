<?php
namespace Info\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;

class CalificacionTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function saveCalificacion(Calificacion $calificacion)
	{
		$data = array(
			'puntualidad' => $calificacion->puntualidad,
			'parcial1' => $calificacion->parcial1,
			'parcial2' => $calificacion->parcial2,
			'participacion' => $calificacion->participacion,
			'disposicion' => $calificacion->disposicion,
			'tareas' => $calificacion->tareas,
			);

		$id = (int) $calificacion->id;
		if ($id == 0) {
			$data['idClase'] = $calificacion->idClase;
			$data['idAlumno'] = $calificacion->idAlumno;
			$this->tableGateway->insert($data);
		} else {
			if ($this->getCalificacion($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('No existe');
			}
		}
	}

	public function getCalificacion($id)
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

	public function fetchClase($clase)
	{
		$select = $this->tableGateway->getSql()->select()->join('Alumno','Alumno.id = Calificacion.idAlumno')->where(array('Calificacion.idClase' => $clase));
		$resultSet = $this->tableGateway->selectWith($select);

		$resultSet = $this->tableGateway->select(array('idClase' => $clase));

		return $resultSet;
	}
}