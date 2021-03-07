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

	public function addForumTheme($post, $parameter){
		$req = $this->db->prepare('INSERT INTO forumSubjects (loginSubscriber, subject, title, content, date) VALUES (:loginSubscriber, :subject, :title, :content, NOW())');
		$req->execute([
			'loginSubscriber' => $_SESSION['login'],
			'subject' => $_GET['parameter'],
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

	public function updateSubject($post, $parameter){
		$req = $this->db->prepare('UPDATE forumSubjects SET loginSubscriber = :loginSubscriber, title = :title, content = :content, date = NOW() WHERE id = :id');
		$req->execute([
			'loginSubscriber' => $_SESSION['login'],
			'title' => $post['title'],
			'content' => $post['content'],
			'id' => $parameter
		]);
	}

	public function deleteSubject($parameter){
		$req = $this->db->prepare('DELETE FROM forumSubjects WHERE id = ?');
		$req->execute([
			$parameter
		]);
	}
}
