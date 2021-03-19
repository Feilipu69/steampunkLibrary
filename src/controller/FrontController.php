<?php
namespace Bihin\steampunkLibrary\src\controller;

use Bihin\steampunkLibrary\src\DAO\{
	AgreeDisagreeManager,
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

	public function updateData($post){
		if (isset($_SESSION['registerError'])) {
			unset($_SESSION['registerError']);
		}

		if (isset($post['send'])) {
			if (!empty($post['login']) && !empty($post['password']) && !empty($post['email'])) {
				$subscriber = new SubscriberManager();
				$subscriberData = $subscriber->getASubscriber();
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

	public function subjectAndComments($post, $forumId){
		$subject = new ForumSubjectsManager();
		$opinion = new OpinionManager();
		$opinionsAgreeDisagree = new AgreeDisagreeManager();
		if (isset($post['send'])) {
			if (!empty($post['login'] && !empty($post['comment']))) {
				$newOpinion = $opinion->addOpinion($post, $forumId);
			}
		}

		// Pagination
		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$currentPage = (int) strip_tags($_GET['page']);
		} else {
			$currentPage = 1;
		}

		$numberOfComments = $opinion->countAllOpinions($forumId);
		$numberOfCommentsByPage = 5;
		$allPages = ceil($numberOfComments[0]/$numberOfCommentsByPage);
		$firstComment = ($currentPage * $numberOfCommentsByPage) - $numberOfCommentsByPage;
		$opinion->getOpinions($forumId, $firstComment, $numberOfCommentsByPage);
		// Fin pagination

		$opinions = $opinion->getOpinions($forumId, $firstComment, $numberOfCommentsByPage);

		if (!empty($opinions)) {
			foreach ($opinions as $opinion) {
				$agree = $opinion->setAgree($opinionsAgreeDisagree->countAllVotes($opinion->getId(), 'agree'));
				$disagree = $opinion->setDisagree($opinionsAgreeDisagree->countAllVotes($opinion->getId(), 'disagree'));
			}
		}

		$subjectData = $subject->getSubjectById($forumId);	
		$displaySubjectAndComments = new View('subjectAndComments');
		$displaySubjectAndComments->render([
			'subjectData' => $subjectData,
			'opinions' => $opinions,
			'currentPage' => $currentPage,
			'allPages' => $allPages
		]);
	}

	public function updateSubject($post, $id){
		if (isset($post['send'])) {
			if (!empty($post['title']) && !empty($post['content'])) {
				$subject = new ForumSubjectsManager();
				$updateSubject = $subject->updateSubject($post, $id);
				header('Location:' . HOST . '/mySubjects');
			}
		}

		$displayFormular = new View('updateSubjectFormular');
		$displayFormular->render([]);
	}

	public function deleteSubject($id){
		$subject = new ForumSubjectsManager();
		$deleteSubject = $subject->deleteSubject($id);
		header('Location:' . HOST . '/forum');
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

	public function forumThemes($theme){
		$subject = new ForumSubjectsManager();
		$getSubject = $subject->getSubject($theme);
		$displayForumTheme = new View('forumThemes');
		$displayForumTheme->render([
			'getSubject' => $getSubject
		]);
	}

	public function addForumTheme($post){
		if (isset($post['send'])) {
			if (!empty($post['title']) && !empty($post['content'])) {
				$newTheme = new ForumSubjectsManager();
				$forumTheme = $newTheme->addForumTheme($post);
				header('Location:' . HOST . '/forum');
			}
		}

		$displayFormular = new View('forumFormular');
		$displayFormular->render([]);
	}

	public function addRemoveVote($opinionId, $page, $vote){
		$agreeDisagree = new AgreeDisagreeManager();
		$opinions = new OpinionManager();

		if ($vote === 'agree') {
			$numberOpinions = $agreeDisagree->countSubscriberVotes($opinionId, $vote);
			if ($numberOpinions[0] === '0') {
				$addOpinion = $agreeDisagree->likeDislikeOpinion($opinionId, $vote);
				$removeOpinion = $agreeDisagree->removeVote($opinionId, 'disagree');
			} else {
				$removeOpinion = $agreeDisagree->removeVote($opinionId, $vote);
			}
		} elseif ($vote === 'disagree') {
			$numberOpinions = $agreeDisagree->countSubscriberVotes($opinionId, $vote);
			if ($numberOpinions[0] === '0') {
				$addOpinion = $agreeDisagree->likeDislikeOpinion($opinionId, $vote);
				$removeOpinion = $agreeDisagree->removeVote($opinionId, 'agree');
			} else {
				$removeOpinion = $agreeDisagree->removeVote($opinionId, $vote);
			}
		}
		
		$getOpinion = $opinions->getAnOpinion($opinionId);
		$subject = $getOpinion->getForumId();
		header('Location:' . HOST . '/subjectAndComments/' . $subject . '/' . $page);
	}
}
