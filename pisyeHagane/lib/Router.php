<?php
//TODO
//funcion match para obtener las rutas ya mapeadas
//parametro para tener cargadas todas las rutas mapeadas

namespace Hagane;

class Router {
	private $config = array();

	function  __construct($config){
		$this->config = $config;
	}

	function parse() {
		//parseo de URI
		$request = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
		$request = explode("/", $request);

		//chequeo de existencia de controller
		if (isset($request[1]) && $request[1] != '') {
			if (!file_exists($this->config['appPath'].'Controller/'.$request[1].'.php')) {
				//si no existe el controller
				include_once($this->config['appPath'].'Controller/Error.php');
				$controller = new \Hagane\Controller\Error($this->config);
			} else {
				include_once($this->config['appPath'].'Controller/'.$request[1].'.php');
				$class = '\\Hagane\\Controller\\'.$request[1];
				$controller = new $class($this->config);  //hay que ver si no se quedan 2 objetos volando por cada request
			}
		} else {
			//si no hay controller
			include_once($this->config['appPath'].'Controller/Index.php');
			$controller = new \Hagane\Controller\Index($this->config);
		}

		//chequeo de existencia de accion
		if (isset($request[2]) && $request[2] != '') {
			if (!method_exists($controller, $request[2])) {
				//si no existe la accion
				include_once($this->config['appPath'].'Controller/Error.php');
				$controller = new \Hagane\Controller\Error($this->config);
				$request[2] = 'index';
			}
		} else {
			//si no hay accion
			$request[2] = 'index';
		}

		$params =
			array(
				'controller' => $controller,
				'action' => $request[2]
				);

		return $params;

		// array(
		// 		'controller' => 'Index',
		// 		'action' => 'index'
		// 		);

	}

	function match(){

	}
}

?>