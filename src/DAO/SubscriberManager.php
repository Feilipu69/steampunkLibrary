<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\Subscriber;

class SubscriberManager extends DbConnect
{
	public function checkSubscriber($post){
		$subscriber= new Subscriber($post);
		$req = $this->db->prepare('SELECT COUNT(login) FROM subscribers WHERE login  = ?');
		$req->execute([
			$subscriber->getLogin()
		]);
		$subscriberChecked = $req->fetchColumn();
		return $subscriberChecked;
	}

	public function register($post){
		$subscriber = new Subscriber($post);
		$req = $this->db->prepare('INSERT INTO subscribers(login, password, email, record, role) VALUES(:login, :password, :email, NOW(), 2)');
		$req->execute([
			':login' => $subscriber->getLogin(),
			':password' => password_hash($subscriber->getPassword(), PASSWORD_DEFAULT),
			':email' => $subscriber->getEmail()
		]);
	}
}
