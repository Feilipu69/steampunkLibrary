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
			if ($_GET['route'] === 'books') {
				$this->frontController->getBooks();
			}
			elseif ($_GET['route'] === 'book') {
				$this->frontController->getABook($_GET['parameter']);
			}
			elseif ($_GET['route'] === 'addABook') {
				$this->adminController->addABook($_POST);
			}
			elseif ($_GET['route'] === 'register') {
				$this->frontController->register($_POST);
			}
			elseif ($_GET['route'] === 'connection') {
				$this->frontController->connection($_POST);
			}
			elseif ($_GET['route'] === 'account') {
				$this->frontController->account();
			}
			elseif ($_GET['route'] === 'updateData') {
				$this->frontController->updateData($_POST);
			}
			elseif ($_GET['route'] === 'mySubjects') {
				$this->frontController->mySubjects();
			}
			elseif ($_GET['route'] === 'disconnection') {
				$this->frontController->disconnection();
			}
			elseif ($_GET['route'] === 'deleteSubscriber') {
				$this->frontController->deleteSubscriber();
			}
			elseif ($_GET['route'] === 'administration') {
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
			elseif ($_GET['route'] === 'newsletters') {
				$this->frontController->newsletters();
			}
			elseif ($_GET['route'] === 'forum') {
				$this->frontController->forum();
			}
			elseif ($_GET['route'] === 'forumThemes') {
				$this->frontController->forumThemes($_GET['parameter']);
			}
			elseif ($_GET['route'] === 'forumFormular') {
				$this->frontController->forumFormular();
			}
			elseif ($_GET['route'] == 'addForumTheme') {
				$this->frontController->addForumTheme($_POST);
			}
			elseif ($_GET['route'] === 'opinionFormular') {
				$this->frontController->opinionFormular($_GET['parameter']);
			}
		} else {
			$display = new View('home');
			$display->render([]);
		}
	}
}
