<?php
	interface Crud
	{
		public function save($conn,$result);
		public function readAll();
		public function readUnique();
		public function search();
		public function update();
		public function removeOne();
		public function removeAll();

		public function valiteForm();
		public function createFormErrorSessions();
		public function checkUsername($conn,$username);
	}
?>

