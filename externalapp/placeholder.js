$(document).ready(function()
{
	$('#btn-place-order').click(function(event)
	{
		var name_of_food = $('#name_of_food').val();
		var number_of_units = $('#number_of_units').val();
		var unit_price = $('#unit_price').val();
		var order_status = $('#status').val();
		var api_key = $('#api_key').val();

		$.ajax(
		{
			url: "https://localhost/labs/api/v1/orders/index.php",
			type: "post",
			data: {name_of_food:name_of_food,number_of_units:number_of_units,unit_price:unit_price,order_status:order_status,api_key:api_key},
			//headers:{'Authorization':'Basic qo9zHm7QeV3C1RAfSjCjTA3ijfsBhgb6DYQ6P4dcBJcljiOhWwAlE4fYbK7lYGMa'},
			success: function(data)
			{
				alert(data['message']);
			},
			error: function()
			{
				alert("An error occured");
			}
		});
	});
	$('#btn-order-status').click(function(event)
	{
		var order_id = $('#order_id').val();
		$.ajax(
		{
			url: "https://localhost/labs/api/v1/orders/index.php",
			type: "get",
			data: {order_id:order_id},
			success: function(data)
			{
				$('#order_id').val(data['message']);
			},
			error: function()
			{
				alert("An error occured");
			}
		});
	});
});