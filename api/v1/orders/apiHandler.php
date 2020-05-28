<?php
	include_once '../../../DBConnector.php';
	class ApiHandler
	{
		private $meal_name;
		private $meail_units;
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

		public function setMealUnits($meail_units)
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
			$conn = db->openDatabase();
			$res = mysqli_query($conn,"INSERT INTO orders (order_name,units,unit_price,order_status) VALUES('$this->meal_name','$this->meal_units','$this->unit_price','$this->status')") or die("Error:".mysqli_error());
			return $res; 
		}

		public function checkOrderStatus()
		{

		}

		public function fetchAllOrders()
		{

		}

		public function checkApiKey()
		{
			return true;
		}

		public function checkContentType()
		{

		}
	}
?>