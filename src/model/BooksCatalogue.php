<?php
namespace Bihin\steampunkLibrary\src\model;

class BooksCatalogue
{
	private $id;
	private $isbn;

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

	public function getIsbn(){
		return $this->isbn;
	}

	public function setId(int $id){
		if ($id > 0) {
			$this->id = $id;
		}
	}

	public function setIsbn($isbn){
		$this->isbn = $isbn;	
	}
}
