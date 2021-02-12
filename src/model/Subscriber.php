<?php
namespace Bihin\steampunkLibrary\src\model;

class Subscriber
{
	private $id;
	private $login;
	private $password;
	private $email;
	private $record;
	private $role;

	public function __construct(array $data){
		$this->hydrate($data);
	}

	public function hydrate(array $data){
		foreach ($data as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function getId(){
		return $this->id;
	}

	public function getLogin(){
		return $this->login;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getRecord(){
		return $this->record;
	}

	public function getRole(){
		return $this->role;
	}
	
	public function setId(int $id){
		if ($id > 0) {
			$this->id = $id;
		}
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setRecord($record){
		$this->record = $record;
	}

	public function setRole($role){
		$this->role = $role;
	}
}
