<?php
namespace Bihin\steampunkLibrary\src\controller;

use Bihin\steampunkLibrary\src\DAO\{
	BooksCatalogueManager,
	NewsletterManager,
	ForumSubjectsManager,
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
		$displayABook = new View('book');
		$displayABook->render([]);
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

	public function account(){
		$displayAccount = new View('account');
		$displayAccount->render([]);
	}

	public function updateData($post){
		if (isset($_SESSION['registerError'])) {
			unset($_SESSION['registerError']);
		}

		if (isset($post['account'])) {
			if (!empty($post['login']) && !empty($post['password']) && !empty($post['email'])) {
				$subscriber = new SubscriberManager();
				$subscriberData = $subscriber->getASubscriber($post);
				if ($subscriberData->getLogin() != $_SESSION['login'] && $subscriber->checkSubscriber($post)) {
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

	public function mySubjects(){
		$subjects = new ForumSubjectsManager();
		$mySubjects = $subjects->mySubjects();
		$displaySubjects = new View('mySubjects');
		$displaySubjects->render([
			'mySubjects' => $mySubjects
		]);
	}

	public function subjectAndComments($parameter){
		$subject = new ForumSubjectsManager();
		$opinions = $subject->getOpinions($parameter);
		$subjectData = $subject->getSubjectById($parameter);	
		$displaySubjectAndComments = new View('subjectAndComments');
		$displaySubjectAndComments->render([
			'subjectData' => $subjectData,
			'opinions' => $opinions
		]);
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

	public function newsletters(){
		$displayLetter = new View('newsletters');
		$displayLetter->render([]);
	}

	public function forum(){
		$displayForum = new View('forum');
		$displayForum->render([]);
	}

	public function forumThemes($parameter){
		$subject = new ForumSubjectsManager();
		$getSubject = $subject->getSubject($parameter);
		$displayForumTheme = new View('forumThemes');
		$displayForumTheme->render([
			'getSubject' => $getSubject
		]);
	}

	public function forumFormular(){
		$displayFormular = new View('forumFormular');
		$displayFormular->render([]);
	}
	public function addForumTheme($post){
		if (isset($post['send'])) {
			if (!empty($post['subject']) && !empty($post['title']) && !empty($post['content'])) {
				$newTheme = new ForumSubjectsManager();
				$forumTheme = $newTheme->addForumTheme($post);
				header('Location:' . HOST . '/forum');
			}
		}
	}

	public function addOpinion($post, $parameter){
		if (isset($post['send'])) {
			if (!empty($post['login'] && !empty($post['comment']))) {
				$newOpinion = new ForumSubjectsManager();
				$opinion = $newOpinion->addOpinion($post, $parameter);
				header('Location:' . HOST . '/subjectAndComments/' . $parameter);
			}
		}
	}
}
