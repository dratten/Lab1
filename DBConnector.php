<?php
	define('DB_SERVER','localhost');
	define('DB_USER','dalzai');
	define('DB_PASS','mykhailnava1');
	define('DB_NAME','btc3205');
	
	class DBConnector
	{
		public $conn;
		public function openDatabase()
		{
			$this->conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME) or die("Error:" .mysqli_error());
			return $this->conn;
		}
		public function closeDatabase()
		{
			mysqli_close($this->conn);
		}
	}

?>