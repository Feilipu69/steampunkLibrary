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

	public function addABook($book){
		if (isset($book['addABook'])) {
			if (!empty($book['isbn'])) {
				$newBook = new BooksCatalogueManager();
				$newBook->addABook($book);
			}
		}
		$this->administration();
	}

	public function getRole($id){
		$subscriber = new SubscriberManager();
		$role = $subscriber->getRole($id);
		echo json_encode($role);
	}

	public function moderator($id){
		$moderator = new SubscriberManager();
		$newModerator = $moderator->moderator($id);
	}

	public function member($id){
		$member = new SubscriberManager();
		$newMember = $member->member($id);
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
