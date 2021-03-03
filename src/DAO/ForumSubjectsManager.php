<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\{
	DbConnect,
	SubscriberManager
};

use Bihin\steampunkLibrary\src\model\{
	ForumSubjects,
	Opinion
};

class ForumSubjectsManager extends DbConnect{
	public function getSubject($parameter){
		$req = $this->db->prepare('SELECT id, loginSubscriber, subject, title, content, DATE_FORMAT(date, "%d/%m/%Y") AS date FROM forumSubjects WHERE subject = ?');
		$req->execute([
			$parameter
		]);
		while ($data = $req->fetch()) {
			$subject[] = new ForumSubjects($data);
		}
		if (isset($subject)) {
			return $subject;
		}
	}

	public function getSubjectById($parameter){
		$req = $this->db->prepare('SELECT id, loginSubscriber, subject, title, content, DATE_FORMAT(date, "%d/%m/%Y") AS date FROM forumSubjects WHERE id = ?');
		$req->execute([
			$parameter
		]);
		$data = $req->fetch();
		$id = new ForumSubjects($data);
		return $id;
	}

	public function addForumTheme($post){
		$req = $this->db->prepare('INSERT INTO forumSubjects (loginSubscriber, subject, title, content, date) VALUES (:loginSubscriber, :subject, :title, :content, NOW())');
		$req->execute([
			'loginSubscriber' => $_SESSION['login'],
			'subject' => $post['subject'],
			'title' => $post['title'],
			'content' => $post['content']
		]);
	}

	public function mySubjects(){
		$req = $this->db->prepare('SELECT * FROM forumSubjects WHERE loginSubscriber = ?');
		$req->execute([
			$_SESSION['login']
		]);
		while ($data = $req->fetch()) {
			$mySubjects[] = new ForumSubjects($data);
		}
		if (isset($mySubjects)) {
			return $mySubjects;
		}
	}

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
}
