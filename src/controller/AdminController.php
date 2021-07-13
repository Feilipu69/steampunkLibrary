<?php
namespace Bihin\steampunkLibrary\src\controller;

use Bihin\steampunkLibrary\src\DAO\{
	AgreeDisagreeManager,
	BooksCatalogueManager,
	ForumPostsManager,
	CommentsManager,
	SubscriberManager
};

use Bihin\steampunkLibrary\utils\View;

class AdminController
{	
	private $agreeDisagreeManager;
	private $booksCatalogueManager;
	private $forumPostsManager;
	private $commentsManager;
	private $subscriberManager;

	public function __construct(){
		$this->agreeDisagreeManager = new AgreeDisagreeManager();
		$this->booksCatalogueManager = new BooksCatalogueManager();
		$this->forumPostsManager = new ForumPostsManager();
		$this->commentsManager = new CommentsManager();
		$this->subscriberManager = new SubscriberManager();
	}

	public function checkRole(){
		if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'moderator') {
			header('Location:' . HOST);
		} else {
			return true;
		}
	}

	/**
	* Display a formular for a new book, the possibility to change the status of a member and to delete the count of a member
	* Affiche un formulaire d'entrée d'un nouveau livre, la gestion du role des membres et la possibilité de supprimer un membre.
	*
	* @return void
	*/
	public function administration(){
		if ($this->checkRole()) {
			$allSubscribers = $this->subscriberManager->getSubscribers();

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
			if (!empty($book['isbn']) && !empty($book['title'])) {
				$newBook = [
					'isbn' => $book['isbn'],
					'title' => strip_tags($book['title'])
				];
				if (preg_match("#^(?=(?:\D*\d){10}(?:(?:\D*\d){3})?$)[\d-]+$#", $newBook['isbn'])) {
					$this->booksCatalogueManager->addOneBook($newBook);
				}  else {
					$_SESSION['errorIsbn'] = "Données incorrectes";
				}
			} 
		}
		$this->administration();
	}

	public function getRole($id){
		$role = $this->subscriberManager->getRole($id);
		echo json_encode($role);
	}

	/**
	* Change the status to moderator
	* Change le statut en moderator
	*
	* @param  int $id
	* @return void
	*/
	public function moderator($id){
		$newModerator = $this->subscriberManager->moderator($id);
	}

	/**
	* Change the status to member
	* Change le statut en member
	*
	* @param  int $id
	* @return void
	*/
	public function member($id){
		$newMember = $this->subscriberManager->member($id);
	}

	public function deleteMember($id){
		$this->subscriberManager->deleteMember($id);
		header('Location:' . HOST . '/administration');
	}
}
