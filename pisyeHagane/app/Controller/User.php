<?php
namespace Hagane\Controller;

class User extends AbstractController{
	function _init() {
		echo $this->db->database_log['error'];
	}

	function index() {

	}

	function auth() {
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->auth->authenticate($_POST['user'], $_POST['password']);
			if ($this->auth->isAuth()) {
				$this->user = new \Hagane\Model\User($this->auth, $this->db);
				if ($this->user->getUserType() == 'Administrador') {
					header("Location:  /Admin/index");
					die();
				}
				if ($this->user->getUserType() == 'Maestro') {
					header("Location:  /Maestro/index");
					die();
				}
				if ($this->user->getUserType() == 'Alumno') {
					header("Location:  /Alumno/index");
					die();
				}
			}
		}
	}

	function logout() {
		$this->auth->logout();
	}
}

?>