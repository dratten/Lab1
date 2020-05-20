<?php
	include 'crud.php';
	include 'authenticate.php';
	class User implements Crud,Authenticator
	{
		private $user_id;
		private $first_name;
		private $last_name;
		private $city_name;
		private $username;
		private $password;
		private $utc_timestamp;
		private $offset;

		public function __construct($first_name,$last_name,$city_name,$username,$password,$utc_timestamp,$offset)
		{
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->city_name = $city_name;
			$this->username = $username;
			$this->password = $password;
			$this->utc_timestamp = $utc_timestamp;
			$this->offset = $offset;
		}

		public function checkUsername($conn,$username)
		{
			$uname = $this->username;
			$res = mysqli_query($conn,"SELECT username FROM user WHERE username LIKE '$username'");
			if($res->num_rows == 0)
			{
				$style = "none";
			}
			else
			{
				$style = "";
			}
			return $style;
		}

		public function setUsername($username)
		{
			$this->username = $username;
		}

		public function getUsername()
		{
			return $this->username;
		}

		public function setPassword($password)
		{
			$this->password = $password;
		}

		public function getPassword()
		{
			return $this->password;
		}

		public function setUserId($user_id)
		{
			$this->user_id = $user_id;
		}

		public function getUserId()
		{
			return $this->user_id;
		}

		public function setTimeStamp($utc_timestamp)
		{
			$this->utc_timestamp = $utc_timestamp;
		}

		public function getTimeStamp()
		{
			return $this->utc_timestamp;
		}

		public function setOffset($offset)
		{
			$this->offset = $offset;
		}

		public function getOffset()
		{
			return $offset;
		}

		public function save($conn,$result)
		{
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;
			$uname = $this->username;
			$timestamp = $this->utc_timestamp;
			$off = $this->offset;
			$this->hashPassword();
			$pass = $this->password;
			 
			if($result == "none")
			{
				$res = mysqli_query($conn,"INSERT INTO user(first_name,last_name,user_city,username,password,utctimestamp,offset) VALUES ('$fn','$ln','$city','$uname','$pass','$timestamp','$off')");
				return $res;
			}
		}
		public function readAll()
		{
			return null;
		}
		public function readUnique()
		{
			return null;
		}
		public function search()
		{
			return null;
		}
		public function update()
		{
			return null;
		}
		public function removeOne()
		{
			return null;
		}
		public function removeAll()
		{
			return null;
		}
		public function valiteForm()
		{
			$fn = $this->first_name;
			$ln = $this->last_name;
			$city = $this->city_name;

			if($fn == "" || $ln == "" || $city == "")
			{
				return false;
			}
			return true;
		}

		public function createFormErrorSessions()
		{
			session_start();
			$_SESSION['form_errors'] = "All fields required";
		}

		public function hashPassword()
		{
			$this->password = password_hash($this->password, PASSWORD_DEFAULT);
		}

		public function isPasswordCorrect($conn)
		{
			$found = false;
			$res = mysqli_query($conn,"SELECT * FROM user") or die("Error" . mysqli_error());

			while($row = mysqli_fetch_array($res))
			{
				if(password_verify($this->password, $row['password']) && $this->getUsername() == $row['username'])
				{
					$found = true;
				}
			}
			return $found;
		}

		public function login($conn)
		{
				header("Location:private_page.php");
		}

		public function createUserSession()
		{
			session_start();
			$_SESSION['username'] = $this->getUsername();
		}

		public function logout()
		{
			session_start();
			unset($_SESSION['username']);
			session_destroy();
			header("Location:lab1.php");
		}
	}
?>