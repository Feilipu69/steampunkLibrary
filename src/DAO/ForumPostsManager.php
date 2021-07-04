<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\{
	DbConnect,
	SubscriberManager
};

use Bihin\steampunkLibrary\src\model\{
	ForumPosts
};

class ForumPostsManager extends DbConnect 
{
	public function getPost($post){
		$req = $this->db->prepare('SELECT fp.id, fp.post, fp.title, fp.content, DATE_FORMAT(fp.date, "%d/%m/%Y") AS date, s.login FROM steampunkLibrary_forumPosts fp INNER JOIN steampunkLibrary_subscribers s ON fp.subscriberId = s.id WHERE fp.post = ? ORDER BY fp.id DESC');
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
		$req = $this->db->prepare('SELECT fp.id, fp.post, fp.title, fp.content, DATE_FORMAT(fp.date, "%d/%m/%Y") AS date, s.login FROM steampunkLibrary_forumPosts fp INNER JOIN steampunkLibrary_subscribers s ON fp.subscriberId = s.id WHERE fp.id = ?');
		$req->execute([
			$forumId
		]);
		$data = $req->fetch();
		$post = new ForumPosts($data);
		return $post;
	}

	public function addForumPost($post){
		$req = $this->db->prepare('INSERT INTO steampunkLibrary_forumPosts (subscriberId, post, title, content, date) VALUES (:subscriberId, :post, :title, :content, NOW())');
		$req->execute([
			'subscriberId' => $_SESSION['subscriberId'],
			'post' => $_GET['parameter'],
			'title' => $post['title'],
			'content' => $post['content']
		]);
	}

	public function myPosts(){
		$req = $this->db->prepare('SELECT id, subscriberId, post, title, content, DATE_FORMAT(date, "%d/%m/%Y") AS date FROM steampunkLibrary_forumPosts WHERE subscriberId = ?');
		$req->execute([
			$_SESSION['subscriberId']
		]);
		while ($data = $req->fetch()) {
			$myPosts[] = new ForumPosts($data);
		}
		if (isset($myPosts)) {
			return $myPosts;
		}
	}

	public function updatePost($post, $id){
		$req = $this->db->prepare('UPDATE steampunkLibrary_forumPosts SET title = :title, content = :content, date = NOW() WHERE id = :id');
		$req->execute([
			'title' => $post['title'],
			'content' => $post['content'],
			'id' => $id
		]);
	}

	public function deletePost($id){
		$req = $this->db->prepare('DELETE FROM steampunkLibrary_forumPosts WHERE id = ?');
		$req->execute([
			$id
		]);
	}
}
