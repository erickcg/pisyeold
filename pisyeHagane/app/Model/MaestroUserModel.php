<?php
namespace Hagane\Model;

include_once('ClaseModel.php');

class Maestro {
	private $nombre;
	private $apellidoPaterno;
	private $apellidoMaterno;

	private $classModel;

	function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('Select * from Maestro join User where User.id = Maestro.idUser AND User.id = :id', $data);

			$this->nombre = $userArray['nombre'];
			$this->apellidoPaterno = $userArray['apellido_paterno'];
			$this->apellidoMaterno = $userArray['apellido_materno'];
			
			$this->classModel = new \Hagane\Model\Clase($auth, $db);
		}
	}

	function getMyClass($id = 0) {
		if ($id == 0) {
			return $this->classModel->getClase();
		} else {
			return $this->classModel->getClaseById($id);
		}
	}

	function getGrades($claseId, $alumnoId) {
		return $this->classModel->getGrades($claseId, $alumnoId);
	}

	function setGrades($claseId, $alumnoId, $p1, $p2) {
		return $this->classModel->setGrades($claseId, $alumnoId, $p1, $p2);
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