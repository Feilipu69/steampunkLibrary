<?php
namespace Bihin\steampunkLibrary\classes;

use Bihin\steampunkLibrary\utils\View;
use Bihin\steampunkLibrary\src\controller\FrontController;

class Router
{
	private $frontController;

	public function __construct(){
		$this->frontController = new FrontController();
	}

	public function renderController(){
		if (isset($_GET['route'])) {
			if ($_GET['route'] === 'books') {
				$this->frontController->getBooks();
			}
			elseif ($_GET['route'] === 'book') {
				$this->frontController->getABook();
			}
		} else {
			$display = new View('home');
			$display->render();
		}
	}
}
