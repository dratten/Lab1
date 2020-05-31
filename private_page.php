<?php
	session_start();
	include_once 'DBConnector.php';
	if(!isset($_SESSION['username']))
	{
		header("Location:login.php");
	}

	function fetchUserApiKey()
	{
		$username = $_SESSION['username'];
		$key = "";
		$db = new DBConnector;
		$conn = $db->openDatabase();
		$re = mysqli_query($conn, "SELECT id FROM user WHERE username = '$username'");
		while($row = mysqli_fetch_array($re))
		{
			$id = $row['id'];
		}
		$res = mysqli_query($conn, "SELECT api_key FROM api_keys WHERE user_id = '$id'");
		while($row = mysqli_fetch_array($res))
 		{
 			$key = $row['api_key'];
 		}
 		return $key;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Private Page</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

	<script src="jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="validate.js"></script>
	<script type="text/javascript" src="apikey.js"></script>
	<link rel="stylesheet" type="text/css" href="validate.css">

</head>
<body>
	<p><a href="logout.php">Logout</a></p>
	<hr>
	<h3>Here, we will create an API that will allow User/Developer to order items from external systems</h3>
	<hr>
	<h4>We now put this feature of allowing users to generate an API key. Click the button to generate the API key</h4>

	<button class="btn btn-primary" id="api-key-btn">Generate API key</button><br><br>
	<strong>Your API key:</strong>(Note that if your API key is already in use by already running applications, generating a new key will stop the application from functioning)<br>
	<textarea cols="100" rows="2" id="api_key" name="api_key" readonly><?php echo fetchUserApiKey(); ?></textarea>

	<h3>Service description:</h3>
	We have a service/API that allows external applications to order food and also pull all order status by using order is. Let's do it.
	<hr>
</body>
</html>

