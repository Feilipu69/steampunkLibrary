<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\AgreeDisagree;

class AgreeDisagreeManager extends DbConnect 
{

	public function getAllOpinions($opinionId, $first, $quantity){
		$req = $this->db->prepare('SELECT * FROM opinions WHERE idForum = ? LIMIT ' . $first . ', ' . $quantity);
		$req->execute([
			$opinionId
		]);
		$data = $req->fetchAll();
	}

	public function countAllOpinions($opinionId){
		$req = $this->db->prepare('SELECT COUNT(*) FROM opinions WHERE idForum = ?');
		$req->execute([
			$opinionId
		]);
		$data = $req->fetch();
		return $data;
	}

	public function getAllVotes($opinionId){
		$req = $this->db->prepare('SELECT * FROM likeDislike WHERE opinionId = ?');
		$req->execute([
			$opinionId
		]);
	}

	public function countAllVotes($opinionId, $vote){
		if ($vote === 'subscriberIdAgree') {
			$req = $this->db->prepare('SELECT COUNT(*) FROM likeDislike WHERE opinionId = ? AND subscriberIdAgree != 0');
			$req->execute([
				$opinionId
			]);
			$data = $req->fetch();
			return $data;
		} elseif ($vote === 'subscriberIdDisagree') {
			$req = $this->db->prepare('SELECT COUNT(*) FROM likeDislike WHERE opinionId = ? AND subscriberIdDisagree != 0');
			$req->execute([
				$opinionId
			]);
			$data = $req->fetch();
			return $data;
		}
	}

	public function countVotes($opinionId, $vote){
		if ($vote === 'subscriberIdAgree') {
			$req = $this->db->prepare('SELECT COUNT(*) FROM likeDislike WHERE opinionId = ? AND subscriberIdAgree = ?');
			$req->execute([
				$opinionId,
				$_SESSION['subscriberId']
			]);
			$data = $req->fetch();
			return $data;
		} elseif ($vote === 'subscriberIdDisagree') {
			$req = $this->db->prepare('SELECT COUNT(*) FROM likeDislike WHERE opinionId = ? AND subscriberIdDisagree = ?');
			$req->execute([
				$opinionId,
				$_SESSION['subscriberId']
			]);
			$data = $req->fetch();
			return $data;
		}
	}

	public function likeDislikeOpinion($opinionId, $subscriberIdOpinion){
		if ($subscriberIdOpinion === 'subscriberIdAgree') {
			$req = $this->db->prepare('INSERT INTO likeDislike(login, opinionId, subscriberIdAgree) VALUES(:login, :opinionId, :subscriberIdAgree)');
			$req->execute([
				':login' => $_SESSION['login'],
				':opinionId' => $opinionId,
				':subscriberIdAgree' => $_SESSION['subscriberId']
			]);
		} elseif ($subscriberIdOpinion === 'subscriberIdDisagree') {
			$req = $this->db->prepare('INSERT INTO likeDislike(login, opinionId, subscriberIdDisagree) VALUES(:login, :opinionId, :subscriberIdDisagree)');
			$req->execute([
				':login' => $_SESSION['login'],
				':opinionId' => $opinionId,
				':subscriberIdDisagree' => $_SESSION['subscriberId']
			]);
		}
	}

	public function removeVote($opinionId, $subscriberIdOpinion){
		if ($subscriberIdOpinion === 'subscriberIdAgree') {
			$req = $this->db->prepare('DELETE FROM likeDislike WHERE subscriberIdAgree = ? AND opinionId = ?');
			$req->execute([
				$_SESSION['subscriberId'],
				$opinionId
			]);
		} elseif ($subscriberIdOpinion === 'subscriberIdDisagree') {
			$req = $this->db->prepare('DELETE FROM likeDislike WHERE subscriberIdDisagree = ? AND opinionId = ?');
			$req->execute([
				$_SESSION['subscriberId'],
				$opinionId
			]);
		}
	}
}
