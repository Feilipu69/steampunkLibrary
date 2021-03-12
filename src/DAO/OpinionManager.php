<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\Opinion;

class OpinionManager extends DbConnect
{
	public function addOpinion($post, $parameter){
		$req = $this->db->prepare('INSERT INTO opinions (login, idForum, comment, dateOfComment) VALUES (:login, :idForum, :comment, NOW())');
		$req->execute([
			':login' => $post['login'],
			':idForum' => $parameter,
			':comment' => $post['comment']
		]);
	}

	public function getOpinions($parameter, $first, $byPage){
		$req = $this->db->prepare('SELECT * FROM opinions WHERE idForum = ? LIMIT ' . $first . ', ' . $byPage);
		$req->execute([
			$parameter
		]);
		while ($data = $req->fetch()) {
			$opinions[] = new Opinion($data);
		}
		if (isset($opinions)) {
			return $opinions;
		}
	}

	public function getAOpinion($parameter){
		$req = $this->db->prepare('SELECT * FROM opinions WHERE id = ?');
		$req->execute([
			$parameter
		]);
		$data = $req->fetch();
		$opinionData = new Opinion($data);
		return $opinionData;
	}

	public function addLikeDislike($opinionId, $opinion){
		$req = $this->db->prepare('UPDATE opinions SET ' . $opinion . ' = ? WHERE id = ?');
		$req->execute([
			$_SESSION['subscriberId'],
			$opinionId
		]);
	}

	public function removeOpinion($opinionId, $opinion){
		$req = $this->db->prepare('UPDATE opinions SET ' . $opinion . ' = 0 WHERE id = ?');
		$req->execute([
			$opinionId
		]);
	}

	public function opinionDeleteDisagree($parameter){
		$req = $this->db->prepare('UPDATE opinions SET disagree = 0 WHERE id = ?');
		$req->execute([
			$parameter
		]);
	}
	
	public function deleteOpinion($id){
		$req = $this->db->prepare('DELETE FROM opinions WHERE id = ?');
		$req->execute([
			$id
		]);
	}
}
