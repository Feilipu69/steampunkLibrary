<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\BooksCatalogue;

class BooksCatalogueManager extends DbConnect
{
	public function catalogue(){
		$req = $this->db->query('SELECT * FROM booksCatalogue');
		$data = $req->fetch();
		$catalogue[] = new BooksCatalogue($data);
		return $catalogue;
	}

	public function getBooks($first, $byPage){
		$req = $this->db->query('SELECT * FROM booksCatalogue ORDER BY id DESC LIMIT ' . $first . ', ' . $byPage);
		while ($data = $req->fetch()) {
			$books[] = new BooksCatalogue($data);
		}
		return $books;
	}

	public function countAllBooks(){
		$req = $this->db->query('SELECT COUNT(*) FROM booksCatalogue');
		$allBooks = $req->fetch();
		return $allBooks[0];
	}

	public function addOneBook($post){
		$book = new BooksCatalogue($post);
		$req = $this->db->prepare('INSERT INTO booksCatalogue (isbn) VALUES (:isbn)');
		$req->execute([
			'isbn' => $book->getIsbn()
		]);
	}
}
