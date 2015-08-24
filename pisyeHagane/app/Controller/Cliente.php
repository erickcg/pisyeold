<?php
namespace Hagane\Controller;

class Cliente extends AbstractController{

	function _init() {
		if (!$this->auth->isAuth()) {
			 header("Location: http://hagasoft.mx/User");
			 die();
		}
		include_once($this->config['appPath'].'Model/SolicitudModel.php');
	}

	function index() {
	}

	function solicitudIndividual() {
		//empieza
		$solicitud = new \Hagane\Model\Solicitud($this->auth, $this->db);
		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			$nombre = $_POST['nombre'];
			$apellido_paterno = $_POST['apellido_paterno'];
			$apellido_materno = $_POST['apellido_materno'];
			$fecha = $_POST['fecha'];
			$hora = $_POST['hora'];
			$estudios = $_POST['estudios'];
			$observaciones = $_POST['observaciones'];
			
			$solicitud->setSolicitudIndividual($nombre, $apellido_paterno, $apellido_materno, $fecha, $hora, $estudios, $observaciones);
		}
	}

	function solicitudGrupal() {
	}
}

?>