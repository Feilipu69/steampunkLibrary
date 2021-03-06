<?php
namespace Bihin\steampunkLibrary\src\model;

class ForumPosts
{
	private $id;
	private $subscriberId;
	private $login;
	private $title;
	private $post;
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

	public function getSubscriberId(){
		return $this->subscriberId;
	}

	public function getLogin(){
		return $this->login;
	}

	public function getTitle(){
		return $this->title;
	}

	public function getPost(){
		return $this->post;
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

	public function setSubscriberId($subscriberId){
		if ($subscriberId > 0) {
			$this->subscriberId = $subscriberId;
		}
	}

	public function setLogin($login){
		$this->login= $login;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function setPost($post){
		$this->post = $post;
	}

	public function setContent($content){
		$this->content = $content;
	}

	public function setDate($date){
		$this->date = $date;
	}
}
