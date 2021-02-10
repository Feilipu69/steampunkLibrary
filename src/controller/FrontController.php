<?php
namespace Bihin\steampunkLibrary\src\controller;

use Bihin\steampunkLibrary\src\DAO\OpinionManager;
use Bihin\steampunkLibrary\utils\View;

class FrontController
{
	public function getBooks(){
		$displayBooks = new View('books');
		$displayBooks->render();
	}

	public function getABook($isbn){
		$opinions = new OpinionManager();
		$opinion = $opinions->getOpinions($isbn);
		$displayABook = new View('book');
		$displayABook->render(['opinion' => $opinion]);
	}
}
