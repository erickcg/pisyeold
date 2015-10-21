<?php
namespace Hagane\Model;

class UserManagement {
	private $db;
	private $auth;

	function __construct(&$auth, &$db) {
		$id = $auth->isAuth();
		if (!empty($id)) {
			$data = array('id' => $id);
			$userArray = $db->getRow('SELECT * from Administrador join User where User.id = Administrador.idUser AND User.id = :id', $data);
			$this->db = $db;
			$this->auth = $auth;
		}

	}

	function getUsers() {
		$users = $this->db->query('SELECT u.user, u.user_type FROM User as u');

		return $users;
	}

	function getAdminUsers() {
		$users = $this->db->query('SELECT u.user, u.user_type, a.* FROM User as u JOIN Administrador as a WHERE a.idUser = u.id');

		return $users;
	}

	function getMaestroUsers() {
		$users = $this->db->query('SELECT u.user, u.user_type, d.* FROM User as u JOIN Maestro as d WHERE d.idUser = u.id');

		return $users;
	}

	function getAlumnoUsers() {
		$users = $this->db->query('SELECT u.user, u.user_type, a.* FROM User as u RIGHT JOIN Alumno as a ON a.idUser = u.id');

		return $users;
	}

	function setAlumno($username, $password, $nombre, $ap, $am, $empresa) {
		$data = array('user' => $username,
					'user_type' => 'Alumno',
					'password' => $password);
		$lastid = $this->db->insert('INSERT INTO User SET user=:user, password=:password, user_type=:user_type ', $data);

		$data = array('nombre' => $nombre,
					'apellido_paterno' => $ap,
					'apellido_materno' => $am,
					'idUser' => $lastid);
		$this->db->insert('INSERT INTO Alumno SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idUser=:idUser ', $data);
	}

	function setMaestro($username, $password, $nombre, $ap, $am) {
		$data = array('user' => $username,
					'user_type' => 'Maestro',
					'password' => $password);
		$lastid = $this->db->insert('INSERT INTO User SET user=:user, password=:password, user_type=:user_type ', $data);

		$data = array('nombre' => $nombre,
					'apellido_paterno' => $ap,
					'apellido_materno' => $am,
					'idUser' => $lastid);
		$this->db->insert('INSERT INTO Maestro SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idUser=:idUser ', $data);
	}

	function setAdmin($username, $password, $nombre, $ap, $am) {
		$data = array('user' => $username,
					'user_type' => 'Administrador',
					'password' => $password);
		$lastid = $this->db->insert('INSERT INTO User SET user=:user, password=:password, user_type=:user_type ', $data);

		$data = array('nombre' => $nombre,
					'apellido_paterno' => $ap,
					'apellido_materno' => $am,
					'idUser' => $lastid);
		$this->db->insert('INSERT INTO Administrador SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idUser=:idUser ', $data);
	}
}

?>