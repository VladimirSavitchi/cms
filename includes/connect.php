<?php 
class dbConnect {
	protected $db_conn;
	public $dsn = 'mysql:dbname=portfolio;host=localhost';
	public $db_user = 'root';
	public $db_pass = '';
	
	function connect(){
		try {
			$this->db_conn = new PDO($this->dsn,$this->db_user,$this->db_pass);
			$this->db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->db_conn;
		} catch(PDOException $e){
			echo $e->getMessage();
			die();
		}
	}
}