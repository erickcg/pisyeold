<?php
namespace Hagane\Controller;

class Maestro extends AbstractController{
	function _init() {
		echo $this->db->database_log['error'];
		if (!$this->auth->isAuth()) {
			 header("Location: /User");
			 die();
		}
	}

	function index() {
		//Mis clases
		$userObject = $this->user->getUserObject();
		$this->clases = $userObject->getMyClass();
	}

	function clase() {
		//Mis clases
		$classId = $_GET['claseid'];
		$userObject = $this->user->getUserObject();
		$this->clases = $userObject->getMyClass($classId);
	}

	function calificar() {
		//Mis clases
		$classId = $_GET['claseid'];
		$alumnoId = $_GET['alumnoid'];
		$userObject = $this->user->getUserObject();


		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->alumno = $userObject->setGrades($classId, $alumnoId, $_POST['parcial1'], $_POST['parcial2'], $_POST['participacion'], $_POST['puntualidad'], $_POST['disposicion'], $_POST['tareas'], $_POST['observaciones']);
			header("Location:  /Maestro/clase?claseid=".$classId);
			die();
		}

		$this->alumno = $userObject->getGrades($classId, $alumnoId);
	}
}

?>