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
			$this->renderBooks();
			$this->renderMember();
			$this->renderForum();
			$this->renderSubjectAndComments();
			$this->renderAgreeDisagree();
			$this->renderAdministration();
			$this->renderNewsLetter();
		} else {
			$display = new View('home');
			$display->render([]);
		}
	}

	public function renderBooks(){
		if ($_GET['route'] === 'books') {
			$this->frontController->getBooks();
		}
		elseif ($_GET['route'] === 'book') {
			$this->frontController->getOneBook($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'addABook') {
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
			$this->frontController->deleteSubscriber();
		}
	}

	public function renderForum(){
		if ($_GET['route'] === 'forum') {
			$this->frontController->forum();
		}
		elseif ($_GET['route'] === 'forumThemes') {
			$this->frontController->forumThemes($_GET['parameter']);
		}
		elseif ($_GET['route'] === 'addForumTheme') {
			$this->frontController->addForumTheme($_POST, $_GET['parameter']);
		}
	}

	public function renderSubjectAndComments(){
		if ($_GET['route'] === 'mySubjects') {
			$this->frontController->mySubjects();
		}
		elseif ($_GET['route'] === 'subjectAndComments') {
			$this->frontController->subjectAndComments($_POST, $_GET['parameter']);
		}
		elseif ($_GET['route'] === 'updateSubject') {
			$this->frontController->updateSubject($_POST, $_GET['parameter']);
		}
		elseif ($_GET['route'] === 'deleteSubject') {
			$this->frontController->deleteSubject($_GET['parameter']);
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
		elseif ($_GET['route'] === 'deleteOpinion') {
			$this->adminController->deleteOpinion($_GET['parameter'], $_GET['page'], $_GET['opinionId']);
		}
	}

	public function renderNewsletter(){
		if ($_GET['route'] === 'newsletters') {
			$this->frontController->newsletters();
		}
	}
}
