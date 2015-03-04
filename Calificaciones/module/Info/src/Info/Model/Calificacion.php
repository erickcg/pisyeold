<?php
namespace Info\Model;

class Calificacion
{
	public $id;
	public $disposicion;
	public $participacion;
	public $parcial2;
	public $parcial1;
	public $idMaestro;
	public $idAlumno;
	public $puntualidad;
	public $tareas;
	public $idClase;

	 public function exchangeArray($data)
	 {
	 	$this->id = (isset($data['id'])) ? $data['id'] : null;
	 	$this->idClase = (isset($data['idClase'])) ? $data['idClase'] : null;
		$this->tareas = (isset($data['tareas'])) ? $data['tareas'] : null;
		$this->idMaestro = (isset($data['idMaestro'])) ? $data['idMaestro'] : null;
		$this->parcial1 = (isset($data['parcial1'])) ? $data['parcial1'] : null;
		$this->parcial2 = (isset($data['parcial2'])) ? $data['parcial2'] : null;
		$this->participacion = (isset($data['participacion'])) ? $data['participacion'] : null;
		$this->disposicion = (isset($data['disposicion'])) ? $data['disposicion'] : null;
		$this->puntualidad = (isset($data['puntualidad'])) ? $data['puntualidad'] : null;
		$this->idAlumno = (isset($data['idAlumno'])) ? $data['idAlumno'] : null;
	 }

	 public function getArrayCopy()
	{
	    return get_object_vars($this);
	}
}