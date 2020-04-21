<?php
	include 'DBConnector.php';
	include 'user.php';
	if(isset($_POST['btn_save']))
	{
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$city = $_POST['city_name'];
		$db = new DBConnector;
		$conn = $db->openDatabase();

		$user = new User($first_name,$last_name,$city);
		$res = $user->save($conn);

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
</head>
<body>
	<form method="post">
		<table align="center">
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
				<td><button type="submit" name="btn_save"><strong>SAVE</strong></button></td>
			</tr>
		</table>
	</form>
</body>
</html>