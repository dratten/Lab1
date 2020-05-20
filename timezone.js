$(document).ready(function()
{
	var offset = new Date().getTimezoneOffset();
	var timestamp = new Date().getTime();
	var utc_timestamp = timestamp + (60000 * offset);

	//The following lines of code set the values in the input elements of the lab1.php file
	$('#time_zone_offset').val(offset);
	$('#utc_timestamp').val(utc_timestamp);
});