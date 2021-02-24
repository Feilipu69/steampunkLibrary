<?php
namespace Bihin\steampunkLibrary\src\model;

class Newsletter
{
	private $id;
	private $title;
	private $message;
	private $date;

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

	public function getTitle(){
		return $this->title;
	}
	
	public function getMessage(){
		return $this->message;
	}

	public function getDate(){
		return $this->date;
	}

	public function setId(int $id){
		if ($id > 0 ) {
			$this->id = $id;
		}
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function setMessage($message){
		$this->message = $message;
	}

	public function setDate($date){
		$this->date = $date;
	}
}
?>
