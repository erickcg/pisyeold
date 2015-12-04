<?php
namespace Hagane\Model;

class Administrador {
	private $nombre;
	private $apellidoPaterno;
	private $apellidoMaterno;

	private $classModel;

	function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('Select * from Administrador join User where User.id = Administrador.idUser AND User.id = :id', $data);

			$this->nombre = $userArray['nombre'];
			$this->apellidoPaterno = $userArray['apellido_paterno'];
			$this->apellidoMaterno = $userArray['apellido_materno'];

			$this->classModel = new \Hagane\Model\Clase($auth, $db);
		}
	}

	function getMyClass($id = 0, $type) {
		if ($id == 0) {
			if (isset($type)) {
				return $this->classModel->getClaseByType($type);
			} else {
				return $this->classModel->getClase();
			}
		} else {
			return $this->classModel->getClaseById($id);
		}
	}

	function getGrades($claseId, $alumnoId) {
		return $this->classModel->getGrades($claseId, $alumnoId);
	}

	function getAllGrades($alumnoId) {
		return $this->classModel->getAllGrades($alumnoId);
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