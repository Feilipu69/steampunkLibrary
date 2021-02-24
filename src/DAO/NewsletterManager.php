<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\Newsletter;

class NewsletterManager extends DbConnect
{
	public function addNewsletter($post){
		$req = $this->db->prepare('INSERT INTO newsletter (title, message, date) VALUES (:title, :message, NOW())');
		$message = new Newsletter($post);
		$req->execute([
			':title' => $message->getTitle(),
			':message' => $message->getMessage()
		]);
	}

	public function getNewsletters(){
		$req = $this->db->query('SELECT title, message, DATE_FORMAT(date, "%d/%m/%Y") AS date FROM newsletter ORDER BY id DESC LIMIT 0, 5');
		while ($data = $req->fetch()) {
			$messages[] = new Newsletter($data);
		}
		return $messages;
	}
}
?>
