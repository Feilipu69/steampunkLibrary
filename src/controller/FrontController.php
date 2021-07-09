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

class FrontController
{
	private $agreeDisagreeManager;
	private $booksCatalogueManager;
	private $commentsManager;
	private $forumPostsManager;
	private $subscriberManager;

	public function __construct(){
		$this->agreeDisagreeManager = new AgreeDisagreeManager();
		$this->booksCatalogueManager = new BooksCatalogueManager();
		$this->commentsManager = new Commentsmanager();
		$this->forumPostsManager = new ForumPostsmanager();
		$this->subscriberManager = new SubscriberManager();
	}

	public function home(){
		$display = new View('home');
		$display->render([]);
	}

	// Books
	// Livres	

	public function getBooks(){
		$catalogue = $this->booksCatalogueManager->catalogue();
		$allBooks = $this->booksCatalogueManager->countAllBooks();
		$numberOfBooksByPage = 9;
		$allPages = ceil($allBooks/$numberOfBooksByPage);

		// Page numbering
		// Pagination
		if (isset($_GET['page']) && (int)$_GET['page'] && !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $allPages) {
			$currentPage = (int) strip_tags($_GET['page']);
		} else {
			$currentPage = 1;
		}
		$firstPage = ($currentPage * $numberOfBooksByPage) - $numberOfBooksByPage;
		$books = $this->booksCatalogueManager->getBooks($firstPage, $numberOfBooksByPage);
		// End of page numbering
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

	// Members
	// Membres	

	/**
	* A user can register
	* Un utilisateur peut s'inscrire
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
				$secureData = [
					'login' => strip_tags($post['login']), 
					'password' => strip_tags($post['password']), 
					'email' => strip_tags($post['email'])
				];

				if ($this->subscriberManager->checkSubscriber($secureData)) {
					$_SESSION['registerError'] = "Ce login existe déjà";
				}
				else {
					$this->subscriberManager->register($secureData);
					$_SESSION['login'] = $secureData['login'];
					$subscriberData = $this->subscriberManager->getOneSubscriber();
					$_SESSION['subscriberId'] = strip_tags($subscriberData->getId());
					$_SESSION['role'] = null;
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
				$secureData = [
					'login' => strip_tags($post['login']),
					'password' => strip_tags($post['password'])
				];

				if ($this->subscriberManager->checkPassword($post)) {
					$_SESSION['login'] = $secureData['login'];
					$subscriberData = $this->subscriberManager->getOneSubscriber();
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
	* To change the member's data
	* Modifier les données de l'utilisateur
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
				$secureData = [
					'login' => strip_tags($post['login']), 
					'password' => strip_tags($post['password']), 
					'email' => strip_tags($post['email'])
				];

				if ($this->subscriberManager->checkSubscriber($post)) {
					$_SESSION['registerError'] = "Ce login existe déjà";
				}
				else {
					$this->subscriberManager->updateData($post);
					$_SESSION['login'] = $secureData['login'];
					header('Location:' . HOST);
				}
			}
		}

		$displayForm = new View('updateData');
		$displayForm->render([]);
	}

	public function deleteSubscriber($subscriberId){
		$secureSubscriberId = strip_tags($subscriberId);
		$this->subscriberManager->deleteSubscriber($secureSubscriberId);
		$this->disconnection();
	}

	// Forum	

	/**
	* Display the topics
	* Affiche le menu des thèmes du forum
	*
	* @return void
	*/
	public function forum(){
		$displayForum = new View('forum');
		$displayForum->render([]);
	}

	/**
	* Display a post
	* Affiche un sujet
	*
	* @param  mixed $post
	* @return void
	*/
	public function post($post){
		$securePost = strip_tags($post);
		$getPost = $this->forumPostsManager->getPost($securePost);
		$displayForumPost = new View('post');
		$displayForumPost->render([
			'getPost' => $getPost
		]);
	}

	/**
	* Add a post
	* Ajoute un sujet
	*
	* @param  mixed $post
	* @param  mixed $parameter
	* @return void
	*/
	public function addForumPost($post, $parameter){
		$secureParameter = strip_tags($parameter);
		if (isset($post['send'])) {
			if (!empty($post['title']) && !empty($post['content'])) {
				$secureData = [
					'title' => strip_tags($post['title']),
					'content' => strip_tags($post['content'])
				];

				$forumPost = $this->forumPostsManager->addForumPost($secureData);
				header('Location:' . HOST . '/post/' . $secureParameter);
			}
		} else {
			header('Location:' . HOST . '/post/' . $secureParameter);
		}
	}

	/**
	* Display a member's posts
	* Accès aux sujets d'un membre
	*
	* @return void
	*/
	public function myPosts(){
		$myPosts = $this->forumPostsManager->myPosts();
		$myComments = $this->commentsManager->getMyComments();
		$displayPosts = new View('myPosts', 'myComments');
		$displayPosts->render([
			'myPosts' => $myPosts,
			'myComments' => $myComments
		]);
	}

	public function updatePost($post, $id){
		$secureId = strip_tags($id);
		$mypost = $this->forumPostsManager->getPostById($secureId);
		if (isset($post['send'])) {
			if (!empty($post['title']) && !empty($post['content'])) {
				$secureData = [
					'title' => strip_tags($post['title']),
					'content' => strip_tags($post['content'])
				];

				$updatePost = $this->forumPostsManager->updatePost($secureData, $secureId);
				$this->commentsManager->deleteCommentByPost($secureId);
				header('Location:' . HOST . '/myPosts');
			}
		}

		$displayFormular = new View('updatePostFormular');
		$displayFormular->render([
			'mypost' => $mypost
		]);
	}

	public function deletePost($id){
		$secureId = strip_tags($id);
		$deletePost = $this->forumPostsManager->deletePost($secureId);
		header('Location:' . HOST . '/myPosts');
	}

	function addAComment($post, $forumId, $page){
		if (isset($post['send'])) {
			if (!empty($post['comment'])) {
				$newComment = $this->commentsManager->addAComment($post, $forumId, $page);
				header('Location:' . HOST . '/postAndComments/' . $forumId . '/' . $page);
			}
		} else {
			header('Location:' . HOST . '/postAndComments/' . $forumId . '/' . $page);
		}
	}

	public function updateMyComment($post, $id){
		if (isset($post['send'])) {
			if (!empty($post['comment'])) {
				$updateMyComment = $this->commentsManager->updateMyComment($post, $id);
				$this->agreeDisagreeManager->deleteVoteOfAComment($id);
				header('Location:' . HOST . '/myPosts');
			}
		}

		$formular = new View('updateMyCommentFormular');
		$formular->render([]);
	}

	public function deleteMyComment($id){
		$secureId = strip_tags($id);
		$this->commentsManager->deleteComment($secureId);
		header('Location:' . HOST . '/myPosts');
	}

	// Posts, comments and likes dislikes
	// Sujets, commentaires et votes	

	/**
	* Display a post and its comments(5 by 5). like dislike for each comment and page numbering
	* Affiche un sujet et ses commentaires (par groupe de cinq). Fonctionnalité like-dislike associée à chaque commentaire, enfin pagination.
	*
	* @param  mixed $post
	* @param  int $forumId
	* @param  int $page
	* @return void
	*/
	public function postAndComments($post, $forumId, $page){
		if (isset($_GET['parameter']) && (int)$_GET['parameter'] && !empty($_GET['parameter'])) {
			$forumId = (int) strip_tags($_GET['parameter']);
		} else {
			$forumId = 1;
		}
		$commentsAgreeDisagree = new AgreeDisagreeManager();
		$numberOfComments = $this->commentsManager->countAllComments($forumId);
		$numberOfCommentsByPage = 5;
		$allPages = ceil($numberOfComments[0]/$numberOfCommentsByPage);

		// Page numbering
		//Pagination
		if (isset($_GET['page']) && (int)$_GET['page'] && !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $allPages) {
			$currentPage = (int) strip_tags($_GET['page']);
		} else {
			$currentPage = 1;
		}

		$firstComment = ($currentPage * $numberOfCommentsByPage) - $numberOfCommentsByPage;
		$comments = $this->commentsManager->getComments($forumId, $firstComment, $numberOfCommentsByPage);
		// End of page numbering
		// Fin pagination

		$commentsId = [];
		if (!empty($comments)) {
			foreach ($comments as $comment) {
				$commentsId[] = $comment->getId();
			}
		}

		$postData = $this->forumPostsManager->getPostById($forumId);	
		$displaySubjectAndComments = new View('postAndComments');
		$displaySubjectAndComments->render([
			'postData' => $postData,
			'comments' => $comments,
			'commentsId' => json_encode($commentsId),
			'currentPage' => $currentPage,
			'allPages' => $allPages
		]);
	}

	/**
	* delete a comment
	* Supprime un commentaire
	*
	* @param  mixed $parameter
	* @param  int $page
	* @param  int $id
	* @return void
	*/
	public function deleteComment($parameter, $page, $id){
		$this->commentsManager->deleteComment($id);
		header('Location:' . HOST . '/postAndComments/' . $parameter . '/' . $page);
	}

	// like-dislike	

	/**
	* addRemoveVote. 
	* Fonctionnalité like-dislike pour chaque billet d'un sujet.
	*
	* @param  int $commentId
	* @param  mixed $vote
	* @return void
	*/
	public function addRemoveVote($commentId, $vote){
		if ($vote === 'agree') {
			$numberComments = $this->agreeDisagreeManager->countSubscriberVotes($commentId, $vote);
			if ($numberComments[0] === '0') {
				$addComment = $this->agreeDisagreeManager->addVote($commentId, $vote);
				$removeComment = $this->agreeDisagreeManager->removeVote($commentId, 'disagree');
			} else {
				$removeComment = $this->agreeDisagreeManager->removeVote($commentId, $vote);
			}
		} elseif ($vote === 'disagree') {
			$numberComments = $this->agreeDisagreeManager->countSubscriberVotes($commentId, $vote);
			if ($numberComments[0] === '0') {
				$addComment = $this->agreeDisagreeManager->addVote($commentId, $vote);
				$removeComment = $this->agreeDisagreeManager->removeVote($commentId, 'agree');
			} else {
				$removeComment = $this->agreeDisagreeManager->removeVote($commentId, $vote);
			}
		}
	}

	/**
	* getAllVotes. 
	* Récupération de tous les like-dislike d'un billet.
	*
	* @param  int $commentId
	* @return void
	*/
	public function getAllVotes($commentId){
		$allVotes = $this->agreeDisagreeManager->getAllVotes($commentId);
		echo json_encode($allVotes);
	}

	// NewsLetter	

	public function newsletters(){
		$displayLetter = new View('newsletters');
		$displayLetter->render([]);
	}
}
