<?php
namespace Bihin\steampunkLibrary\src\DAO;

use Bihin\steampunkLibrary\src\DAO\DbConnect;
use Bihin\steampunkLibrary\src\model\MessageDesLeviathans;

class MessageDesLeviathansManager extends DbConnect
{
	public function addMessageDesLeviathans($post){
		$req = $this->db->prepare('INSERT INTO messageDesLeviathans (title, message, date) VALUES (:title, :message, NOW())');
		$message = new MessageDesLeviathans($post);
		$req->execute([
			':title' => $message->getTitle(),
			':message' => $message->getMessage()
		]);
	}

	public function getMessagesDesLeviathans(){
		$req = $this->db->query('SELECT title, message, DATE_FORMAT(date, "%d/%m/%Y") AS date FROM messageDesLeviathans');
		while ($data = $req->fetch()) {
			$messages[] = new MessageDesLeviathans($data);
		}
		return $messages;
	}
}
?>
