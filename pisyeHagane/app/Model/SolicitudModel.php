<?php
namespace Hagane\Model;

class Solicitud {
	private $empresa;
	private $empresa_id;
	private $RFC;
	private $responsable;
	private $responsable_id;
	private $user_id;

	private $db;
	private $auth;
	
	function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		if (!empty($id)) {
			$data = array('id' => $id); ///acomodar la query para que sea leida por doctor tambien
			$userArray = $db->getRow('SELECT User.id AS UserID, User.*, Responsable.id AS RespID, Responsable.*, Cliente.nombre AS empresa, Cliente.*
				FROM User JOIN Responsable JOIN Cliente
				WHERE Responsable.idUser=User.id AND Responsable.idCliente=Cliente.id AND User.id = :id', $data);

			$this->user_id = $userArray['UserID'];
			$this->responsable_id = $userArray['RespID'];
			$this->empresa = $userArray['empresa'];

			$this->db = $db;
			$this->auth = $auth;
		}
	}

	function getSolicitudes() {
		//$data = array('id' => $id);
		$solicitudes = $this->db->query('SELECT s.id as solID, s.observaciones as observaciones, p.nombre as pnombre, p.apellido_paterno as pap, p.apellido_materno as pam, s.*, r.nombre as rnombre, r.apellido_paterno as rap, r.apellido_materno as ram, c.nombre as cnombre 
			FROM Solicitud AS s JOIN Paciente AS p JOIN User as u JOIN Responsable as r JOIN Cliente as c WHERE 
			s.idPaciente = p.id AND s.idUser = u.id AND r.idUser = u.id AND r.idCliente = c.id');

		// $data = array('id' => $solicitudes['solID']); 
		// $estudioArray = $db->getRow('SELECT e.nombre from SolicitudEstudio as se JOIN Estudio WHERE se.idEstudio = e.id AND se.idSolicitud =:id as e User.id = :id', $data);

		//$solicitudes = array_push($solicitudes, $estudioArray);
		return $solicitudes;
	}

	function setSolicitudIndividual($nombre, $apellido_paterno, $apellido_materno, $fecha, $hora, $estudios, $observaciones) { 
		$data = array('nombre' => $nombre, 'apellido_paterno' => $apellido_paterno, 'apellido_materno' => $apellido_materno);
		$pacienteID = $this->db->insert('INSERT INTO Paciente SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno ', $data);

		$mysqltime = date ("Y-m-d H:i:s", strtotime($fecha.' '.$hora));

		$data = array('idPaciente' => $pacienteID, 'fecha' => $mysqltime, 'observaciones' => $observaciones , 'idUser' => $this->user_id);
		$solicitudID = $this->db->insert('INSERT INTO Solicitud SET idPaciente=:idPaciente, fecha=:fecha, observaciones=:observaciones, idUser=:idUser', $data);

		foreach ($estudios as $estudio) {
			$data = array('idEstudio' => $estudio, 'idSolicitud' => $solicitudID);
			$this->db->insert('INSERT INTO SolicitudEstudio SET idSolicitud=:idSolicitud, idEstudio=:idEstudio ', $data);
		}
	}
}

?>