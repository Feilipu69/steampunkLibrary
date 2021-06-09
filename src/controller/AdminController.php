<?php
namespace Bihin\steampunkLibrary\src\controller;

use Bihin\steampunkLibrary\src\DAO\{
	BooksCatalogueManager,
	NewsletterManager,
	OpinionManager,
	SubscriberManager
};

use Bihin\steampunkLibrary\utils\View;

class AdminController
{	
	public function checkRole(){
		if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'moderator') {
			header('Location:' . HOST);
		} else {
			return true;
		}
	}

	/**
	* Display a formular for a new book, the possibility to change the status of a member and to delete the count of a member-Affiche un formulaire d'entrée d'un nouveau livre, la gestion du role des membres et la possibilité de supprimer un membre.
	*
	* @return void
	*/
	public function administration(){
		if ($this->checkRole()) {
			$subscribers = new SubscriberManager();
			$allSubscribers = $subscribers->getSubscribers();

			$subscriberId = [];
			foreach ($allSubscribers as $subscriber) {
				$subscribersId[] = $subscriber->getId();
			}

			$displayData = new View('administration');
			$displayData->render([
				'allSubscribers' => $allSubscribers,
				'subscribersId' => json_encode($subscribersId)
			]);
		}
	}

	public function addOneBook($book){
		if (isset($book['addOneBook'])) {
			if (!empty($book['isbn'])) {
				$newBook = new BooksCatalogueManager();
				$newBook->addOneBook($book);
			}
		}
		$this->administration();
	}

	public function getRole($id){
		$subscriber = new SubscriberManager();
		$role = $subscriber->getRole($id);
		echo json_encode($role);
	}

	/**
	* Change the status to moderator-Moderator permet à un membre de devenir modérateur
	*
	* @param  int $id
	* @return void
	*/
	public function moderator($id){
		$moderator = new SubscriberManager();
		$newModerator = $moderator->moderator($id);
	}

	/**
	* Change the status to member-Le statut du membre devient member
	*
	* @param  int $id
	* @return void
	*/
	public function member($id){
		$member = new SubscriberManager();
		$newMember = $member->member($id);
	}

	public function deleteMember($id){
		$member = new SubscriberManager();
		$deleteMember = $member->deleteMember($id);
		header('Location:' . HOST . '/administration');
	}
}
