<?php
include_once '../../includes/connect.php';

class Users {
	public $link;
	
	function __construct(){
		$db_connect = new dbConnect;
		$this->link = $db_connect->connect();
		return $this->link;
	}
	
	
	function getUsername($username) {
		$query = $this->link->prepare("SELECT user_id FROM users WHERE  user_name = ?");
		$query->bindValue(1, $username);
		$query->execute();
		$count = $query->rowCount();
		return $count;
	}
	
	
	function loginUser($username,$password) {
		$query = $this->link->prepare("SELECT user_id,user_name FROM users WHERE user_name = ? AND user_password = ?");
		$query->bindValue(1, $username);
		$query->bindValue(2, $password);
		$query->execute();
		return  $query->fetch(PDO::FETCH_ASSOC);
	}
}