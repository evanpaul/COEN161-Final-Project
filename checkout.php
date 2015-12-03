<?php
	session_start();
	include ("mysqlConnection.php");

	$member = false;

	//check if they are actually a member
	if (isset($_POST['memberId']))
	{
		$mId = 	$_POST['memberId'];	
		$result = mysqli_query($connection, "SELECT Membid, FROM Members WHERE Membid=$mId");
		if($result)
			$member = true;
	}

	//handle final price calcs
	$finalPrice = ($member ? ($_SESSION['total'] * 0.9) : ($_SESSION['total']));
	$tax = round((0.075 * $finalPrice),2);
	$total = $finalPrice + $tax + 4.99;
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
					<li><a href="forum.php">Forum</a></li>
					<li><a href="ppage.php">Product Page</a></li>
					<li><a href="quiz.html">Quiz</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a id="date"></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container" id="checkout">
		<h2 style="text-align:center"> Checkout </h2>
		<div class="row">
				<a role="button" class="btn btn-primary" href="cart.php" id="viewCartButton" style="float:right">Return to Shopping Cart</a>
		</div>
		<div class="row top">
			<div class="col-md-6">
				<h4>Price:</h4>
			</div>
			<div class="col-md-6">
				<h4> $<?php echo $finalPrice ?> </h4>
			</div>
		</div>
		<div class="row top">
			<div class="col-md-6">
				<h4>CA Tax:</h4>
			</div>
			<div class="col-md-6">
				<h4> $<?php echo $tax ?> </h4>
			</div>
		</div>
		<div class="row top">
			<div class="col-md-6">
				<h4>Shipping:</h4>
			</div>
			<div class="col-md-6">
				<h4> $4.99 </h4>
			</div>
		</div>
		<div class="row top">
			<strong>
			<div class="col-md-6">
				<h3>Total:</h3>
			</div>
			<div class="col-md-6">
				<h3> $<?php echo $total ?> </h3>
			</div>
			</strong>
		</div>
		<div class="row">
			<div class="col-md-12">
				<a role="button" class="btn btn-primary btn-lg" href="cart.php?checkedOut&clear" id="viewCartButton">Checkout</a>
			</div>
		</div>
	</div>
</body>
</html>
<?php mysqli_close($connection); ?>
