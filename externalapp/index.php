<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>Title Here</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

	<script src="jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="placeholder.js"></script>
</head>
<body>
	<h3>It is time to communicate with the exposed API, all we need is the API key to be passed in the header</h3><hr>
	<h4>1. Feature 1 - Placing an order</h4>

	<form name="order_form" id="order_form">
		<fieldset>
			<legend>Place Order</legend>
			<input type="text" name="name_of_food" id="name_of_food" required placeholder="Name of Food"><br>
			<input type="number" name="number_of_units" id="number_of_units" required placeholder="Number of Units"><br>
			<input type="number" name="unit_price" id="unit_price" required placeholder="Unit Price"><br>
			<input type="text" name="api_key" id="api_key" required placeholder="Personal Key"><br><br>
			<input type="hidden" name="status" id="status" required placeholder="unit_price" value="order placed"><br><br>
			<button class="btn btn-primary" type="submit" id="btn-place-order">Place order >></button>
		</fieldset>
	</form>

	<hr>
	<h4>2. Feature 2 - Checking Order Status</h4>
	<hr>
	<form name="order_status_form" id="order_status_form" method="post">
		<fieldset>
			<legend>Check Order Status</legend>
			<input type="text" name="order_id" id="order_id" required placeholder="Order ID"><br><br>
			<button class="btn btn-warning" id="btn-order-status" type="submit">Check Order Status</button>
		</fieldset>
	</form>
</body>
</html>