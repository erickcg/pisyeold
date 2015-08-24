<?php
namespace Hagane\Model;

include_once('AdministradorUserModel.php');
include_once('MaestroUserModel.php');
include_once('AlumnoUserModel.php');

class User implements UserInterface {
	private $username;
	private $userType;
	private $imgPath;
	private $admon;
	private $maestro;
	private $alumno;
	
	public function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('Select * from User where id = :id', $data);

			$this->username = $userArray['user'];
			$this->userType = $userArray['user_type'];
			$this->imgPath = $userArray['imgPath'];
			if ($this->userType == 'Administrador') {
				$this->admon = new \Hagane\Model\Administrador($auth, $db);
			} elseif ($this->userType == 'Maestro') {
				$this->maestro = new \Hagane\Model\Maestro($auth, $db);
			} elseif ($this->userType == 'Alumno') {
				$this->alumno = new \Hagane\Model\Alumno($auth, $db);
			}
		}
	}

	public function getUsername() {
		return $this->username;
	}

	public function getUserType() {
		return $this->userType;
	}

	public function getImgPath() {
		return $this->imgPath;
	}

	public function getUserObject() {
		if ($this->userType == 'Administrador') {
			return $this->admon;
		} elseif ($this->userType == 'Maestro') {
			return $this->maestro;
		} elseif ($this->userType == 'Alumno') {
			return $this->alumno;
		}
	}

	public function getNombreCompleto() {
		if ($this->userType == 'Administrador') {
			return $this->admon->getNombre().' '.$this->admon->getApellidoPaterno().' '.$this->admon->getApellidoMaterno();
		} elseif ($this->userType == 'Maestro') {
			return $this->maestro->getNombre().' '.$this->maestro->getApellidoPaterno().' '.$this->maestro->getApellidoMaterno();
		}
	}
}

?>