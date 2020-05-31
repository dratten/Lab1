<?php
	session_start();
	include_once 'DBConnector.php';
	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
	}
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		header('HTPP/1.0 403 Forbidden');
		echo 'You are forbidden!';
	}
	else
	{
		$db = new DBConnector;
		$conn = $db->openDatabase();
		$api_key = null;
		$api = new ApiKey(64,$username,$conn);
		header('Content-type: application/json');
		echo $api->generateResponse();
	}

	
	class ApiKey 
	{
		private $str_length;
		private  $api_key;
		private  $username;
		private  $conn;
		public function __construct($str_length,$username,$conn)
		{
			$this->str_length = $str_length;
			$this->username = $username;
			$this->conn = $conn;
		}

		public function generateApiKey()
		{
			$length = $this->str_length;
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$bytes = openssl_random_pseudo_bytes(3*$length/4+1);
			$repl = unpack(('C2'), $bytes);

			$first = $chars[$repl[1]%62];
			$second = $chars[$repl[2]%62];
			$this->api_key = strtr(substr(base64_encode($bytes),0,$length), '+/', "$first$second");
			return $this->api_key;
		}

		public function saveApiKey()
		{
			$id = "";
			$this->api_key = $this->generateApiKey();
			$sv = mysqli_query($this->conn, "SELECT id FROM user WHERE username = '$this->username'");
			while($row = mysqli_fetch_array($sv))
			{
				$id = $row['id'];
			}
			$save = mysqli_query($this->conn, "UPDATE api_keys SET api_key = '$this->api_key' WHERE user_id = '$id'");
			return $save;
		}

		public function generateResponse()
		{
			if($this->saveApiKey())
			{
				$res = ['success' => 1, 'message' => $this->api_key];
			}
			else
			{
				$res = ['success' => 0, 'message' => 'Something went wrong. Please regnerate the API key.'];
			}
			return json_encode($res);
		}
	}
?>