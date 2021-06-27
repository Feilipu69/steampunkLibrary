<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\AgreeDisagree;

class AgreeDisagreeManager extends DbConnect 
{
	public function getAllVotes($commentId){
		$req = $this->db->prepare('SELECT agree, disagree FROM likeDislike WHERE commentId = ?');
		$req->execute([
			$commentId
		]);
		$data = $req->fetchAll(); 
		return $data;
	}

	public function countSubscriberVotes($commentId, $vote){
		if ($vote === 'agree') {
			$req = $this->db->prepare('SELECT COUNT(*) FROM likeDislike WHERE commentId = ? AND agree = ?');
			$req->execute([
				$commentId,
				$_SESSION['subscriberId']
			]);
			$data = $req->fetch();
			return $data;
		} elseif ($vote === 'disagree') {
			$req = $this->db->prepare('SELECT COUNT(*) FROM likeDislike WHERE commentId = ? AND disagree = ?');
			$req->execute([
				$commentId,
				$_SESSION['subscriberId']
			]);
			$data = $req->fetch();
			return $data;
		}
	}

	public function addVote($commentId, $vote){
		if ($vote === 'agree') {
			$req = $this->db->prepare('INSERT INTO likeDislike(subscriberId, commentId, agree) VALUES(:subscriberId, :commentId, :agree)');
			$req->execute([
				':subscriberId' => $_SESSION['subscriberId'],
				':commentId' => $commentId,
				':agree' => $_SESSION['subscriberId']
			]);
		} elseif ($vote === 'disagree') {
			$req = $this->db->prepare('INSERT INTO likeDislike(subscriberId, commentId, disagree) VALUES(:subscriberId, :commentId, :disagree)');
			$req->execute([
				':subscriberId' => $_SESSION['subscriberId'],
				':commentId' => $commentId,
				':disagree' => $_SESSION['subscriberId']
			]);
		}
	}

	public function removeVote($commentId, $vote){
		if ($vote === 'agree') {
			$req = $this->db->prepare('DELETE FROM likeDislike WHERE agree = ? AND commentId = ?');
			$req->execute([
				$_SESSION['subscriberId'],
				$commentId
			]);
		} elseif ($vote === 'disagree') {
			$req = $this->db->prepare('DELETE FROM likeDislike WHERE disagree = ? AND commentId = ?');
			$req->execute([
				$_SESSION['subscriberId'],
				$commentId
			]);
		}
	}
}
