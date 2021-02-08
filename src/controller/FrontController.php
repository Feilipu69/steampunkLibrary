<?php
namespace Bihin\steampunkLibrary\src\controller;

use Bihin\steampunkLibrary\utils\View;

class FrontController
{
	public function getBooks(){
		$displayBooks = new View('books');
		$displayBooks->render();
	}
}
