<?php
namespace Registro\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class ParticipanteTable
{
 protected $tableGateway;
 public function __construct(TableGateway $tableGateway)
 {
 $this->tableGateway = $tableGateway;
 }

 public function saveParticipante(Participante $participante)
 {
 	$mysqltime = date ("Y-m-d H:i:s");

	 $data = array(
		 'nombre' => $participante->nombre,
		 'apellido_paterno' => $participante->apellido_paterno,
		 'apellido_materno' => $participante->apellido_materno,
		 'email' => $participante->email,
		 'tel_cel' => $participante->tel_cel,
		 'estado' => $participante->estado,
		 'ciudad' => $participante->ciudad,
		 'institucion' => $participante->institucion,
		 'grado' => $participante->grado,
		 'fecha_inscripcion' => $mysqltime,

	 );

 $id = (int)$participante->id;
 if ($id == 0) {
 	$this->tableGateway->insert($data);
 } else {
	 if ($this->getParticipante($id)) {
	 	$this->tableGateway->update($data, array('id' => $id));
	 } else {
		 throw new \Exception('No existe');
		 }
	 }
 }
 public function getParticipante($id)
 {
	 $id = (int) $id;
	 $rowset = $this->tableGateway->select(array('id' => $id));
	 $row = $rowset->current();
	 if (!$row) {
	 	throw new \Exception("Could not find row $id");
	 }
	 return $row;
	 }
}