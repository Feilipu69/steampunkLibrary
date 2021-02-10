<?php
namespace Bihin\steampunkLibrary\src\DAO;

use PDO;
use Exception;

abstract class DbConnect
{
	protected $db;

	public function __construct(){
		try
		{
			$this->db = new PDO('mysql:host=localhost;dbname=steampunkLibrary;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		}
		catch(Exception $e)
		{
			die('Erreur : ' + $e->getMessage());
		}
	}
}
