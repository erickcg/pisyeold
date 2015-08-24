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
				'db_database' => 'haganeso_crm',
				'db_user' => 'haganeso_dev',
				'db_password' => 'Bicarbonato1!',
				'session_time' => 3600
			);
	}

	function getModules() {
		return
			array();
	}
}
?>