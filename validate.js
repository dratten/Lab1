function validateForm() 
{
	var fname = document.forms["user_details"]["first_name"].value;
	var lname = document.forms["user details"]["last_name"].value;
	var city = document.forms["user_details"]["city_name"].value;

	if (fname == "david" || lname == "" || city == "")
	{
		alert("All details required were not supplied");
		return false;
	}
	return true;
}