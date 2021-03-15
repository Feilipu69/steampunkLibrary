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

	public function countAllVotes($opinionId, $table, $column, $vote){
		$req = $this->db->prepare('SELECT COUNT(*) FROM ' . $table . ' WHERE ' . $column . ' = ? AND '. $vote . ' != 0');
		$req->execute([
			$opinionId
		]);
		$data = $req->fetch();
		return $data;
	}

	public function countVotes($opinionId, $subscriberIdOpinion){
			$req = $this->db->prepare('SELECT COUNT(*) FROM likeDislike WHERE opinionId = ? AND ' . $subscriberIdOpinion . ' = ?');
			$req->execute([
				$opinionId,
				$_SESSION['subscriberId']
			]);
			$data = $req->fetch();
			return $data;
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
