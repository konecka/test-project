<?php

class User {
	protected $id;

	private $login;
	private $password;

 	public $name;
 	public $patronymic;

	public function __construct($id, $name, $login, $password) {
		$this->login    = $login;
		$this->password = $password;
		$this->name     = $name;
		$this->id       = $id;
		$this->patronymic = $patronymic;
	}

	public function getLogin() {
		return $this->login;
	}
	public function setLogin($new_login) {
		$this->login = $new_login;
	}

}

?>