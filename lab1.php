<?php
	include 'DBConnector.php';
	include 'user.php';
	include 'fileUploader.php';
	session_start();
	$_SESSION['style'] = "none";
	if(isset($_POST['btn_save']))
	{
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$city = $_POST['city_name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$utc_timestamp = $_POST['utc_timestamp'];
		$offset = $_POST['time_zone_offset'];
		$file_original_name = basename($_FILES['fileToUpload']['name']);
		$file_type = strtolower(pathinfo($file_original_name,PATHINFO_EXTENSION));
		$file_size = $_FILES['fileToUpload']['size'];
		$tmp_name = $_FILES["fileToUpload"]["tmp_name"];

		$db = new DBConnector;
		$conn = $db->openDatabase();

		$user = new User($first_name,$last_name,$city,$username,$password,$utc_timestamp,$offset);
		$uploader = new FileUploader($file_original_name,$file_type,$file_size,$tmp_name);
		
		if(!$user->valiteForm())
		{
			$user->createFormErrorSessions();
			header("Refresh:0");
			die;
		}
		$result = $user->checkUsername($conn,$username);
		$_SESSION['style'] = $result;
		$check = $uploader->moveFile();
		if($check == "")
		{
			$res = $user->save($conn,$result);
			$username = $user->getUsername();
			$file_upload_response = $uploader->uploadFile($conn,$username);
			if($res && $file_upload_response)
			{
				echo "Save operation was successful";
			}
		}
		else
		{
			echo $check;
		}
		
	}
?>
<html>
<head>
	<title>Title goes here</title>
	<script type="text/javascript" src="validate.js"></script>
	<link rel="stylesheet" type="text/css" href="validate.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script type="text/javascript" src="timezone.js"></script>
</head>
<body>
	<form method="post" name="user_details" id="user_details" onsubmit="return validateForm()" enctype="multipart/form-data">
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
				<td><b>Profile image: </b><input type="file" name="fileToUpload"></td>
			</tr>
			<input type="hidden" name="utc_timestamp" id="utc_timestamp" value="">
			<input type="hidden" name="time_zone_offset" id="time_zone_offset" value="">
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