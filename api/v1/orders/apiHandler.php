<?php
	include_once '../../../DBConnector.php';
	class ApiHandler
	{
		private $meal_name;
		private $meal_units;
		private $unit_price;
		private $status;
		private $user_api_key;

		public function setMealName($meal_name)
		{
			$this->meal_name = $meal_name;
		}
		public function getMealName()
		{
			return $this->meal_name;
		}

		public function setMealUnits($meal_units)
		{
			$this->meal_units = $meal_units;
		}
		public function getMealUnits()
		{
			return $this->meal_units;
		}

		public function setUnitPrice($unit_price)
		{
			$this->unit_price = $unit_price;
		}
		public function getUnitPrice()
		{
			return $this->unit_price;
		}

		public function setStatus($status)
		{
			$this->status = $status;
		}
		public function getStatus()
		{
			return $this->status;
		}

		public function setUserApiKey($user_api_key)
		{
			$this->user_api_key = $user_api_key;
		}
		public function getUserApiKey()
		{
			return $this->user_api_key;
		}

		public function createOrder()
		{
			$db = new DBConnector();
			$conn = $db->openDatabase();
			$res = mysqli_query($conn,"INSERT INTO orders (order_name,units,unit_price,order_status) VALUES('$this->meal_name','$this->meal_units','$this->unit_price','$this->status')") or die("Error:".mysqli_error());
			return $res; 
		}

		public function checkOrderStatus($order_id)
		{
			$db = new DBConnector();
			$conn = $db->openDatabase();
			$res = mysqli_query($conn, "SELECT order_status FROM orders WHERE order_id = '$order_id'");
			while($row = mysqli_fetch_array($res))
			{
				$this->setStatus($row['order_status']);
			}
		}

		public function fetchAllOrders()
		{

		}

		public function checkApiKey()
		{
			$db = new DBConnector();
			$conn = $db->openDatabase();
			$res = mysqli_query($conn,"SELECT api_key FROM api_keys");
			while($row = mysqli_fetch_array($res))
			{
				if($row['api_key'] == $user_api_key)
				{
					break;
				}
			}
			return true;
		}

		public function checkContentType()
		{

		}
	}
?>