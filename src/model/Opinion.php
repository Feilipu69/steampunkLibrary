<?php
namespace Bihin\steampunkLibrary\src\model;

class Opinion
{
	private $id;
	private $isbn;
	private $comment;
	private $dateOfComment;

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

	public function getIsbn(){
		return $this->isbn;
	}

	public function getComment(){
		return $this->comment;
	}

	public function getDateOfComment(){
		return $this->dateOfComment;
	}

	public function setId(int $id){
		if ($id > 0) {
			$this->id = $id;
		}
	}

	public function setIsbn($isbn){
		$this->isbn = $isbn;
	}

	public function setComment($comment){
		$this->comment = $comment;
	}

	public function setDateOfComment($dateOfComment){
		$this->dateOfComment = $dateOfComment;
	}
}
