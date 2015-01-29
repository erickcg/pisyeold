<?php
namespace Registro\Model;

class Participante
{
	public $id;
	public $nombre;
	public $apellido_paterno;
	public $apellido_materno;
	public $email;
	public $tel_cel;
	public $estado;
	public $ciudad;
	public $institucion;
	public $grado;

	 public function exchangeArray($data)
	 {
		$this->nombre = (isset($data['nombre'])) ? $data['nombre'] : null;
		$this->apellido_paterno = (isset($data['apellido_paterno'])) ? $data['apellido_paterno'] : null;
		$this->apellido_materno = (isset($data['apellido_materno'])) ? $data['apellido_materno'] : null;
		$this->email = (isset($data['email'])) ? $data['email'] : null;
		$this->tel_cel = (isset($data['tel_cel'])) ? $data['tel_cel'] : null;
		$this->estado = (isset($data['estado'])) ? $data['estado'] : null;
		$this->ciudad = (isset($data['ciudad'])) ? $data['ciudad'] : null;
		$this->institucion = (isset($data['institucion'])) ? $data['institucion'] : null;
		$this->grado = (isset($data['grado'])) ? $data['grado'] : null;
	 }
}