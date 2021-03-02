<?php
namespace Bihin\steampunkLibrary\src\model;

class ForumSubjects
{
	private $id;
	private $loginSubscriber;
	private $title;
	private $subject;
	private $content;
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

	public function getLoginSubscriber(){
		return $this->loginSubscriber;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getSubject(){
		return $this->subject;
	}

	public function getContent(){
		return $this->content;
	}

	public function getDate(){
		return $this->date;
	}

	public function setId(int $id){
		if ($id > 0) {
			$this->id = $id;
		}
	}

	public function setLoginSubscriber($loginSubscriber){
		$this->loginSubscriber = $loginSubscriber;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function setSubject($subject){
		$this->subject = $subject;
	}

	public function setContent($content){
		$this->content = $content;
	}

	public function setDate($date){
		$this->date = $date;
	}
}
