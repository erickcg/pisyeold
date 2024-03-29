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
		$users = $this->db->query('SELECT u.user, u.user_type, a.id as aid, a.* FROM User as u RIGHT JOIN Alumno as a ON a.idUser = u.id');

		return $users;
	}

	function setAlumno($data = array()) {
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

	function updateAlumno($data = array()) {
		$userData = array(
			'idUser' => $data['idUser'],
			'user' => $data['user'],
			'user_type' => 'Cliente'
		);

		if (isset($data['password'])) {
			$userData['password'] = $data['password'];
			$this->db->query('UPDATE User SET user=:user, password=:password, user_type=:user_type WHERE id=:idUser', $userData);

		} else {
			$this->db->query('UPDATE User SET user=:user, user_type=:user_type WHERE id=:idUser', $userData);
		}

		$responsableData = array(
			'nombre' => $data['nombre'],
			'apellido_paterno' => $data['apellido_paterno'],
			'apellido_materno' => $data['apellido_materno'],
			'idCliente' => $data['idCliente'],
			'idUser' => $data['idUser']
		);
		$this->db->query('UPDATE Responsable SET nombre=:nombre, apellido_paterno=:apellido_paterno, apellido_materno=:apellido_materno, idCliente=:idCliente WHERE idUser=:idUser', $responsableData);
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