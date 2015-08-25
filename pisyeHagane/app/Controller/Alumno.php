<?php
namespace Hagane\Controller;

class Alumno extends AbstractController{
	function _init() {
		echo $this->db->database_log['error'];
		if (!$this->auth->isAuth()) {
			 header("Location: http://pisye.com/User");
			 die();
		}
	}

	function index() {
		//Mis clases
		$userObject = $this->user->getUserObject();
		$this->clases = $userObject->getMyClass();
	}
}

?>