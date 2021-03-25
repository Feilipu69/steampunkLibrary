<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\AgreeDisagree;

class AgreeDisagreeManager extends DbConnect 
{
	public function getAllVotes($opinionId){
		$votes = [];
		$req = $this->db->prepare('SELECT agree, disagree FROM likeDislike WHERE opinionId = ?');
		$req->execute([
			$opinionId
		]);
		while ($data = $req->fetch()) {
			$votes[] = $data;
		}
		return $votes;
	}

	public function countAllVotes($opinionId, $vote){
		if ($vote === 'agree') {
			$req = $this->db->prepare('SELECT COUNT(*) FROM likeDislike WHERE opinionId = ? AND agree != 0');
			$req->execute([
				$opinionId
			]);
			$data = $req->fetch();
			return $data;
		} elseif ($vote === 'disagree') {
			$req = $this->db->prepare('SELECT COUNT(*) FROM likeDislike WHERE opinionId = ? AND disagree != 0');
			$req->execute([
				$opinionId
			]);
			$data = $req->fetch();
			return $data;
		}
	}

	public function countSubscriberVotes($opinionId, $vote){
		if ($vote === 'agree') {
			$req = $this->db->prepare('SELECT COUNT(*) FROM likeDislike WHERE opinionId = ? AND agree = ?');
			$req->execute([
				$opinionId,
				$_SESSION['subscriberId']
			]);
			$data = $req->fetch();
			return $data;
		} elseif ($vote === 'disagree') {
			$req = $this->db->prepare('SELECT COUNT(*) FROM likeDislike WHERE opinionId = ? AND disagree = ?');
			$req->execute([
				$opinionId,
				$_SESSION['subscriberId']
			]);
			$data = $req->fetch();
			return $data;
		}
	}

	public function likeDislikeOpinion($opinionId, $vote){
		if ($vote === 'agree') {
			$req = $this->db->prepare('INSERT INTO likeDislike(subscriberId, opinionId, agree) VALUES(:subscriberId, :opinionId, :agree)');
			$req->execute([
				':subscriberId' => $_SESSION['subscriberId'],
				':opinionId' => $opinionId,
				':agree' => $_SESSION['subscriberId']
			]);
		} elseif ($vote === 'disagree') {
			$req = $this->db->prepare('INSERT INTO likeDislike(subscriberId, opinionId, disagree) VALUES(:subscriberId, :opinionId, :disagree)');
			$req->execute([
				':subscriberId' => $_SESSION['subscriberId'],
				':opinionId' => $opinionId,
				':disagree' => $_SESSION['subscriberId']
			]);
		}
	}

	public function removeVote($opinionId, $vote){
		if ($vote === 'agree') {
			$req = $this->db->prepare('DELETE FROM likeDislike WHERE agree = ? AND opinionId = ?');
			$req->execute([
				$_SESSION['subscriberId'],
				$opinionId
			]);
		} elseif ($vote === 'disagree') {
			$req = $this->db->prepare('DELETE FROM likeDislike WHERE disagree = ? AND opinionId = ?');
			$req->execute([
				$_SESSION['subscriberId'],
				$opinionId
			]);
		}
	}
}
