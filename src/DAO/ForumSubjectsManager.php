<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\{
	DbConnect,
	SubscriberManager
};

use Bihin\steampunkLibrary\src\model\ForumSubjects;

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
}
