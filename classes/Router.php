<?php
require_once 'controller/Frontcontroller.php';

class Router
{
	private $frontcontroller;

	public function __construct(){
		$this->frontcontroller = new Frontcontroller();
	}

	public function renderController(){
		if (isset($_GET['route'])) {
			if ($_GET['route'] === 'books') {
				$this->frontcontroller->getBooks();
			}
		} else {
			require_once 'view/home.php';
		}
	}
}
