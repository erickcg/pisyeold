<?php
namespace Hagane\Model;

class Administrador {
	private $nombre;
	private $apellidoPaterno;
	private $apellidoMaterno;
	
	function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('Select * from Administrador join User where User.id = Administrador.idUser AND User.id = :id', $data);

			$this->nombre = $userArray['nombre'];
			$this->apellidoPaterno = $userArray['apellido_paterno'];
			$this->apellidoMaterno = $userArray['apellido_materno'];
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
}

?>