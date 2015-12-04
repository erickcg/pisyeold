<?php
namespace Hagane;

class Config {
	private $appDir;
	private $appDepth;

	public function __construct($HaganeInit = array()){
		$this->appDir = $HaganeInit['appFolderName'];
		$this->appDepth = $HaganeInit['appFolderDepth'];
	}

	function getConf() {
		return
			array(
				'appPath' => '../app/',
				'template' => 'main',
				'db_engine' => 'mysql',
				// 'db_server' => 'localhost',
				// 'db_database' => 'pisyecom_hagane',
				// 'db_user' => 'pisyecom_erick',
				// 'db_password' => 'Bacalao1!!',
				'db_server' => 'localhost',
				'db_database' => 'pisyecom_hagane',
				'db_user' => 'root',
				'db_password' => '',
				'session_time' => 3600,
				'document_root' => '/'
			);
	}

	function getModules() {
		return
			array();
	}

	function getRoutes() {
		// Add custom routes here so you can call them with a simple route name
		// Use the key of the element in the array as
		return
			array(
				'logout' => 'User/logout',
				'login' => 'User/index'
			);
	}
}
?>
