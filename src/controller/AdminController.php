<?php
namespace Bihin\steampunkLibrary\src\controller;

use Bihin\steampunkLibrary\src\DAO\BooksCatalogueManager;	
use Bihin\steampunkLibrary\utils\View;

class AdminController
{
	public function addABook($book){
		if (isset($book['addABook'])) {
			if (!empty($book['isbn'])) {
				$newBook = new BooksCatalogueManager();
				$newBook->addABook($book);
			}
		}

		$displayForm = new View('newBook');
		$displayForm->render([]);
	}
}
