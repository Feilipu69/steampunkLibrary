<?php
namespace Bihin\steampunkLibrary\src\model;

class Opinion
{
	private $id;
	private $login;
	private $idForum;
	private $comment;
	private $dateOfComment;
	private $agree;
	private $disagree;

	public function __construct(array $data){
		$this->hydrate($data);
	}

	public function hydrate(array $data){
		foreach($data as $key => $value){
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

	public function getIdForum(){
		return $this->idForum;
	}

	public function getComment(){
		return $this->comment;
	}

	public function getDateOfComment(){
		return $this->dateOfComment;
	}

	public function getAgree(){
		return $this->agree;
	}

	public function getDisagree(){
		return $this->disagree;
	}

	public function setId(int $id){
		if ($id > 0) {
			$this->id = $id;
		}
	}

	public function setLogin($login){
		$this->login = $login;
	}

	public function setIdForum(int $idForum){
		if ($idForum > 0) {
			$this->idForum = $idForum;
		}
	}

	public function setComment($comment){
		$this->comment = $comment;
	}

	public function setDateOfComment($dateOfComment){
		$this->dateOfComment = $dateOfComment;
	}

	public function setAgree($agree){
		$this->agree = $agree;
	}

	public function setDisagree($disagree){
		$this->disagree = $disagree;
	}
}
