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
			// render books
			if ($_GET['route'] === 'books') {
				$this->frontController->getBooks();
			}
			elseif ($_GET['route'] === 'book') {
				$this->frontController->getABook($_GET['parameter']);
			}
			elseif ($_GET['route'] === 'addABook') {
				$this->adminController->addABook($_POST);
			}

			// render member
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

			// render subjects and comments
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

			// agree disagree
			if ($_GET['route'] === "addRemoveAgree") {
				$this->frontController->addRemoveAgree($_GET['parameter']);
			}

			// render administration
			if ($_GET['route'] === 'administration') {
				$this->adminController->administration();
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

			// render newsletter
			if ($_GET['route'] === 'newsletters') {
				$this->frontController->newsletters();
			}

			// render forum
			if ($_GET['route'] === 'forum') {
				$this->frontController->forum();
			}
			elseif ($_GET['route'] === 'forumThemes') {
				$this->frontController->forumThemes($_GET['parameter']);
			}
			elseif ($_GET['route'] === 'addForumTheme') {
				$this->frontController->addForumTheme($_POST, $_GET['parameter']);
			}
		} else {
			$display = new View('home');
			$display->render([]);
		}
	}
}
