<?php
namespace Bihin\steampunkLibrary\src\controller;

use Bihin\steampunkLibrary\src\DAO\{
	BooksCatalogueManager,
	MessageDesLeviathansManager,
	OpinionManager,
	SubscriberManager
};

use Bihin\steampunkLibrary\utils\View;

class FrontController
{
	public function getBooks(){
		$booksCatalogue = new BooksCatalogueManager();
		$catalogue = $booksCatalogue->getBooks();
		$displayBooks = new View('books');
		$displayBooks->render([
			'catalogue' => $catalogue
		]);
	}

	public function getABook($isbn){
		$opinions = new OpinionManager();
		$opinion = $opinions->getOpinions($isbn);
		$displayABook = new View('book');
		$displayABook->render(['opinion' => $opinion]);
	}

	public function register($post){
		if (isset($_SESSION['registerError'])) {
			unset($_SESSION['registerError']);
		}

		if (isset($post['register'])) {
			if (!empty($post['login']) && !empty($post['password']) && !empty($post['email'])) {
				$subscriber = new SubscriberManager();
				if ($subscriber->checkSubscriber($post)) {
					$_SESSION['registerError'] = "Ce login existe déjà";
				}
				else {
					$subscriber->register($post);
					$_SESSION['login'] = $post['login'];
					$subscriberData = $subscriber->getASubscriber($post);
					$_SESSION['subscriberId'] = $subscriberData->getId();
					header('Location:' . HOST);
				}
			}
		}

		$displayRegisterForm = new View('register');
		$displayRegisterForm->render([]);
	}

	public function connection($post){
		if (isset($_SESSION['error'])) {
			unset($_SESSION['error']);
		}

		if (isset($post['connection'])) {
			if (!empty($post['login']) && !empty($post['password'])) {
				$subscriber = new SubscriberManager();
				if ($subscriber->checkPassword($post)) {
					$_SESSION['login'] = $post['login'];
					$subscriberData = $subscriber->getASubscriber($post);
					$role = $subscriberData->getRole();
					$_SESSION['role'] = $role;
					$_SESSION['subscriberId'] = $subscriberData->getId();
					header('Location:' . HOST);
				}
				else {
					$_SESSION['error'] = "Login ou mot de passe incorrects";
				}
			}
		}

		$displayConnection = new View('connection');
		$displayConnection->render([]);
	}

	public function updateData($post){
		if (isset($_SESSION['registerError'])) {
			unset($_SESSION['registerError']);
		}

		if (isset($post['account'])) {
			if (!empty($post['login']) && !empty($post['password']) && !empty($post['email'])) {
				$subscriber = new SubscriberManager();
				if ($subscriber->checkSubscriber($post)) {
					$_SESSION['registerError'] = "Ce login existe déjà";
				}
				else {
					$subscriber->updateData($post);
					$_SESSION['login'] = $post['login'];
					header('Location:' . HOST);
				}
			}
		}

		$displayForm = new View('updateData');
		$displayForm->render([]);
	}

	public function disconnection(){
		if (isset($_SESSION['login'])) {
			unset($_SESSION['login']);
			session_destroy();
			header('Location:' . HOST);
		}
	}

	public function deleteSubscriber(){
		$subscriber = new SubscriberManager();
		$subscriber->deleteSubscriber();
		$this->disconnection();
	}

	public function getMessagesDesLeviathans(){
		$messages = new MessageDesLeviathansManager();
		$messagesDesLeviathans = $messages->getMessagesDesLeviathans();
		$displayMessagesDesLeviathans = new View('messageDesLeviathans');
		$displayMessagesDesLeviathans->render([]);
	}

	public function forum(){
		$messages = new MessageDesLeviathansManager();
		$messagesDesLeviathans = $messages->getMessagesDesLeviathans();
		$displayForum = new View('forum');
		$displayForum->render([
			'messagesDesLeviathans' => $messagesDesLeviathans
		]);
	}
}
