<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\{
	DbConnect,
	SubscriberManager
};

use Bihin\steampunkLibrary\src\model\{
	ForumPosts,
	Opinion
};

class ForumPostsManager extends DbConnect 
{
	public function getPost($post){
		$req = $this->db->prepare('SELECT id, loginSubscriber, post, title, content, DATE_FORMAT(date, "%d/%m/%Y") AS date FROM forumPosts WHERE post = ? ORDER BY id DESC');
		$req->execute([
			$post
		]);
		while ($data = $req->fetch()) {
			$posts[] = new ForumPosts($data);
		}
		if (isset($posts)) {
			return $posts;
		}
	}

	public function getPostById($forumId){
		$req = $this->db->prepare('SELECT id, loginSubscriber, post, title, content, DATE_FORMAT(date, "%d/%m/%Y") AS date FROM forumPosts WHERE id = ?');
		$req->execute([
			$forumId
		]);
		$data = $req->fetch();
		$post = new ForumPosts($data);
		return $post;
	}

	public function addForumPost($post){
		$req = $this->db->prepare('INSERT INTO forumPosts (loginSubscriber, post, title, content, date) VALUES (:loginSubscriber, :post, :title, :content, NOW())');
		$req->execute([
			'loginSubscriber' => $_SESSION['login'],
			'post' => $_GET['parameter'],
			'title' => $post['title'],
			'content' => $post['content']
		]);
	}

	public function myPosts(){
		$req = $this->db->prepare('SELECT id, loginSubscriber, post, title, content, DATE_FORMAT(date, "%d/%m/%Y") AS date FROM forumPosts WHERE loginSubscriber = ?');
		$req->execute([
			$_SESSION['login']
		]);
		while ($data = $req->fetch()) {
			$myPosts[] = new ForumPosts($data);
		}
		if (isset($myPosts)) {
			return $myPosts;
		}
	}

	public function updatePost($post, $id){
		$req = $this->db->prepare('UPDATE forumPosts SET loginSubscriber = :loginSubscriber, title = :title, content = :content, date = NOW() WHERE id = :id');
		$req->execute([
			'loginSubscriber' => $_SESSION['login'],
			'title' => $post['title'],
			'content' => $post['content'],
			'id' => $id
		]);
	}

	public function deletePost($id){
		$req = $this->db->prepare('DELETE FROM forumPosts WHERE id = ?');
		$req->execute([
			$id
		]);
	}
}
