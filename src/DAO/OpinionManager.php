<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\Opinion;

class OpinionManager extends DbConnect
{
	public function addOpinion($post, $forumId){
		$req = $this->db->prepare('INSERT INTO opinions (login, forumId, comment, dateOfComment) VALUES (:login, :forumId, :comment, NOW())');
		$req->execute([
			':login' => $post['login'],
			':forumId' => $forumId,
			':comment' => $post['comment']
		]);
	}

	public function countAllOpinions($forumId){
		$req = $this->db->prepare('SELECT COUNT(*) FROM opinions WHERE forumId = ?');
		$req->execute([
			$forumId
		]);
		$data = $req->fetch();
		return $data;
	}

	public function getOpinions($forumId, $first, $byPage){
		$req = $this->db->prepare('SELECT * FROM opinions WHERE forumId = ? ORDER BY id DESC LIMIT ' . $first . ', ' . $byPage);
		$req->execute([
			$forumId
		]);
		while ($data = $req->fetch()) {
			$opinions[] = new Opinion($data);
		}
		if (isset($opinions)) {
			return $opinions;
		}
	}

	public function getAnOpinion($id){
		$req = $this->db->prepare('SELECT * FROM opinions WHERE id = ?');
		$req->execute([
			$id
		]);
		$data = $req->fetch();
		$opinionData = new Opinion($data);
		return $opinionData;
	}

	public function getMyOpinions(){
		$req = $this->db->prepare('SELECT o.id, o.login, o.forumId, o.comment, DATE_FORMAT(o.dateOfComment, "%d/%m/%Y") AS dateOfComment, fp.title FROM opinions o INNER JOIN forumPosts fp ON o.forumId = fp.id WHERE o.login = ? ORDER BY o.id DESC');
		$req->execute([
			$_SESSION['login']
		]);
		while ($data = $req->fetch()){
			$myOpinions[] = new Opinion($data); 
		}
		if(isset($myOpinions)){
			return $myOpinions;
		}
	}

	public function addLikeDislike($opinionId, $opinion){
		$req = $this->db->prepare('UPDATE opinions SET ' . $opinion . ' = ? WHERE id = ?');
		$req->execute([
			$_SESSION['subscriberId'],
			$opinionId
		]);
	}

	public function updateMyOpinion($post, $id){
		$req = $this->db->prepare('UPDATE opinions SET comment = :comment WHERE id = :id');
		$req->execute([
			'comment' => $post['comment'],
			'id' => $id
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

	public function deleteOpinionByPost($forumId){
		$req = $this->db->prepare('DELETE FROM opinions WHERE forumId = ?');
		$req->execute([
			$forumId
		]);
	}
}
