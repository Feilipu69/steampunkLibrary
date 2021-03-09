<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\AgreeDisagree;

class AgreeDisagreeManager extends DbConnect 
{
	public function countAllAgreeOpinion($opinionId){
		$req = $this->db->prepare('SELECT COUNT(*) FROM flagOpinions WHERE opinionId = ?');
		$req->execute([
			$opinionId
		]);
		$data = $req->fetch();
		return $data;
	}

	public function countAgreeOpinion($opinionId){
		$req = $this->db->prepare('SELECT COUNT(*) FROM flagOpinions WHERE subscriberIdAgree = ? AND opinionId = ?');
		$req->execute([
			$_SESSION['subscriberId'],
			$opinionId
		]);
		$data = $req->fetch();
		return $data;
	}

	public function addAgree($opinionId){
		$req = $this->db->prepare('INSERT INTO flagOpinions (opinionId, subscriberLogin, forumSubjectsId, subscriberIdAgree) SELECT id, login, idForum, agree FROM opinions WHERE id = ?');
		$req->execute([
			$opinionId
		]);
	}

	public function removeAgree($opinionId){
		$req = $this->db->prepare('DELETE FROM flagOpinions WHERE subscriberIdAgree = ? AND opinionId = ?');
		$req->execute([
			$_SESSION['subscriberId'],
			$opinionId
		]);
	}

	public function countAllDisagreeOpinion($opinionId){
		$req = $this->db->prepare('SELECT COUNT(*) FROM flagOpinions WHERE opinionId = ?');
		$req->execute([
			$opinionId
		]);
		$data = $req->fetch();
		return $data;
	}

	public function countDisagreeOpinion($opinionId){
		$req = $this->db->prepare('SELECT COUNT(*) FROM flagOpinions WHERE subscriberIdDisagree = ? AND opinionId = ?');
		$req->execute([
			$_SESSION['subscriberId'],
			$opinionId
		]);
		$data = $req->fetch();
		return $data;
	}

	public function addDisagree($opinionId){
		$req = $this->db->prepare('INSERT INTO flagOpinions (opinionId, subscriberLogin, forumSubjectsId, subscriberIdDisagree) SELECT id, login, idForum, disagree FROM opinions WHERE id = ?');
		$req->execute([
			$opinionId
		]);
	}

	public function removeDisagree($opinionId){
		$req = $this->db->prepare('DELETE FROM flagOpinions WHERE subscriberIdDisagree = ? AND opinionId = ?');
		$req->execute([
			$_SESSION['subscriberId'],
			$opinionId
		]);
	}
}
