<?php
namespace Hagane\Model;

class Clase {
	private $nombre;
	private $maestroID;
	private $alumnoID;

	private $db;
	
	function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		$this->db = $db;
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('SELECT * from User where id = :id', $data);

			if ($userArray['user_type'] == 'Maestro') {
				$data = array('id' => $id);
				$userArray = $db->getRow('SELECT User.*, Maestro.id as mid, Maestro.* from Maestro join User where User.id = Maestro.idUser AND User.id = :id', $data);

				$this->maestroID = $userArray['mid'];
			} elseif ($userArray['user_type'] == 'Alumno') {
				$data = array('id' => $id);
				$userArray = $db->getRow('SELECT User.*, Alumno.id as aid, Alumno.* from Alumno join User where User.id = Alumno.idUser AND User.id = :id', $data);

				$this->alumnoID = $userArray['aid'];
			}
		}
	}

	function getClase() {
		$claseArray = array();

		if ($this->maestroID != null) {
			$data = array('id' => $this->maestroID);
			$claseArray = $this->db->query('SELECT * FROM PeriodoClase AS pc JOIN Clase AS c WHERE  c.id = pc.idClase AND pc.idMaestro = :id', $data);
		} elseif ($this->alumnoID != null) {
			$data = array('id' => $this->alumnoID);
			$claseArray = $this->db->query('SELECT * FROM PeriodoClase AS pc JOIN Clase AS c JOIN Calificacion as cal WHERE  c.id = pc.idClase AND cal.idPeriodoClase = pc.id AND cal.idAlumno = :id', $data);
		}
		
		return $claseArray;
	}
}

?>