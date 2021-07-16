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
	private $adminController;
	private $found;

	public function __construct(){
		$this->frontController = new FrontController();
		$this->adminController = new AdminController();
		$this->found = 0;
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
				$this->errorPage();
			}
			if ($this->found === 0) {
				$this->redirectErrorPage();
			}
		} else {
			$this->frontController->home();
		}
	}

	public function renderBooks(){
		if ($_GET['route'] === 'books') {
			$this->found = 1;
			$this->frontController->getBooks();
		}
		elseif ($_GET['route'] === 'book') {
			$this->found = 1;
			$this->frontController->getOneBook($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'addOneBook') {
			$this->found = 1;
			$this->adminController->addOneBook($_POST);
		}
	}

	public function renderMember(){
		if ($_GET['route'] === 'register') {
			$this->found = 1;
			$this->frontController->register($_POST);
		}
		elseif ($_GET['route'] === 'connection') {
			$this->found = 1;
			$this->frontController->connection($_POST);
		}
		elseif ($_GET['route'] === 'disconnection') {
			$this->found = 1;
			$this->frontController->disconnection();
		}
		elseif ($_GET['route'] === 'updateData') {
			$this->found = 1;
			$this->frontController->updateData($_POST);
		}
		elseif ($_GET['route'] === 'deleteSubscriber') {
			$this->found = 1;
			$this->frontController->deleteSubscriber($_GET['parameter']);
		}
	}

	public function renderForum(){
		if ($_GET['route'] === 'forum') {
			$this->found = 1;
			$this->frontController->forum();
		}
		elseif ($_GET['route'] === 'post') {
			$this->found = 1;
			$this->frontController->post($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'addForumPost') {
			$this->found = 1;
			$this->frontController->addForumPost($_POST, $_GET['parameter']);
		}
		elseif ($_GET['route'] === 'myPosts') {
			$this->found = 1;
			$this->frontController->myPosts();
		}
		elseif ($_GET['route'] === 'updatePost') {
			$this->found = 1;
			$this->frontController->updatePost($_POST, $_GET['parameter']);
		}
		elseif ($_GET['route'] === 'deletePost') {
			$this->found = 1;
			$this->frontController->deletePost($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'addAComment') {
			$this->found = 1;
			$this->frontController->addAComment($_POST, $_GET['parameter'], $_GET['page']);
		}
		elseif ($_GET['route'] === 'updateMyComment') {
			$this->found = 1;
			$this->frontController->updateMyComment($_POST, $_GET['parameter']);
		}
		elseif ($_GET['route'] === 'deleteMyComment') {
			$this->found = 1;
			$this->frontController->deleteMyComment($_GET['parameter']);
		}
	}

	public function renderPostAndComments(){
		if ($_GET['route'] === 'postAndComments') {
			$this->found = 1;
			$this->frontController->postAndComments($_POST, $_GET['parameter'], $_GET['page']);
		}
		elseif ($_GET['route'] === 'deleteComment') {
			$this->found = 1;
			$this->frontController->deleteComment($_GET['parameter'], $_GET['page'], $_GET['commentId']);
		}
	}

	public function renderAgreeDisagree(){
		if ($_GET['route'] === "addRemoveAgree") {
			$this->found = 1;
			$this->frontController->addRemoveVote($_GET['parameter'], 'agree');
		} elseif ($_GET['route'] === "addRemoveDisagree") {
			$this->found = 1;
			$this->frontController->addRemoveVote($_GET['parameter'], 'disagree');
		} elseif ($_GET['route'] === "getAllVotes") {
			$this->found = 1;
			$this->frontController->getAllVotes($_GET['parameter']);
		}   
	}

	public function renderAdministration(){
		if ($_GET['route'] === 'administration') {
			$this->found = 1;
			$this->adminController->administration();
		} 
		elseif ($_GET['route'] === 'getRole') {
			$this->found = 1;
			$this->adminController->getRole($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'moderator') {
			$this->found = 1;
			$this->adminController->moderator($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'member') {
			$this->found = 1;
			$this->adminController->member($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'deleteMember') {
			$this->found = 1;
			$this->adminController->deleteMember($_GET['parameter']);
		}
	}

	public function renderNewsletter(){
		if ($_GET['route'] === 'newsletters') {
			$this->found = 1;
			$this->frontController->newsletters();
		}
	}

	public function errorPage(){
		if ($_GET['route'] === 'errorPage') {
			$this->found = 1;
			$this->frontController->errorPage();
		}
	}

	public function redirectErrorPage(){
		header('Location:' . HOST . '/errorPage');
	}
}
