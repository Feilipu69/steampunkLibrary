<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\Comments;

class CommentsManager extends DbConnect
{
	public function addAComment($post, $forumId){
		$req = $this->db->prepare('INSERT INTO steampunkLibraryComments (subscriberId, forumId, comment, dateOfComment) VALUES (:subscriberId, :forumId, :comment, NOW())');
		$req->execute([
			':subscriberId' => $_SESSION['subscriberId'],
			':forumId' => $forumId,
			':comment' => $post['comment']
		]);
	}

	public function countAllComments($forumId){
		$req = $this->db->prepare('SELECT COUNT(*) FROM steampunkLibraryComments WHERE forumId = ?');
		$req->execute([
			$forumId
		]);
		$data = $req->fetch();
		return $data;
	}

	public function getComments($forumId, $first, $byPage){
		$req = $this->db->prepare('SELECT slc.id, slc.subscriberId, slc.forumId, slc.comment, DATE_FORMAT(slc.dateOfComment, "%d/%m/%Y") AS dateOfComment, s.login FROM steampunkLibraryComments slc INNER JOIN subscribers s ON slc.subscriberId = s.id WHERE forumId = ? ORDER BY id DESC LIMIT ' . $first . ', ' . $byPage);
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

	public function getMyComments(){
		$req = $this->db->prepare('SELECT slc.id, slc.subscriberId, slc.forumId, slc.comment, DATE_FORMAT(slc.dateOfComment, "%d/%m/%Y") AS dateOfComment, fp.title, s.login FROM steampunkLibraryComments slc INNER JOIN forumPosts fp ON slc.forumId = fp.id INNER JOIN subscribers s ON slc.subscriberId = s.id WHERE slc.subscriberId = ? ORDER BY slc.id DESC');
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
		$req = $this->db->prepare('UPDATE steampunkLibraryComments SET ' . $comment . ' = ? WHERE id = ?');
		$req->execute([
			$_SESSION['subscriberId'],
			$commentId
		]);
	}

	public function updateMyComment($post, $id){
		$req = $this->db->prepare('UPDATE steampunkLibraryComments SET comment = :comment WHERE id = :id');
		$req->execute([
			'comment' => $post['comment'],
			'id' => $id
		]);
	}

	public function removeComment($commentId, $comment){
		$req = $this->db->prepare('UPDATE steampunkLibraryComments SET ' . $comment . ' = 0 WHERE id = ?');
		$req->execute([
			$commentId
		]);
	}

	public function commentDeleteDisagree($parameter){
		$req = $this->db->prepare('UPDATE steampunkLibraryComments SET disagree = 0 WHERE id = ?');
		$req->execute([
			$parameter
		]);
	}
	
	public function deleteComment($id){
		$req = $this->db->prepare('DELETE FROM steampunkLibraryComments WHERE id = ?');
		$req->execute([
			$id
		]);
	}

	public function deleteCommentByPost($forumId){
		$req = $this->db->prepare('DELETE FROM steampunkLibraryComments WHERE forumId = ?');
		$req->execute([
			$forumId
		]);
	}

	public function deleteAllCommentsOfASubscriber($subscriberId){
		$req = $this->db->prepare('DELETE FROM steampunkLibraryComments WHERE subscriberId = ?');
		$req->execute([
			$subscriberId
		]);
	}
}
