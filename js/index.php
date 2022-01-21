<html>
	<head>
		<title>Food panda</title>
	
		<style>
			body{
				font-family : 'Segoe UI';
			}
			textarea, input{
				font-family : 'Segoe UI';
				padding : 10px;
			}
			
			textarea{
				min-width  : 300px;
				min-height : 150px;
			}
			
			input{
				margin-top : 10px;
			}
			
			h1{
				font-size : 30px;
				font-weight : 500;
			}
			
			textarea {
				border-radius: 7px;
			}
			body{
				padding-left : 50px;
			}
			
			.logo img{
				width : 190px;
			}
			
			.logo{
				text-align : center;
			}
		</style>
	
	</head>

	
	<body>
		<div class = "logo">
			<img src = "logo.png"/>
		</div>
	
		<h1>Create Account</h1>
		<form action = "queryget.php" method = "get">
			<textarea name = "query">
insert into customer 
values(default, 'rhythm', 'rafid', 'em@gmail.com', '1234', '1762152303', 6);
			</textarea><br/>
			<input type = "submit" value = "SUBMIT"></submit>
		</form>

		<h1>Login query</h1>
		<form action = "query.php" method = "post">
			<textarea name = "query">
select first_name, last_name 
from customer 
where email = 'amtrafid@gmail.com' and password = '1234';
			</textarea><br/>
			<input type = "submit" value = "SUBMIT"></submit>
		</form>

		<h1>Add location</h1>
		<form action = "query.php" method = "post">
			<textarea name = "query">
insert into location 
values(default, 'street', 'area', 'city',	12, 146);
			</textarea><br/>
			<input type = "submit" value = "SUBMIT"></submit>
		</form>

		<h1>Add restaurant</h1>
		<form action = "query.php" method = "post">
			<textarea name = "query">
insert into restaurant 
values(default, 'The Cave', 'cave@hotmail.com', '123', 3, 3);
			</textarea><br/>
			<input type = "submit" value = "SUBMIT"></submit>
		</form>

		<h1>Find Pizza in Banani</h1>
		<form action = "query.php" method = "post">
			<textarea name = "query">
select (SELECT restaurant.rest_name from restaurant where restaurant.rest_id = menu_item.rest_id), price, item_name
from menu_item
where menu_item.rest_id = 
any (select r.rest_id from restaurant r, location l where r.location_id= l.location_id and
lower(l.area) LIKE '%banani%')
and lower(item_name) LIKE '%pizza%';</textarea><br/>
			<input type = "submit" value = "SUBMIT"></submit>
		</form>		

		<h1>Find active delivery boy nearby</h1>
		<form action = "query.php" method = "post">
			<textarea name = "query">
select *
from delivery_boy
where 
loctokm(current_location,
(select concat(concat(lattitude, ','), longitude) 
 from location l JOIN restaurant r on (l.location_id = r.location_id) 
 where rest_id = 1)) <= 10
 and active_status = 1;
			</textarea><br/>
			<input type = "submit" value = "SUBMIT"></submit>
		</form>		

		<h1>Find restaurants nearby</h1>
		<form action = "query.php" method = "post">
			<textarea name = "query">
select restaurant.rest_name
from restaurant, customer
where 
customer_id = 3
and 
loctokm((select concat(l.lattitude, ',', l.longitude) from location l where l.location_id = customer.location_id), 
(select concat(l.lattitude, ',', l.longitude) from location l where l.location_id = restaurant.location_id)) <= 100;
			</textarea><br/>
			<input type = "submit" value = "SUBMIT"></submit>
		</form> 

		<h1>Calculate total charge</h1>
		<form action = "query.php" method = "post">
			<textarea name = "query">
select (sum(price) + (select delivery_charge from order_ where order_.order_id = 1)) as totalPrice
from order_item
where order_item.order_id = 1;
			</textarea><br/>
			<input type = "submit" value = "SUBMIT"></submit>
		</form> 

		<h1>Add order</h1>
		<form action = "query.php" method = "post">
			<textarea name = "query">
insert into order_ (order_id, customer_id, rest_id, datetime, delivery_status, location_to) values(default, 2, 1, CURRENT_TIMESTAMP, 0, '12.589, 14.12');
			</textarea><br/>
			<input type = "submit" value = "SUBMIT"></submit>
		</form> 

		
		<h1>Add item to order</h1>
		<form action = "query.php" method = "post">
			<textarea name = "query">
select additem(1, 3, 10); -- orderId, itemNo, quantity
			</textarea><br/>
			<input type = "submit" value = "SUBMIT"></submit>
		</form> 
		
	</body>
	
	
</html>
