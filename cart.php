<?php 
	session_start();
	include ("mysqlConnection.php"); 
	
	$totalPrice = 0;
	$member = false;
	
	//adds the passed item (using GET) to the SESSION cart
	function addToCart()
	{
		//Get the item id 
		$addItemId = $_GET['add'];
							
		if (isset($_SESSION['cart']))
		{
			$mycart = $_SESSION['cart'];
			
			//if the item is in the cart, increment the count
			if (isset($mycart[$addItemId])){
				$mycart[$addItemId]+= 1;									
			} 
			//if the item is not in the cart, add it
			else{
				$mycart[$addItemId] = 1;
			}		
		}
		else
		{
			//cart does not exist so create one
			$mycart = array();
			$mycart[$addItemId] = 1;
		}
		$_SESSION['cart'] = $mycart; 
	}
	
	//called after a checkout, this will update the quantities in the db for every item purchased
	function updateInventory()
	{
		foreach($_SESSION['cart'] as $itemId=>$itemCount)
		{
			$result = mysqli_query($connection, "UPDATE Products SET quantity = (quantity - $itemCount) WHERE id=$itemId");
		}
	}
	
	//clears and unsets the cart and total SESSION variables
	function clearCart()
	{
		if (isset($_SESSION['cart']))
			unset($_SESSION['cart']);
		if (isset($_SESSION['total']))
			unset($_SESSION['total']);
	}
	
	//cases for handling the cart
	
	//and item is to be added
	if ( isset($_GET['add'])) 
	{ 
		addToCart();
		unset($_GET['add']);
	}
	
	//the user has checked out
	if (isset($_GET['checkedOut']))
	{ 
		updateInventory();
		unset($_GET['checkedOut']);	
	}
	
	//the cart has be cleared
	if (isset($_GET['clear']))
	{ 
		clearCart();
		unset($_GET['clear']);	
	}				
?>

<!DOCTYPE html>
<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
	<title>Your Cart</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="ppageStyle.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css">
</head>
<body>
	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href = "index.html" class="navbar-brand"><object width="50" height ="50"type="image/svg+xml" data="logo1.svg"></object></a>
			</div>
			<div class="navbar-collapse collapse navbar-responsive-collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.html">Home</a></li>
					<li><a href="register.html">Registration</a></li>
					<li><a href="#">Forum</a></li>
					<li><a href="ppage.php">Product Page</a></li>
					<li><a href="quiz.html">Quiz</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a id="date"></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container" id="cart">
		<h2 style="text-align:center"> Shopping Cart </h2>
		<div class="row">
				<a role="button" class="btn btn-primary" href="ppage.php" id="viewCartButton" style="float:right">Return to Product Page</a>
		</div>
		<div class="row">
			<div class="col-md-8">
				<p>Item</p>
			</div>
			<div class="col-md-2">
				<p>Quantity</p>
			</div>
			<div class="col-md-2">
				<p>Price</p>
			</div>
		</div>
		<?php
			//no items in cart
			if (!isset($_SESSION['cart']))
			{
				echo '<center><h3 class="bottom">Cart is empty.</h3></center>';
			}
			
			//store each item name, price and quantity from db
			else
			{			
				foreach($_SESSION['cart'] as $itemId=>$itemCount)
				{
					$result = mysqli_query($connection, "SELECT name,price FROM Products WHERE id=$itemId");
					$row = mysqli_fetch_array($result, MYSQLI_NUM);
					$name = $row[0];
					$price = $row[1];
					$totalItemPrice = $row[1] * $itemCount;
					$totalPrice += $totalItemPrice; 
					echo '<div class="row top"> <div class="col-md-8">',"<h4>$name</h4>",'</div>';
					echo '<div class="col-md-2">',"<h4>$itemCount</h4>",'</div>';
					echo '<div class="col-md-2">','<h4>$',$price,'</h4>','</div>','</div>';
					$_SESSION['total'] = $totalPrice;
				}
			}
			mysqli_close($connection);	
		?>
		<div class="row top">
			<div class="col-md-2">
				<a role="button" class="btn btn-primary" href="cart.php?clear">Clear Cart</a>
			</div>
			<div class="col-md-10">	
				<h3 style="float:right" id="totalPrice"> Total Price: $<?php echo $totalPrice; ?></h3>
			</div>
		</div>
			
		<div class="row">
			<div class="col-md-12">
				<div id="memberForm" class="panel panel-default">
					<div class="panel-body">
						<form class="form-horizontal" action="checkout.php" method="POST">
						<fieldset>
							<legend>Member Checkout</legend>
							<div class="form-group">
								<label class="col-md-2 control-label">Member Id</label>
								<div class="col-md-10">
									<input type="text" class="form-control" id="inputName" name="memberId">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-10 col-md-offset-2">
									<button type="submit" class="btn btn-primary">Checkout</button>
								</div>
							</div>
						</fieldset>
					  </form>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div id="memberForm" class="panel panel-default">
					<div class="panel-body">
					  <form class="form-horizontal" action="checkout.php" method="POST">
						<fieldset>
						  <legend>Non-Member Checkout</legend>
						  <div class="form-group">
							<label class="col-md-2 control-label">Mailing Address</label>
							<div class="col-md-10">
							  <input type="text" class="form-control" id="inputName" name="address">
							</div>
						  </div>
						  <div class="form-group">
							<label class="col-md-2 control-label">Email</label>
							<div class="col-md-10">
							  <input type="text" class="form-control" id="inputEmail" name="email">
							</div>
						  </div>
						  <div class="form-group">
							<label class="col-md-2 control-label">Phone Number</label>
							<div class="col-md-10">
							  <input type="text" class="form-control" id="inputEmail" name="phoneNumber">
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-md-10 col-md-offset-2">
							  <button type="submit" class="btn btn-primary">Checkout</button>
							</div>
						  </div>
						</fieldset>
					  </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>	