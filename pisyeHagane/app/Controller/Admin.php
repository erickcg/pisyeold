<?php
namespace Hagane\Controller;

class Admin extends AbstractController{

	function _init() {
		if (!$this->auth->isAuth()) {
			 header("Location: /User");
			 die();
		}
		include_once($this->config['appPath'].'Model/UserManagement.php');
	}

	function index() {
	}

	function alumnos() {
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
	}

	function ajaxGetAdminUsers() {
		$this->sendJson = true;
		$this->print_template = false;
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		echo json_encode($this->userManager->getAdminUsers());
	}

	function ajaxGetMaestroUsers() {
		$this->sendJson = true;
		$this->print_template = false;
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		echo json_encode($this->userManager->getMaestroUsers());
	}

	function ajaxGetAlumnoUsers() {
		$this->sendJson = true;
		$this->print_template = false;
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);
		echo json_encode($this->userManager->getAlumnoUsers());
	}

	function ajaxGetClases() {
		$this->sendJson = true;
		$this->print_template = false;

		//Mis clases
		$classId = (isset($_GET['claseid'])) ? $_GET['claseid'] : 0;
		$classType = (isset($_GET['clasetype'])) ? $_GET['clasetype'] : null;
		$userObject = $this->user->getUserObject();
		//$this->clases = $userObject->getMyClass($classId);

		echo json_encode($userObject->getMyClass($classId, $classType));
	}

	function lista() {
		//Mis clases
		$classId = $_GET['claseid'];
		$userObject = $this->user->getUserObject();
		$this->clases = $userObject->getMyClass($classId);
	}

	function clases() {

	}

	function users() {
		$this->userManager = new \Hagane\Model\UserManagement($this->auth, $this->db);

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($_POST['tipo'] == 'maestro') {
				$this->userManager->setMaestro($_POST['username'], $_POST['password'], $_POST['nombre'], $_POST['apellido_paterno'], $_POST['apellido_materno']);
				$this->maestro = 'active';
			}
			if ($_POST['tipo'] == 'alumno') {
				$this->userManager->setAlumno($_POST['username'], $_POST['password'], $_POST['nombre'], $_POST['apellido_paterno'], $_POST['apellido_materno']);
				$this->alumno = 'active';
			}
			if ($_POST['tipo'] == 'admin') {
				$this->userManager->setAdmin($_POST['username'], $_POST['password'], $_POST['nombre'], $_POST['apellido_paterno'], $_POST['apellido_materno']);
				$this->admin = 'active';
			}
		}
	}

	function calificaciones() {
		//Mis clases
		$alumnoId = $_GET['alumnoid'];
		$userObject = $this->user->getUserObject();
		$this->boletas = $userObject->getAllGrades($alumnoId);
	}

	function calificar() {
		//Mis clases
		$classId = $_GET['claseid'];
		$alumnoId = $_GET['alumnoid'];
		$userObject = $this->user->getUserObject();


		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->alumno = $userObject->setGrades($classId, $alumnoId, $_POST['parcial1'], $_POST['parcial2'], $_POST['participacion'], $_POST['puntualidad'], $_POST['disposicion'], $_POST['tareas'], $_POST['observaciones']);
			header("Location:  /Admin/clase?claseid=".$classId);
			die();
		}

		$this->alumno = $userObject->getGrades($classId, $alumnoId);
	}
}

?>