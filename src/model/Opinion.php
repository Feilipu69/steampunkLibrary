<?php
namespace Bihin\steampunkLibrary\src\model;

class Opinion
{
	private $id;
	private $idSubscriber;
	private $idForum;
	private $comment;
	private $date;

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

	public function getIdSubscriber(){
		return $this->idSubscriber;
	}

	public function getIdForum(){
		return $this->idForum;
	}

	public function getComment(){
		return $this->comment;
	}

	public function getDate(){
		return $this->date;
	}

	public function setId(int $id){
		if ($id > 0) {
			$this->id = $id;
		}
	}

	public function setIdSubscriber(int $idSubscriber){
		if ($idDubscriber > 0) {
			$this->idSubscriber = $idSubscriber;
		}
	}

	public function setIdForum(int $idForum){
		if ($idForum > 0) {
			$this->idForum = $idForum;
		}
	}

	public function setComment($comment){
		$this->comment = $comment;
	}

	public function setDate($date){
		$this->date = $date;
	}
}
