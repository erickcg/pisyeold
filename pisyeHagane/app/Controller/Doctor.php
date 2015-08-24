<?php
namespace Hagane\Controller;

class Doctor extends AbstractController{
	var $solicitud;

	function _init() {
		if (!$this->auth->isAuth()) {
			 header("Location: http://hagasoft.mx/User");
			 die();
		}
		include_once($this->config['appPath'].'Model/SolicitudModel.php');
	}

	function index() {
		$this->solicitud = new \Hagane\Model\Solicitud($this->auth, $this->db);
	}

	function examenGeneral() {
	}
}

?>