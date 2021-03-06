<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\AgreeDisagree;

class AgreeDisagreeManager extends DbConnect 
{
	public function getAllVotes($commentId){
		$req = $this->db->prepare('SELECT agree, disagree FROM steampunkLibrary_likeDislike WHERE commentId = ?');
		$req->execute([
			$commentId
		]);
		$data = $req->fetchAll(); 
		return $data;
		$req->closeCursor();
	}

	public function countSubscriberVotes($commentId, $vote){
		if ($vote === 'agree') {
			$req = $this->db->prepare('SELECT COUNT(*) FROM steampunkLibrary_likeDislike WHERE commentId = ? AND agree = ?');
			$req->execute([
				$commentId,
				$_SESSION['subscriberId']
			]);
			$data = $req->fetch();
			return $data;
			$req->closeCursor();
		} elseif ($vote === 'disagree') {
			$req = $this->db->prepare('SELECT COUNT(*) FROM steampunkLibrary_likeDislike WHERE commentId = ? AND disagree = ?');
			$req->execute([
				$commentId,
				$_SESSION['subscriberId']
			]);
			$data = $req->fetch();
			return $data;
			$req->closeCursor();
		}
	}

	public function addVote($commentId, $vote){
		if ($vote === 'agree') {
			$req = $this->db->prepare('INSERT INTO steampunkLibrary_likeDislike(subscriberId, commentId, agree) VALUES(:subscriberId, :commentId, :agree)');
			$req->execute([
				':subscriberId' => $_SESSION['subscriberId'],
				':commentId' => $commentId,
				':agree' => $_SESSION['subscriberId']
			]);
		} elseif ($vote === 'disagree') {
			$req = $this->db->prepare('INSERT INTO steampunkLibrary_likeDislike(subscriberId, commentId, disagree) VALUES(:subscriberId, :commentId, :disagree)');
			$req->execute([
				':subscriberId' => $_SESSION['subscriberId'],
				':commentId' => $commentId,
				':disagree' => $_SESSION['subscriberId']
			]);
		}
	}

	public function removeVote($commentId, $vote){
		if ($vote === 'agree') {
			$req = $this->db->prepare('DELETE FROM steampunkLibrary_likeDislike WHERE agree = ? AND commentId = ?');
			$req->execute([
				$_SESSION['subscriberId'],
				$commentId
			]);
		} elseif ($vote === 'disagree') {
			$req = $this->db->prepare('DELETE FROM steampunkLibrary_likeDislike WHERE disagree = ? AND commentId = ?');
			$req->execute([
				$_SESSION['subscriberId'],
				$commentId
			]);
		}
	}

	public function deleteAllVotesOfASubscriber($subscriberId){
		$req = $this->db->prepare('DELETE FROM steampunkLibrary_likeDislike WHERE subscriberId = ?');
		$req->execute([
			$subscriberId
		]);
	}

	public function deleteVoteOfAComment($id){
		$req = $this->db->prepare('DELETE FROM steampunkLibrary_likeDislike WHERE commentId = ?');
		$req->execute([
			$id
		]);
	}
}
