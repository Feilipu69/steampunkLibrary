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
	* administration. Affiche un formulaire d'entrée d'un nouveau livre, la gestion du role des membres et la possibilité de supprimer un membre.
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

	/**
	* addABook ajoute un livre à la base de données
	*
	* @param  mixed $book
	* @return void
	*/
	public function addOneBook($book){
		if (isset($book['addOneBook'])) {
			if (!empty($book['isbn'])) {
				$newBook = new BooksCatalogueManager();
				$newBook->addOneBook($book);
			}
		}
		$this->administration();
	}

	/**
	* getRole récupère les rôles des membres
	*
	* @param  int $id
	* @return void
	*/
	public function getRole($id){
		$subscriber = new SubscriberManager();
		$role = $subscriber->getRole($id);
		echo json_encode($role);
	}

	/**
	* moderator permet à un membre de devenir modérateur
	*
	* @param  int $id
	* @return void
	*/
	public function moderator($id){
		$moderator = new SubscriberManager();
		$newModerator = $moderator->moderator($id);
	}

	/**
	* member retour d'un utilisateur au rôle de membre
	*
	* @param  int $id
	* @return void
	*/
	public function member($id){
		$member = new SubscriberManager();
		$newMember = $member->member($id);
	}

	/**
	* deleteMember supprime un membre
	*
	* @param  int $id
	* @return void
	*/
	public function deleteMember($id){
		$member = new SubscriberManager();
		$deleteMember = $member->deleteMember($id);
		header('Location:' . HOST . '/administration');
	}

	/**
	* deleteOpinion supprime un mauvais commentaire
	*
	* @param  mixed $parameter
	* @param  int $page
	* @param  int $id
	* @return void
	*/
	public function deleteOpinion($parameter, $page, $id){
		$opinion = new OpinionManager();
		$deleteOpinion = $opinion->deleteOpinion($id);
		header('Location:' . HOST . '/subjectAndComments/' . $parameter . '/' . $page);
	}
}
