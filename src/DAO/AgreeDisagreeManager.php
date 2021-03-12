<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\AgreeDisagree;

class AgreeDisagreeManager extends DbConnect 
{

	public function getAllOpinions($opinionId, $table, $first, $quantity){
		$req = $this->db->prepare('SELECT * FROM ' . $table . ' WHERE idForum = ? LIMIT ' . $first . ', ' . $quantity);
		$req->execute([
			$opinionId
		]);
		$data = $req->fetchAll();
	}

	public function countAllOpinions($opinionId, $table, $column){
		$req = $this->db->prepare('SELECT COUNT(*) FROM ' . $table . ' WHERE ' . $column . ' = ?');
		$req->execute([
			$opinionId
		]);
		$data = $req->fetch();
		return $data;
	}

	public function countOpinion($opinionId, $table, $column){
		$req = $this->db->prepare('SELECT COUNT(*) FROM ' . $table . ' WHERE ' . $column . ' = ? AND opinionId = ?');
		$req->execute([
			$_SESSION['subscriberId'],
			$opinionId
		]);
		$data = $req->fetch();
		return $data;
	}

	public function addOpinion($opinionId, $table, $column, $opinionsColumn){
		$req = $this->db->prepare('INSERT INTO ' . $table . ' (opinionId, subscriberLogin, forumSubjectsId, ' . $column . ') SELECT id, login, idForum, ' . $opinionsColumn . ' FROM opinions WHERE id = ?');
		$req->execute([
			$opinionId
		]);
	}

	public function removeOpinion($opinionId, $table, $column){
		$req = $this->db->prepare('DELETE FROM ' . $table . ' WHERE ' . $column . ' = ? AND opinionId = ?');
		$req->execute([
			$_SESSION['subscriberId'],
			$opinionId
		]);
	}
}
