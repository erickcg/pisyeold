<?php
namespace Registro\Model;

class User
{
	public $id;
	public $user;
	public $password;

	 public function exchangeArray($data)
	 {
		$this->user = (isset($data['name'])) ? $data['name'] : null;
		$this->password = (isset($data['password'])) ? $data['password'] : null;
	 }
}