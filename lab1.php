<?php
	include 'DBConnector.php';
	include 'user.php';
	session_start();
	$_SESSION['style'] = "none";
	if(isset($_POST['btn_save']))
	{
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$city = $_POST['city_name'];
		$username = $_POST['username'];
		$password = $_POST['password'];

		$db = new DBConnector;
		$conn = $db->openDatabase();

		$user = new User($first_name,$last_name,$city,$username,$password);
		if(!$user->valiteForm())
		{
			$user->createFormErrorSessions();
			header("Refresh:0");
			die;
		}
		$result = $user->checkUsername($conn,$username);
		$_SESSION['style'] = $result;
		$res = $user->save($conn,$result);

		if($res)
		{
			echo "Save operation was successful";
		}
		else
		{
			echo "An error occured!";
		}
	}
?>
<html>
<head>
	<title>Title goes here</title>
	<script type="text/javascript" src="validate.js"></script>
	<link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
	<form method="post" name="user_details" id="user_details" onsubmit="return validateForm()">
		<table align="center">
			<tr>
				<td>
					<div id="form-errors">
						<?php
							if(!empty($_SESSION['form_errors']))
							{
								echo " " . $_SESSION['form_errors'];
								unset($_SESSION['form_errors']);
							}
						?>
					</div>
				</td>
			</tr>
			<tr>
				<td><input type="text" name="first_name" required placeholder="First Name"></td>
			</tr>
			<tr>
				<td><input type="text" name="last_name" placeholder="Last Name"></td>
			</tr>
			<tr>
				<td><input type="text" name="city_name" placeholder="City"></td>
			</tr>
			<tr>
				<td><input type="text" name="username" placeholder="Username"></td>
				<td><label style="display: <?php echo $_SESSION['style']?>">Try another username please</label></td>
			</tr>
			<tr>
				<td><input type="password" name="password" placeholder="Password"></td>
			</tr>
			<tr>
				<td><button type="submit" name="btn_save"><strong>SAVE</strong></button></td>
			</tr>
			<tr>
				<td><a href="login.php">Login</a></td>
			</tr>
		</table>
	</form>
</body>
</html>