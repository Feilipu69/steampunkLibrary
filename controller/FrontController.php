<?php
namespace Bihin\steampunkLibrary\controller;

require_once 'utils/View.php';
use Bihin\steampunkLibrary\utils\View;

class FrontController
{
	public function getBooks(){
		$displayBooks = new View('books');
		$displayBooks->render();
	}
}
