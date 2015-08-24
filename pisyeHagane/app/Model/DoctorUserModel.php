<?php
namespace Hagane\Model;

class Doctor {
	private $nombre;
	private $apellidoPaterno;
	private $apellidoMaterno;
	private $cedula;
	
	function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('Select * from Doctor join User where User.id = Doctor.idUser AND User.id = :id', $data);

			$this->nombre = $userArray['nombre'];
			$this->apellidoPaterno = $userArray['apellido_paterno'];
			$this->apellidoMaterno = $userArray['apellido_materno'];
			$this->cedula = $userArray['cedula'];
			
		}
	}

	function getNombre() {
		return $this->nombre;
	}

	function getApellidoPaterno() {
		return $this->apellidoPaterno;
	}

	function getApellidoMaterno() {
		return $this->apellidoMaterno;
	}

	function getCedula() {
		return $this->cedula;
	}
}

?>