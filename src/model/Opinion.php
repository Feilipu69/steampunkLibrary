<?php
namespace Bihin\steampunkLibrary\src\model;

class Opinion
{
	private $id;
	private $login;
	private $forumId;
	private $comment;
	private $dateOfComment;
	private $title;
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

	public function getForumId(){
		return $this->forumId;
	}

	public function getComment(){
		return $this->comment;
	}

	public function getDateOfComment(){
		return $this->dateOfComment;
	}
	
	public function getTitle(){
		return $this->title;
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

	public function setForumId(int $forumId){
		if ($forumId > 0) {
			$this->forumId = $forumId;
		}
	}

	public function setComment($comment){
		$this->comment = $comment;
	}

	public function setDateOfComment($dateOfComment){
		$this->dateOfComment = $dateOfComment;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function setAgree($agree){
		$this->agree = $agree;
	}

	public function setDisagree($disagree){
		$this->disagree = $disagree;
	}
}
