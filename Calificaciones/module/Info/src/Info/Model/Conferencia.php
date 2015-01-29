<?php
namespace Info\Model;

class Conferencia
{
	public $id;
	public $nombre;
	public $informacion;
	public $carrera;

	 public function exchangeArray($data)
	 {
	 	$this->id = (isset($data['id'])) ? $data['id'] : null;
		$this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
		$this->informacion = (isset($data['informacion'])) ? $data['informacion'] : null;
		$this->carrera = (isset($data['carrera'])) ? $data['carrera'] : null;
	 }

	 public function getArrayCopy()
	{
	    return get_object_vars($this);
	}
}