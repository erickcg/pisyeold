<?php
namespace Users\Model;

class User
{
	public $id;
	public $username;
	public $password;

	 public function exchangeArray($data)
	 {
		$this->username = (isset($data['username'])) ? $data['username'] : null;
		$this->password = (isset($data['password'])) ? $data['password'] : null;
	 }
}