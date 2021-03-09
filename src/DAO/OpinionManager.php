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

	public function getOpinions($parameter){
		$req = $this->db->prepare('SELECT * FROM opinions WHERE idForum = ?');
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

	public function AddOpinionAgree($opinionId){
		$req = $this->db->prepare('UPDATE opinions SET agree = ? WHERE id = ?');
		$req->execute([
			$_SESSION['subscriberId'],
			$opinionId
		]);
	}

	public function removeOpinionAgree($opinionId){
		$req = $this->db->prepare('UPDATE opinions SET agree = 0 WHERE id = ?');
		$req->execute([
			$opinionId
		]);
	}

	/*
	public function opinionDisagree($parameter){
		$req = $this->db->prepare('UPDATE opinions SET disagree = ? WHERE id = ?');
		$req->execute([
			$_SESSION['subscriberId'],
			$parameter
		]);
	}

	public function opinionDeleteDisagree($parameter){
		$req = $this->db->prepare('UPDATE opinions SET disagree = 0 WHERE id = ?');
		$req->execute([
			$parameter
		]);
	}
	*/
}
