<?php
namespace Bihin\steampunkLibrary\classes;

use Bihin\steampunkLibrary\src\controller\{
	FrontController,
	AdminController
};

use Bihin\steampunkLibrary\utils\View;

class Router
{
	private $frontController;

	public function __construct(){
		$this->frontController = new FrontController();
		$this->adminController = new AdminController();
	}

	public function renderController(){
		if (isset($_GET['route'])) {
			if ($_GET['route'] === HOST) {
				$this->frontController->home();
			} else {
				$this->renderBooks();
				$this->renderMember();
				$this->renderForum();
				$this->renderPostAndComments();
				$this->renderAgreeDisagree();
				$this->renderAdministration();
				$this->renderNewsLetter();
			}
		} else {
			$this->frontController->home();
		}
	}

	public function renderBooks(){
		if ($_GET['route'] === 'books') {
			$this->frontController->getBooks();
		}
		elseif ($_GET['route'] === 'book') {
			$this->frontController->getOneBook($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'addOneBook') {
			$this->adminController->addOneBook($_POST);
		}
	}

	public function renderMember(){
		if ($_GET['route'] === 'register') {
			$this->frontController->register($_POST);
		}
		elseif ($_GET['route'] === 'connection') {
			$this->frontController->connection($_POST);
		}
		elseif ($_GET['route'] === 'disconnection') {
			$this->frontController->disconnection();
		}
		elseif ($_GET['route'] === 'updateData') {
			$this->frontController->updateData($_POST);
		}
		elseif ($_GET['route'] === 'deleteSubscriber') {
			$this->frontController->deleteSubscriber($_GET['parameter']);
		}
	}

	public function renderForum(){
		if ($_GET['route'] === 'forum') {
			$this->frontController->forum();
		}
		elseif ($_GET['route'] === 'post') {
			$this->frontController->post($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'addForumPost') {
			$this->frontController->addForumPost($_POST, $_GET['parameter']);
		}
		elseif ($_GET['route'] === 'myPosts') {
			$this->frontController->myPosts();
		}
		elseif ($_GET['route'] === 'updatePost') {
			$this->frontController->updatePost($_POST, $_GET['parameter']);
		}
		elseif ($_GET['route'] === 'deletePost') {
			$this->frontController->deletePost($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'addAComment') {
			$this->frontController->addAComment($_POST, $_GET['parameter'], $_GET['page']);
		}
		elseif ($_GET['route'] === 'updateMyComment') {
			$this->frontController->updateMyComment($_POST, $_GET['parameter']);
		}
		elseif ($_GET['route'] === 'deleteMyComment') {
			$this->frontController->deleteMyComment($_GET['parameter']);
		}
	}

	public function renderPostAndComments(){
		if ($_GET['route'] === 'postAndComments') {
			$this->frontController->postAndComments($_POST, $_GET['parameter'], $_GET['page']);
		}
		elseif ($_GET['route'] === 'deleteComment') {
			$this->frontController->deleteComment($_GET['parameter'], $_GET['page'], $_GET['commentId']);
		}


	}

	public function renderAgreeDisagree(){
		if ($_GET['route'] === "addRemoveAgree") {
			$this->frontController->addRemoveVote($_GET['parameter'], 'agree');
		} elseif ($_GET['route'] === "addRemoveDisagree") {
			$this->frontController->addRemoveVote($_GET['parameter'], 'disagree');
		} elseif ($_GET['route'] === "getAllVotes") {
			$this->frontController->getAllVotes($_GET['parameter']);
		}   
	}

	public function renderAdministration(){
		if ($_GET['route'] === 'administration') {
			$this->adminController->administration();
		} 
		elseif ($_GET['route'] === 'getRole') {
			$this->adminController->getRole($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'moderator') {
			$this->adminController->moderator($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'member') {
			$this->adminController->member($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'deleteMember') {
			$this->adminController->deleteMember($_GET['parameter']);
		}
		
	}

	public function renderNewsletter(){
		if ($_GET['route'] === 'newsletters') {
			$this->frontController->newsletters();
		}
	}
}
