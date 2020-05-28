<?php
	include 'DBConnector.php';
	include 'user.php';

	$db = new DBConnector;
	if(isset($_POST['btn-login']))
	{
		$conn = $db->openDatabase();
		$username = $_POST['username'];
		$password = $_POST['password'];
		$instance = new User("","","",$username,$password,"","");
		$instance->setPassword($password);
		$instance->setUsername($username);
		if($instance->isPasswordCorrect($conn))
		{
			$db->closeDatabase();
			$instance->createUserSession();
			$instance->login($conn);
		}
		else
		{
			$db->closeDatabase();
			header("Location:login.php");
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
	<form method="post" name="login">
		<table align="center">
			<tr>
				<td><input type="text" name="username" placeholder="Username" required></td>
			</tr>
			<tr>
				<td><input type="password" name="password" placeholder="Password" required></td>
			</tr>
			<tr>
				<td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>
			</tr>
		</table>
	</form>
</body>
</html>