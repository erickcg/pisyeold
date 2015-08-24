<?php
namespace Info\Model;

class Alumno
{
	public $id;
	public $nombre;
	public $activo;

	 public function exchangeArray($data)
	 {
	 	$this->id = (isset($data['id'])) ? $data['id'] : null;
		$this->activo = (isset($data['activo'])) ? $data['activo'] : 'y';
		$this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
	 }

	 public function getArrayCopy()
	{
	    return get_object_vars($this);
	}
}