<?php
namespace Bihin\steampunkLibrary\src\controller;

use Bihin\steampunkLibrary\src\DAO\{
	BooksCatalogueManager,
	SubscriberManager
};

use Bihin\steampunkLibrary\utils\View;

class AdminController
{
	public function administration(){
		// récupérer tout ce doit être afficher
		$subscribers = new SubscriberManager();
		$allSubscribers = $subscribers->getSubscribers();

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
}
