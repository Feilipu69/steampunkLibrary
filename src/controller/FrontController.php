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

	public function subjectAndComments($post, $parameter){
		$subject = new ForumSubjectsManager();
		$opinion = new OpinionManager();
		$opinionsAgreeDisagree = new AgreeDisagreeManager();

		if (isset($post['send'])) {
			if (!empty($post['login'] && !empty($post['comment']))) {
				$newOpinion = $opinion->addOpinion($post, $parameter);
			}
		}

		// Pagination
		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$currentPage = (int) strip_tags($_GET['page']);
		} else {
			$currentPage = 1;
		}

		$numberOfComments = $opinionsAgreeDisagree->countAllOpinions($parameter, 'opinions', 'idForum');
		$numberOfCommentsByPage = 5;
		$allPages = ceil($numberOfComments[0]/$numberOfCommentsByPage);
		$firstComment = ($currentPage * $numberOfCommentsByPage) - $numberOfCommentsByPage;
		$opinionsAgreeDisagree->getAllOpinions($parameter, 'opinions', $firstComment, $numberOfCommentsByPage);
		// Fin pagination

		$opinions = $opinion->getOpinions($parameter, $firstComment, $numberOfCommentsByPage);

		// likes/dislikes
		if (!empty($opinions)) {
			foreach ($opinions as $opinion) {
				$agree = $opinion->setAgree($opinionsAgreeDisagree->countAllOpinions($opinion->getId(), 'agreeOpinions', 'opinionId'));
				$disagree = $opinion->setDisagree($opinionsAgreeDisagree->countAllOpinions($opinion->getId(), 'disagreeOpinions', 'opinionId'));
			}
		}

		$subjectData = $subject->getSubjectById($parameter);	
		$displaySubjectAndComments = new View('subjectAndComments');
		$displaySubjectAndComments->render([
			'subjectData' => $subjectData,
			'opinions' => $opinions,
			'currentPage' => $currentPage,
			'allPages' => $allPages
		]);
	}

	public function updateSubject($post, $parameter){
		if (isset($post['send'])) {
			if (!empty($post['title']) && !empty($post['content'])) {
				$subject = new ForumSubjectsManager();
				$updateSubject = $subject->updateSubject($post, $parameter);
				header('Location:' . HOST . '/mySubjects');
			}
		}

		$displayFormular = new View('updateSubjectFormular');
		$displayFormular->render([]);
	}

	public function deleteSubject($parameter){
		$subject = new ForumSubjectsManager();
		$deleteSubject = $subject->deleteSubject($parameter);
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

	public function forumThemes($parameter){
		$subject = new ForumSubjectsManager();
		$getSubject = $subject->getSubject($parameter);
		$displayForumTheme = new View('forumThemes');
		$displayForumTheme->render([
			'getSubject' => $getSubject
		]);
	}

	public function addForumTheme($post, $parameter){
		if (isset($post['send'])) {
			if (!empty($post['title']) && !empty($post['content'])) {
				$newTheme = new ForumSubjectsManager();
				$forumTheme = $newTheme->addForumTheme($post, $parameter);
				header('Location:' . HOST . '/forum');
			}
		}

		$displayFormular = new View('forumFormular');
		$displayFormular->render([]);
	}

	public function addRemoveOpinions($opinionId, $table, $subscriberIdOpinion, $opinion, $otherTable, $otherSubscriberIdOpinion, $otherOpinion ){
		$flagOpinion= new AgreeDisagreeManager();
		$opinions = new OpinionManager();

		$opinionsAgree = $flagOpinion->countOpinion($opinionId, $table, $subscriberIdOpinion);
		if ($opinionsAgree[0] === '0') {
			$opinions->addLikeDislike($opinionId, $opinion);
			$flagAgree = $flagOpinion->addOpinion($opinionId, $table, $subscriberIdOpinion, $opinion);
			$opinions->removeOpinion($opinionId, $otherOpinion);
			$flagDisagree = $flagOpinion->removeOpinion($opinionId, $otherTable, $otherSubscriberIdOpinion);
		}
		else {
			$opinions->removeOpinion($opinionId, $opinion);
			$flagAgree = $flagOpinion->removeOpinion($opinionId, $table, $subscriberIdOpinion);
		}

		$getOpinion = $opinions->getAOpinion($opinionId);
		$subject = $getOpinion->getIdForum();

		header('Location:' . HOST . '/subjectAndComments/' . $subject);
	}
}
