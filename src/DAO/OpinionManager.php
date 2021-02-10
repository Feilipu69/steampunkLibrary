<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\Opinion;

class OpinionManager extends DbConnect
{
	public function getOpinions($isbn){
		$opinions = [];
		$req = $this->db->prepare('SELECT id, isbn, comment, DATE_FORMAT(dateOfComment, "%d/%m/%Y") AS dateOfComment FROM opinion WHERE isbn = ? ORDER BY id DESC');
		$req->execute([$isbn]);
		while($data = $req->fetch()){
			$opinions[] = new Opinion($data);
		}
		return $opinions;
	}
}
