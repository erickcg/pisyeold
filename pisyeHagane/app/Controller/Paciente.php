<?php
namespace Hagane\Controller;

class Paciente extends AbstractController{
	function _init() {
		echo $this->db->database_log['error'];

		if (!$this->auth->isAuth()) {
			 header("Location: http://hagasoft.mx/User");
			 die();
		}
	}

	function index() {
		$this->pacientes = $this->db->query('Select * from Paciente');
	}

	function alta() {
		$this->mensaje = '';
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			//dar de alta paciente
			$data = array(
				'nombre' => $_POST['nombre'],
				'apellido_p' => $_POST['apellido_p'],
				'apellido_m' => $_POST['apellido_m'],
				'curp' => $_POST['curp']
				);
			
			$this->db->query('Insert Paciente set nombre =:nombre, apellido_p =:apellido_p, apellido_m =:apellido_m, curp =:curp', $data);
			$this->mensaje = 'alta exitosa';
		} else {
			//imprimir formulario o mas bien atender la redireccion despues de guardar
		}
	}
}

?>