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
	public function home(){
		$display = new View('home');
		$display->render([]);
	}

	// Books
	// Livres	

	public function getBooks(){
		$booksCatalogue = new BooksCatalogueManager();
		$catalogue = $booksCatalogue->catalogue();
		$allBooks = $booksCatalogue->countAllBooks();

		// Page numbering
		// Pagination
		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$currentPage = (int) strip_tags($_GET['page']);
		} else {
			$currentPage = 1;
		}
		$numberOfBooksByPage = 9;
		$allPages = ceil($allBooks/$numberOfBooksByPage);
		$firstPage = ($currentPage * $numberOfBooksByPage) - $numberOfBooksByPage;
		$books = $booksCatalogue->getBooks($firstPage, $numberOfBooksByPage);
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

	public function deleteSubscriber($subscriberId){
		$subscriber = new SubscriberManager();
		$postsOfASubscriber = new ForumPostsManager();
		$commentsOfASubscriber = new CommentsManager();
		$votesOfASubscriber = new AgreeDisagreeManager();
		$subscriber->deleteSubscriber($subscriberId);
		$postsOfASubscriber->deleteAllPostsOfASubscriber($subscriberId);
		$commentsOfASubscriber->deleteAllCommentsOfASubscriber($subscriberId);
		$votesOfASubscriber->deleteAllVotesOfASubscriber($subscriberId);
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
		$posts = new ForumPostsManager();
		$getPost = $posts->getPost($post);
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
	* Display a member's posts
	* Accès aux sujets d'un membre
	*
	* @return void
	*/
	public function myPosts(){
		$posts = new ForumPostsManager();
		$comments = new CommentsManager();
		$myPosts = $posts->myPosts();
		$myComments = $comments->getMyComments();
		$displayPosts = new View('myPosts', 'myComments');
		$displayPosts->render([
			'myPosts' => $myPosts,
			'myComments' => $myComments
		]);
	}

	public function updatePost($post, $id){
		if (isset($post['send'])) {
			if (!empty($post['title']) && !empty($post['content'])) {
				$posts = new ForumPostsManager();
				$commentsOfPost = new CommentsManager();
				$updatePost = $posts->updatePost($post, $id);
				$commentsOfPost->deleteCommentByPost($id);
				header('Location:' . HOST . '/myPosts');
			}
		}

		$displayFormular = new View('updatePostFormular');
		$displayFormular->render([]);
	}

	public function deletePost($id){
		$post = new ForumPostsManager();
		$comments = new CommentsManager();
		$deletePost = $post->deletePost($id);
		$deleteComments = $comments->deleteCommentByPost($id);
		header('Location:' . HOST . '/myPosts');
	}

	function addAComment($post, $forumId, $page){
		if (isset($post['send'])) {
			if (!empty($post['comment'])) {
				$comment = new CommentsManager();
				$newComment = $comment->addAComment($post, $forumId, $page);
				header('Location:' . HOST . '/postAndComments/' . $forumId . '/' . $page);
			}
		} else {
			header('Location:' . HOST . '/postAndComments/' . $forumId . '/' . $page);
		}
	}

	public function updateMyComment($post, $id){
		if (isset($post['send'])) {
			if (!empty($post['comment'])) {
				$myComment = new CommentsManager();
				$deleteVoteOfOldComment = new AgreeDisagreeManager();
				$updateMyComment = $myComment->updateMyComment($post, $id);
				$deleteVoteOfOldComment->deleteVoteOfAComment($id);
				header('Location:' . HOST . '/myPosts');
			}
		}

		$formular = new View('updateMyCommentFormular');
		$formular->render([]);
	}

	public function deleteMyComment($id){
		$myComment = new CommentsManager();
		$voteOfMyComment = new AgreeDisagreeManager();
		$myComment->deleteComment($id);
		$voteOfMyComment->deleteVoteOfAComment($id);
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
		$posts = new ForumPostsManager();
		$comment = new CommentsManager();
		$commentsAgreeDisagree = new AgreeDisagreeManager();

		// Page numbering-Pagination
		if (isset($_GET['page']) && !empty($_GET['page'])) {
			$currentPage = (int) strip_tags($_GET['page']);
		} else {
			$currentPage = 1;
		}

		$numberOfComments = $comment->countAllComments($forumId);
		$numberOfCommentsByPage = 5;
		$allPages = ceil($numberOfComments[0]/$numberOfCommentsByPage);
		$firstComment = ($currentPage * $numberOfCommentsByPage) - $numberOfCommentsByPage;
		$comments = $comment->getComments($forumId, $firstComment, $numberOfCommentsByPage);
		// End of page numbering
		// Fin pagination

		$commentsId = [];
		if (!empty($comments)) {
			foreach ($comments as $comment) {
				$commentsId[] = $comment->getId();
			}
		}

		$postData = $posts->getPostById($forumId);	
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
		$comment = new CommentsManager();
		$voteOfComment = new AgreeDisagreeManager();
		$comment->deleteComment($id);
		$voteOfComment->deleteVoteOfAComment($id);
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
		$agreeDisagree = new AgreeDisagreeManager();
		$comments = new CommentsManager();

		if ($vote === 'agree') {
			$numberComments = $agreeDisagree->countSubscriberVotes($commentId, $vote);
			if ($numberComments[0] === '0') {
				$addComment = $agreeDisagree->addVote($commentId, $vote);
				$removeComment = $agreeDisagree->removeVote($commentId, 'disagree');
			} else {
				$removeComment = $agreeDisagree->removeVote($commentId, $vote);
			}
		} elseif ($vote === 'disagree') {
			$numberComments = $agreeDisagree->countSubscriberVotes($commentId, $vote);
			if ($numberComments[0] === '0') {
				$addComment = $agreeDisagree->addVote($commentId, $vote);
				$removeComment = $agreeDisagree->removeVote($commentId, 'agree');
			} else {
				$removeComment = $agreeDisagree->removeVote($commentId, $vote);
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
		$votes = new AgreeDisagreeManager();
		$allVotes = $votes->getAllVotes($commentId);
		echo json_encode($allVotes);
	}

	// NewsLetter	

	public function newsletters(){
		$displayLetter = new View('newsletters');
		$displayLetter->render([]);
	}
}
