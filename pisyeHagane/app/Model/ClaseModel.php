<?php
namespace Hagane\Model;

class Clase {
	private $nombre;
	private $maestroID;
	private $alumnoID;
	private $admin = false;

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
			}	elseif ($userArray['user_type'] == 'Administrador') {
				$this->admin = true;
			}

		}
	}

	function getClase() {
		$claseArray = array();
		$data = array();

		//queries que traen las clases inscritas para el maestro o el alumno
		if ($this->maestroID != null) {
			$data = array('id' => $this->maestroID);
			$claseArray = $this->db->query('SELECT pc.id as pcid, pc.*, c.* FROM PeriodoClase AS pc JOIN Clase AS c WHERE  c.id = pc.idClase AND pc.idMaestro = :id', $data);
		} elseif ($this->alumnoID != null) {
			$data = array('id' => $this->alumnoID);
			$claseArray = $this->db->query('SELECT * FROM PeriodoClase AS pc JOIN Clase AS c JOIN Calificacion as cal WHERE  c.id = pc.idClase AND cal.idPeriodoClase = pc.id AND cal.idAlumno = :id', $data);
		} elseif ($this->admin) {
			$claseArray = $this->db->query('SELECT pc.id as pcid, pc.*, c.* FROM PeriodoClase AS pc JOIN Clase AS c WHERE  c.id = pc.idClase ORDER BY c.tipo', $data);
		}

		return $claseArray;
	}

	function getClaseById($claseId) {
		$claseArray = array();

		if ($this->maestroID != null) {
			$data = array('id' => $this->maestroID, 'claseid' => $claseId);

			//query para traer a los alumnos de la clase con sus calificaciones
			$claseArray = $this->db->query('SELECT pc.id as pcid, pc.*, c.nombre as cnombre, c.*, a.nombre as anombre, a.id as aid, a.*, cal.*
				FROM PeriodoClase AS pc JOIN Clase AS c JOIN Calificacion as cal JOIN Alumno as a
				WHERE c.id = pc.idClase AND cal.idPeriodoClase = pc.id AND cal.idAlumno = a.id
				AND pc.idMaestro = :id AND pc.id = :claseid', $data);

		} elseif ($this->alumnoID != null) {
			$data = array('id' => $this->alumnoID, 'claseid' => $claseId);
			$claseArray = $this->db->query('SELECT * FROM PeriodoClase AS pc JOIN Clase AS c JOIN Calificacion as cal WHERE  c.id = pc.idClase AND cal.idPeriodoClase = pc.id AND cal.idAlumno = :id AND pc.id = :claseid', $data);
		} elseif ($this->admin) {
			$data = array('claseid' => $claseId);

			$claseArray = $this->db->query('SELECT pc.id as pcid, pc.*, c.nombre as cnombre, c.*, a.nombre as anombre, a.id as aid, a.*, cal.*
				FROM PeriodoClase AS pc JOIN Clase AS c JOIN Calificacion as cal JOIN Alumno as a
				WHERE c.id = pc.idClase AND cal.idPeriodoClase = pc.id AND cal.idAlumno = a.id AND pc.id = :claseid', $data);
		}

		return $claseArray;
	}

	function getClaseByType($claseType) {
		$data = array('clasetype' => $claseType);

		//queries que traen las clases inscritas para el maestro o el alumno
		if ($this->maestroID != null) {
			$data = array('id' => $this->maestroID);
			$claseArray = $this->db->query('SELECT pc.id as pcid, pc.*, c.* FROM PeriodoClase AS pc JOIN Clase AS c WHERE  c.id = pc.idClase AND pc.idMaestro = :id', $data);
		} elseif ($this->alumnoID != null) {
			$data = array('id' => $this->alumnoID);
			$claseArray = $this->db->query('SELECT * FROM PeriodoClase AS pc JOIN Clase AS c JOIN Calificacion as cal WHERE  c.id = pc.idClase AND cal.idPeriodoClase = pc.id AND cal.idAlumno = :id', $data);
		} elseif ($this->admin) {
			$claseArray = $this->db->query('SELECT pc.id as pcid, pc.*, c.* FROM PeriodoClase AS pc JOIN Clase AS c WHERE  c.id = pc.idClase AND c.tipo=:clasetype ORDER BY c.tipo', $data);
		}

		return $claseArray;
	}

	function getGrades($claseId, $alumnoId) {
		$claseArray = array();

		if ($this->maestroID != null) {
			$data = array('id' => $this->maestroID, 'claseid' => $claseId, 'alumnoid' => $alumnoId);

			//query para traer a los alumnos de la clase con sus calificaciones
			$claseArray = $this->db->getRow('SELECT pc.id as pcid, pc.*, c.nombre as cnombre, c.*, a.nombre as anombre, a.id as aid, a.*, cal.*
				FROM PeriodoClase AS pc JOIN Clase AS c JOIN Calificacion as cal JOIN Alumno as a
				WHERE c.id = pc.idClase AND cal.idPeriodoClase = pc.id AND cal.idAlumno = a.id
				AND pc.idMaestro = :id AND pc.id = :claseid AND cal.idAlumno = :alumnoid', $data);
		} elseif ($this->admin) {
			$data = array('claseid' => $claseId, 'alumnoid' => $alumnoId);

			$claseArray = $this->db->getRow('SELECT pc.id as pcid, pc.*, c.nombre as cnombre, c.*, a.nombre as anombre, a.id as aid, a.*, cal.*
				FROM PeriodoClase AS pc JOIN Clase AS c JOIN Calificacion as cal JOIN Alumno as a
				WHERE c.id = pc.idClase AND cal.idPeriodoClase = pc.id AND cal.idAlumno = a.id AND pc.id = :claseid AND cal.idAlumno = :alumnoid', $data);
		}
		return $claseArray;
	}

	function getAllGrades($alumnoId) {
		$boletaArray = array();

		if ($this->admin) {
			$data = array('alumnoid' => $alumnoId);

			$boletaArray = $this->db->query('SELECT pc.id as pcid, pc.*, c.nombre as cnombre, c.*, a.nombre as anombre, a.id as aid, a.*, cal.*
				FROM PeriodoClase AS pc JOIN Clase AS c JOIN Calificacion as cal JOIN Alumno as a
				WHERE c.id = pc.idClase AND cal.idPeriodoClase = pc.id AND cal.idAlumno = a.id AND cal.idAlumno = :alumnoid', $data);
		}
		return $boletaArray;
	}

	function setGrades($claseId, $alumnoId, $parcial1, $parcial2, $participacion, $puntualidad, $disposicion, $tareas, $observaciones) {
		$claseArray = array();

		//Change gradeees
		if ($this->maestroID != null || $this->admin) {
			$data = array(
				'id' => $this->maestroID,
				'claseid' => $claseId,
				'alumnoid' => $alumnoId,
				'parcial1' => $parcial1,
				'parcial2' => $parcial2,
				'participacion' => $participacion,
				'puntualidad' => $puntualidad,
				'disposicion' => $disposicion,
				'tareas' => $tareas,
				'observaciones' => $observaciones
			);

			//query para traer a los alumnos de la clase con sus calificaciones
			$claseArray = $this->db->query('UPDATE Calificacion as cal JOIN PeriodoClase AS pc JOIN Clase AS c JOIN Alumno as a
				SET cal.parcial1=:parcial1,
					cal.parcial2=:parcial2,
					cal.participacion=:participacion,
					cal.puntualidad=:puntualidad,
					cal.disposicion=:disposicion,
					cal.tareas=:tareas,
					cal.observaciones=:observaciones
				WHERE c.id = pc.idClase AND cal.idPeriodoClase = pc.id AND cal.idAlumno = a.id
				AND pc.idMaestro = :id AND pc.id = :claseid AND cal.idAlumno = :alumnoid', $data);
		}
		return $claseArray;
	}
}

?>