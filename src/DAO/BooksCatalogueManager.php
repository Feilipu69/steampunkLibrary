<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\BooksCatalogue;

class BooksCatalogueManager extends DbConnect
{
	public function getBooks(){
		$req = $this->db->query('SELECT * FROM booksCatalogue');
		while ($data = $req->fetch()) {
			$books[] = new BooksCatalogue($data);
		}
		return $books;
	}
	public function addOneBook($post){
		$book = new BooksCatalogue($post);
		$req = $this->db->prepare('INSERT INTO booksCatalogue (isbn) VALUES (:isbn)');
		$req->execute([
			'isbn' => $book->getIsbn()
		]);
	}
}
