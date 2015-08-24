<?php
namespace Application\Model;

class Conferencia
{
	public $id;
	public $nombre;
	public $informacion;
	public $carrera;

	 public function exchangeArray($data)
	 {
		$this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
		$this->informacion = (isset($data['informacion'])) ? $data['informacion'] : null;
		$this->carrera = (isset($data['carrera'])) ? $data['carrera'] : null;
	 }
}