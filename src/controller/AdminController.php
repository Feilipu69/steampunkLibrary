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
	public function administration(){
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
		$this->administration();
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

	public function deleteOpinion($parameter, $page, $id){
		$opinion = new OpinionManager();
		$deleteOpinion = $opinion->deleteOpinion($id);
		header('Location:' . HOST . '/subjectAndComments/' . $parameter . '/' . $page);
	}
}
