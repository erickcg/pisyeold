<?php
namespace Hagane;

class Config {
	function getConf() {
		return
			array(
				'appPath' => '../app/',
				'template' => 'main',
				'db_engine' => 'mysql',
				'db_server' => 'localhost',
				'db_database' => 'pisyecom_hagane',
				'db_user' => 'pisyecom_erick',
				'db_password' => 'Bacalao1!!',
				'session_time' => 3600
			);
	}

	function getModules() {
		return
			array();
	}
}
?>