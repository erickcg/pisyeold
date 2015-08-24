<?php
namespace Hagane\Model;

class Cliente {
	private $empresa;
	private $RFC;
	private $responsable;
	
	function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('SELECT User.id AS UserID, User.*, Responsable.id AS RespID, Responsable.nombre AS RespNombre, Responsable.apellido_paterno AS Respapp, Responsable.apellido_materno AS Resapm, Responsable.*, Cliente.nombre AS empresa, Cliente.*
				FROM User JOIN Responsable JOIN Cliente
				WHERE Responsable.idUser=User.id AND Responsable.idCliente=Cliente.id AND User.id = :id', $data);

			$this->responsable_id = $userArray['RespID'];
			$this->empresa = $userArray['empresa'];
			$this->responsable = $userArray['RespNombre'] .' ' . $userArray['Respapp'].' ' . $userArray['Resapm'];
		}
	}

	function getEmpresa() {
		return $this->empresa;
	}

	function getResponsable() {
		return $this->responsable;
	}

	function getRFC() {
		return $this->RFC;
	}
}

?>