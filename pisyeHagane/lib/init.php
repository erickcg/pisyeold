<?php
namespace Hagane;

include_once('AbstractController.php');
include_once('Database.php');
include_once('Authentication.php');
include_once('ControllerDriver.php');
include_once('Router.php');
include_once('UserInterface.php');
include_once('../app/config/config.php');

class App {
	function start() {
		$config = new \Hagane\Config();

		//inicializacion de modulos
		foreach ($config->getModules() as $module) {
			include_once('Modules/'.$module.'.php');
		}

		include_once($config->getConf()['appPath'].'Model/UserModel.php');
		
		$router = new \Hagane\Router($config->getConf());
		$params = $router->parse();

		$ControllerDriver = new \Hagane\ControllerDriver($config->getConf());
		$ControllerDriver->execute($params);  //params >>> controllerName, action and get params
	}

}

?>