<?php
namespace Bihin\steampunkLibrary\src\controller;

use Bihin\steampunkLibrary\src\DAO\{
	BooksCatalogueManager,
	MessageDesLeviathansManager,
	SubscriberManager
};

use Bihin\steampunkLibrary\utils\View;

class AdminController
{
	public function administration(){
		$allSubscribers = $this->getSubscribers();

		$displayData = new View('administration');
		$displayData->render([
			'allSubscribers' => $allSubscribers
		]);
	}

	public function addABook($book){
		if (isset($book['addABook'])) {
			if (!empty($book['isbn'])) {
				$newBook = new BooksCatalogueManager();
				$newBook->addABook($book);
			}
		}

		$displayForm = new View('newBook');
		$displayForm->render([]);
	}

	public function getSubscribers(){
		$subscriber = new SubscriberManager();
		$subscribers = $subscriber->getSubscribers();
		return $subscribers;
	}

	public function moderator($id){
		$moderator = new SubscriberManager();
		$newModerator = $moderator->moderator($id);
		header('Location:' . HOST . '/administration');
	}

	public function member($id){
		$membre = new SubscriberManager();
		$newMembre = $membre->member($id);
		header('Location:' . HOST . '/administration');
	}

	public function deleteMember($id){
		$member = new SubscriberManager();
		$deleteMember = $member->deleteMember($id);
		header('Location:' . HOST . '/administration');
	}

	public function addMessageDesLeviathans($post){
		if (isset($post['send'])) {
			$message = new MessageDesLeviathansManager();
			$addMessage = $message->addMessageDesLeviathans($post);
		}
		header('Location:' . HOST . '/administration');
	}
}
