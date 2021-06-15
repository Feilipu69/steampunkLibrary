<?php
namespace Bihin\steampunkLibrary\src\controller;

use Bihin\steampunkLibrary\src\DAO\{
	AgreeDisagreeManager,
	BooksCatalogueManager,
	NewsletterManager,
	ForumPostsManager,
	OpinionManager,
	SubscriberManager
};

use Bihin\steampunkLibrary\utils\View;

class FrontController
{
	public function home(){
		$display = new View('home');
		$display->render([]);
	}

	// Books-Livres	

	public function getBooks(){
		$booksCatalogue = new BooksCatalogueManager();
		$catalogue = $booksCatalogue->catalogue();
		$allBooks = $booksCatalogue->countAllBooks();

		// Page numbering-Pagination
		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$currentPage = (int) strip_tags($_GET['page']);
		} else {
			$currentPage = 1;
		}
		$numberOfBooksByPage = 9;
		$allPages = ceil($allBooks/$numberOfBooksByPage);
		$firstPage = ($currentPage * $numberOfBooksByPage) - $numberOfBooksByPage;
		$books = $booksCatalogue->getBooks($firstPage, $numberOfBooksByPage);
		// End of page numbering-Fin pagination

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

	// Members-Membres	

	/**
	* A member can register-Register permet à un utilisateur de s'inscrire member
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
	* To change the member's data-Modifier les données de l'utilisateur
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

	// Forum	

	/**
	* Display the topics-Affiche le menu des thèmes du forum
	*
	* @return void
	*/
	public function forum(){
		$displayForum = new View('forum');
		$displayForum->render([]);
	}

	/**
	* Display the posts-Affiche les billets
	*
	* @param  mixed $post
	* @return void
	*/
	public function post($post){
		$posts = new ForumPostsManager();
		$getPost = $posts->getPost($post);
		$displayForumPost = new View('post');
		$displayForumPost->render([
			'getPost' => $getPost
		]);
	}

	/**
	* Add a post-Ajoute un billet
	*
	* @param  mixed $post
	* @param  mixed $parameter
	* @return void
	*/
	public function addForumPost($post, $parameter){
		if (isset($post['send'])) {
			if (!empty($post['title']) && !empty($post['content'])) {
				$newPost = new ForumPostsManager();
				$forumPost = $newPost->addForumPost($post);
				header('Location:' . HOST . '/post/' . $parameter);
			}
		} else {
			header('Location:' . HOST . '/post/' . $parameter);
		}
	}

	/**
	* Display a member's posts-Accès aux sujets d'un utilisateur
	*
	* @return void
	*/
	public function myPosts(){
		$posts = new ForumPostsManager();
		$myPosts = $posts->myPosts();
		$displayPosts = new View('myPosts');
		$displayPosts->render([
			'myPosts' => $myPosts
		]);
	}

	public function updatePost($post, $id){
		if (isset($post['send'])) {
			if (!empty($post['title']) && !empty($post['content'])) {
				$posts = new ForumPostsManager();
				$updatePost = $posts->updatePost($post, $id);
				header('Location:' . HOST . '/myPosts');
			}
		}

		$displayFormular = new View('updatePostFormular');
		$displayFormular->render([]);
	}

	public function deletePost($id){
		$post = new ForumPostsManager();
		$comments = new OpinionManager();
		$deletePost = $post->deletePost($id);
		$deleteComments = $comments->deleteOpinionByPost($id);
		header('Location:' . HOST . '/myPosts');
	}

	// Posts, comments and likes dislikes-Sujets, commentaires et votes	

	/**
	* Display a post and its comments(5 by 5). like dislike for each comment and page numbering-Affiche un billet et ses commentaires (par groupe de cinq). Fonctionnalité like-dislike associée à chaque commentaire, enfin pagination.
	*
	* @param  mixed $post
	* @param  int $forumId
	* @param  int $page
	* @return void
	*/
	public function postAndComments($post, $forumId, $page){
		$posts = new ForumPostsManager();
		$opinion = new OpinionManager();
		$opinionsAgreeDisagree = new AgreeDisagreeManager();

		if (isset($post['send'])) {
			if (!empty($post['login'] && !empty($post['comment']))) {
				$newOpinion = $opinion->addOpinion($post, $forumId);
			}
		}

		// Page numbering-Pagination
		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$currentPage = (int) strip_tags($_GET['page']);
		} else {
			$currentPage = 1;
		}

		$numberOfComments = $opinion->countAllOpinions($forumId);
		$numberOfCommentsByPage = 5;
		$allPages = ceil($numberOfComments[0]/$numberOfCommentsByPage);
		$firstComment = ($currentPage * $numberOfCommentsByPage) - $numberOfCommentsByPage;
		$opinions = $opinion->getOpinions($forumId, $firstComment, $numberOfCommentsByPage);
		// End of page numbering-Fin pagination

		$opinionsId = [];
		if (!empty($opinions)) {
			foreach ($opinions as $opinion) {
				$opinionsId[] = $opinion->getId();
			}
		}

		$postData = $posts->getPostById($forumId);	
		$displaySubjectAndComments = new View('postAndComments');
		$displaySubjectAndComments->render([
			'postData' => $postData,
			'opinions' => $opinions,
			'opinionsId' => json_encode($opinionsId),
			'currentPage' => $currentPage,
			'allPages' => $allPages
		]);
	}

	/**
	* deleteOpinion-Supprime un commentaire
	*
	* @param  mixed $parameter
	* @param  int $page
	* @param  int $id
	* @return void
	*/
	public function deleteOpinion($parameter, $page, $id){
		$opinion = new OpinionManager();
		$deleteOpinion = $opinion->deleteOpinion($id);
		header('Location:' . HOST . '/postAndComments/' . $parameter . '/' . $page);
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
				$addOpinion = $agreeDisagree->addVote($opinionId, $vote);
				$removeOpinion = $agreeDisagree->removeVote($opinionId, 'disagree');
			} else {
				$removeOpinion = $agreeDisagree->removeVote($opinionId, $vote);
			}
		} elseif ($vote === 'disagree') {
			$numberOpinions = $agreeDisagree->countSubscriberVotes($opinionId, $vote);
			if ($numberOpinions[0] === '0') {
				$addOpinion = $agreeDisagree->addVote($opinionId, $vote);
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

	// NewsLetter	

	public function newsletters(){
		$displayLetter = new View('newsletters');
		$displayLetter->render([]);
	}
}
