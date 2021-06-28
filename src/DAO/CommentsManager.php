<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\Comments;

class CommentsManager extends DbConnect
{
	public function addAComment($post, $forumId){
		$req = $this->db->prepare('INSERT INTO comments (subscriberId, forumId, comment, dateOfComment) VALUES (:subscriberId, :forumId, :comment, NOW())');
		$req->execute([
			':subscriberId' => $_SESSION['subscriberId'],
			':forumId' => $forumId,
			':comment' => $post['comment']
		]);
	}

	public function countAllComments($forumId){
		$req = $this->db->prepare('SELECT COUNT(*) FROM comments WHERE forumId = ?');
		$req->execute([
			$forumId
		]);
		$data = $req->fetch();
		return $data;
	}

	public function getComments($forumId, $first, $byPage){
		$req = $this->db->prepare('SELECT c.id, c.subscriberId, c.forumId, c.comment, DATE_FORMAT(c.dateOfComment, "%d/%m/%Y") AS dateOfComment, s.login FROM comments c INNER JOIN subscribers s ON c.subscriberId = s.id WHERE forumId = ? ORDER BY id DESC LIMIT ' . $first . ', ' . $byPage);
		$req->execute([
			$forumId
		]);
		while ($data = $req->fetch()) {
			$comments[] = new Comments($data);
		}
		if (isset($comments)) {
			return $comments;
		}
	}
	
	// Je ne le trouve nul part!
	/*
	public function getAComment($id){
		$req = $this->db->prepare('SELECT * FROM comments WHERE id = ?');
		$req->execute([
			$id
		]);
		$data = $req->fetch();
		$commentData = new Comments($data);
		return $commentData;
	}
	*/

	public function getMyComments(){
		$req = $this->db->prepare('SELECT c.id, c.subscriberId, c.forumId, c.comment, DATE_FORMAT(c.dateOfComment, "%d/%m/%Y") AS dateOfComment, fp.title, s.login FROM comments c INNER JOIN forumPosts fp ON c.forumId = fp.id INNER JOIN subscribers s ON c.subscriberId = s.id WHERE c.subscriberId = ? ORDER BY c.id DESC');
		$req->execute([
			$_SESSION['subscriberId']
		]);
		while ($data = $req->fetch()){
			$myComments[] = new Comments($data); 
		}
		if(isset($myComments)){
			return $myComments;
		}
	}

	public function addLikeDislike($commentId, $comment){
		$req = $this->db->prepare('UPDATE comments SET ' . $comment . ' = ? WHERE id = ?');
		$req->execute([
			$_SESSION['subscriberId'],
			$commentId
		]);
	}

	public function updateMyComment($post, $id){
		$req = $this->db->prepare('UPDATE comments SET comment = :comment WHERE id = :id');
		$req->execute([
			'comment' => $post['comment'],
			'id' => $id
		]);
	}

	public function removeComment($commentId, $comment){
		$req = $this->db->prepare('UPDATE comments SET ' . $comment . ' = 0 WHERE id = ?');
		$req->execute([
			$commentId
		]);
	}

	public function commentDeleteDisagree($parameter){
		$req = $this->db->prepare('UPDATE comments SET disagree = 0 WHERE id = ?');
		$req->execute([
			$parameter
		]);
	}
	
	public function deleteComment($id){
		$req = $this->db->prepare('DELETE FROM comments WHERE id = ?');
		$req->execute([
			$id
		]);
	}

	public function deleteCommentByPost($forumId){
		$req = $this->db->prepare('DELETE FROM comments WHERE forumId = ?');
		$req->execute([
			$forumId
		]);
	}
}
