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
	// Livres	

	public function getBooks(){
		$booksCatalogue = new BooksCatalogueManager();
		$catalogue = $booksCatalogue->catalogue();
		$allBooks = $booksCatalogue->countAllBooks();

		// Pagination
		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$currentPage = (int) strip_tags($_GET['page']);
		} else {
			$currentPage = 1;
		}
		$numberOfBooksByPage = 9;
		$allPages = ceil($allBooks/$numberOfBooksByPage);
		$firstPage = ($currentPage * $numberOfBooksByPage) - $numberOfBooksByPage;
		// Avoir les 9 livres
		$books = $booksCatalogue->getBooks($firstPage, $numberOfBooksByPage);
		// Fin pagination

		$displayBooks = new View('books');
		$displayBooks->render([
			'catalogue' => $catalogue,
			'currentPage' => $currentPage,
			'allPages' => $allPages,
			'books' => $books
		]);
	}

	public function getOneBook($isbn){ 
		$displayABook = new View('book');
		$displayABook->render([]);
	}

	// Membres	
	/**
	* register permet à un utilisateur de s'inscrire
	*
	* @param  mixed $post
	* @return void
	*/
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
					$subscriberData = $subscriber->getOneSubscriber();
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
					$subscriberData = $subscriber->getOneSubscriber();
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

	public function disconnection(){
		if (isset($_SESSION['login'])) {
			unset($_SESSION['login']);
			session_destroy();
			header('Location:' . HOST);
		}
	}

	/**
	* updateData. Modifie les données de l'utilisateur
	*
	* @param  mixed $post
	* @return void
	*/
	public function updateData($post){
		if (isset($_SESSION['registerError'])) {
			unset($_SESSION['registerError']);
		}

		if (isset($post['send'])) {
			if (!empty($post['login']) && !empty($post['password']) && !empty($post['email'])) {
				$subscriber = new SubscriberManager();
				if ($subscriber->checkSubscriber($post)) {
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

	public function deleteSubscriber(){
		$subscriber = new SubscriberManager();
		$subscriber->deleteSubscriber();
		$this->disconnection();
	}

	// Sujets, commentaires et votes	

	/**
	* mySubjects. Accès aux sujets créés par l'utilisateur connecté
	*
	* @return void
	*/
	public function mySubjects(){
		$subjects = new ForumSubjectsManager();
		$mySubjects = $subjects->mySubjects();
		$displaySubjects = new View('mySubjects');
		$displaySubjects->render([
			'mySubjects' => $mySubjects
		]);
	}

	/**
	* subjectAndComments. Récupère et affiche un billet avec tous ses commentaires (par groupe de cinq). Fonctionnalité like-dislike associée à chaque commentaire, enfin pagination.
	*
	* @param  mixed $post
	* @param  int $forumId
	* @return void
	*/
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
		// Avoir les données des 5 commentaires de la page souhaitée
		$opinions = $opinion->getOpinions($forumId, $firstComment, $numberOfCommentsByPage);
		// Fin pagination

		$opinionsId = [];
		if (!empty($opinions)) {
			foreach ($opinions as $opinion) {
				$opinionsId[] = $opinion->getId();
			}
		}

		$subjectData = $subject->getSubjectById($forumId);	
		$displaySubjectAndComments = new View('subjectAndComments');
		$displaySubjectAndComments->render([
			'subjectData' => $subjectData,
			'opinions' => $opinions,
			'opinionsId' => json_encode($opinionsId),
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

	// NewsLetter	

	public function newsletters(){
		$displayLetter = new View('newsletters');
		$displayLetter->render([]);
	}

	// Forum	
	/**
	* forum affiche le menu des thèmes du forum
	*
	* @return void
	*/
	public function forum(){
		$displayForum = new View('forum');
		$displayForum->render([]);
	}

	/**
	* forumThemes. Accès au thème choisi par l'utilisateur
	*
	* @param  mixed $theme
	* @return void
	*/
	public function forumThemes($theme){
		$subject = new ForumSubjectsManager();
		$getSubject = $subject->getSubject($theme);
		$displayForumTheme = new View('forumThemes');
		$displayForumTheme->render([
			'getSubject' => $getSubject
		]);
	}

	/**
	* addForumTheme ajoute un billet au thème choisi.
	*
	* @param  mixed $post
	* @return void
	*/
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

	// like-dislike	
	/**
	* addRemoveVote. Fonctionnalité like-dislike pour chaque billet d'un sujet.
	*
	* @param  int $opinionId
	* @param  mixed $vote
	* @return void
	*/
	public function addRemoveVote($opinionId, $vote){
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
	}

	/**
	* getAllVotes. Récupération de tous les like-dislike d'un billet.
	*
	* @param  int $opinionId
	* @return void
	*/
	public function getAllVotes($opinionId){
		$votes = new AgreeDisagreeManager();
		$allVotes = $votes->getAllVotes($opinionId);
		echo json_encode($allVotes);
	}
}
