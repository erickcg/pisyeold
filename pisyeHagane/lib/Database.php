<?php
namespace Hagane;

class Database {
	private $pdo;
	private $config = array();
	public $database_log = array();

	function  __construct($config){
		$this->config = $config;
		$this->database_log['error'] = '';

		if (!isset($this->config['db_engine'])) {
			//destruye
			print("error bd");
		}

		if (strcasecmp($this->config['db_engine'], 'mysql') == 0) {
			try {
				$this->pdo = new \PDO("mysql:host=".$this->config['db_server'].";dbname=".$this->config['db_database'], $this->config['db_user'], $this->config['db_password']);
			} catch (\PDOException $e) {
				$this->database_log['error'] .= $e->getMessage();
				print($this->database_log['error']);
			}
		}
	}

	function getPDOobject(){
		return $this->pdo;
	}

	function insert($queryString, $data = null){
		$statement = $this->pdo->prepare($queryString);
		$statement->execute($data);

		$lastId = $this->pdo->lastInsertId();
		return $lastId;
	}

	function query($queryString, $data = null){
		$statement = $this->pdo->prepare($queryString);
		$statement->execute($data);

		$result = $statement->fetchAll();
		return $result;
	}

	function getRow($queryString, $data = null){
		$statement = $this->pdo->prepare($queryString. ' LIMIT 1 ');
		$statement->execute($data);

		$result = $statement->fetch();
		return $result;
	}

	function rowCount($queryString, $data = null){
		$statement = $this->pdo->prepare($queryString);
		$statement->execute($data);

		return $statement->rowCount();
	}
}

?>