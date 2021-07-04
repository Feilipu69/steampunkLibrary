<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\Subscriber;

class SubscriberManager extends DbConnect
{
	public function getSubscribers(){
		$req = $this->db->query('SELECT * FROM steampunkLibrary_subscribers');
		while ($data = $req->fetch()) {
			$subscribers[] = new Subscriber($data);
		}
		return $subscribers;
	}

	public function getOneSubscriber(){
		$req = $this->db->prepare('SELECT * FROM steampunkLibrary_subscribers WHERE login = ?');
		$req->execute([
			$_SESSION['login']
		]);
		while ($data = $req->fetch()) {
			$subscriber = new Subscriber($data);
		}
		return $subscriber;
	}

	public function checkSubscriber($post){
		$subscriber= new Subscriber($post);
		$req = $this->db->prepare('SELECT COUNT(login) FROM steampunkLibrary_subscribers WHERE login  = ?');
		$req->execute([
			$subscriber->getLogin()
		]);
		$subscriberChecked = $req->fetchColumn();
		return $subscriberChecked;
	}

	public function checkPassword($post){
		$subscriber = new Subscriber($post);
		$req = $this->db->prepare('SELECT password FROM steampunkLibrary_subscribers WHERE login = ?');
		$req->execute([
			$subscriber->getLogin()
		]);
		$subscriberData = $req->fetch();
		$subscriberPassword = password_verify($subscriber->getPassword(), $subscriberData['password']);
		return $subscriberPassword;
	}

	public function register($post){
		$subscriber = new Subscriber($post);
		$req = $this->db->prepare('INSERT INTO steampunkLibrary_subscribers(login, password, email, record, role) VALUES(:login, :password, :email, NOW(), "member")');
		$req->execute([
			':login' => $subscriber->getLogin(),
			':password' => password_hash($subscriber->getPassword(), PASSWORD_DEFAULT),
			':email' => $subscriber->getEmail()
		]);
	}

	public function updateData($post){
		$req = $this->db->prepare('UPDATE steampunkLibrary_subscribers SET login = :login, password = :password, email = :email WHERE id = :id');
		$req->execute([
			'login' => $post['login'],
			'password' => password_hash($post['password'], PASSWORD_DEFAULT),
			'email' => $post['email'],
			'id' => $_SESSION['subscriberId']
		]);
	}

	public function deleteSubscriber($subscriberId){
		$req = $this->db->prepare('DELETE FROM steampunkLibrary_subscribers WHERE id = ?');
		$req->execute([
			$subscriberId
		]);
	}

	public function getRole($id){
		$req = $this->db->prepare('SELECT role FROM steampunkLibrary_subscribers WHERE id = ?');
		$req->execute([
			$id
		]);
		$data = $req->fetch();
		return $data;
	}

	public function moderator($id){
		$req = $this->db->prepare('UPDATE steampunkLibrary_subscribers SET role = "moderator" WHERE id = ?');
		$req->execute([
			$id
		]);
	}

	public function member($id){
		$req = $this->db->prepare('UPDATE steampunkLibrary_subscribers SET role = "member" WHERE id = ?');
		$req->execute([
			$id
		]);
	}

	public function deleteMember($id){
		$req = $this->db->prepare('DELETE FROM steampunkLibrary_subscribers WHERE id = ?');
		$req->execute([
			$id
		]);
	}
}
