<?php
namespace Hagane\Controller;

class Maestro extends AbstractController{
	function _init() {
		echo $this->db->database_log['error'];
	}

	function index() {
		//Mis clases
		$userObject = $this->user->getUserObject();
		$this->clases = $userObject->getMyClass();
	}
}

?>