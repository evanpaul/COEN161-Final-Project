<?php
session_start();
include ("mysqlConnection.php"); 
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Products</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="ppageStyle.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css">
	<script src = "https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://cdn.rawgit.com/nnattawat/flip/v1.0.18/dist/jquery.flip.min.js"></script>
	<script>
		$( document ).ready(function(){
			$(".card").flip();
		});	
	</script>
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
	
	<div class="container" id="ppage">
		<h2 style="text-align:center"> Product Page </h2>
		<div class="row">
				<a role="button" class="btn btn-primary" href="cart.php" id="viewCartButton">View Cart</a>
		</div>
		
		<?php
		//format the rows for the products
		$productCount = 0;
		foreach($products as $row=>$data)
		{
			if(!($productCount % 3))
			{
				echo '<div class="row">';
			}
		?>
		<div class="col-md-4">
			<div class="card" id="firstCard">
				<div class="front">
					<h3 class="centered"><?php echo $data["name"]; ?></h3>
					<img src="<?php echo $data["image"]; ?>">
				</div>
				<div class="back">
					<h5><?php echo $data["name"]; ?></h5>
					<p>
						<?php echo $data["description"]; ?>
					</p>
					<p class="price"> <?php //handle out of stock case if there are no more in the db
											if($data["quantity"])
												echo '$',$data["price"],'</p>','<a role="button" id="addToCartButton" class="btn btn-info" href="cart.php?add=',$data["id"],'">Add to Cart</a>';
											else
												echo "This item is sold out!  We will email all of our members if the product becomes available again.",'</p>';
										?> 
				</div>
			</div>	
		</div>
		<?php
			$productCount++;
			if(!($productCount % 3))
			{
					echo "</div> <hr>";
			}
		}
		
		if($productCount % 3)
		{
			echo "</div>";
		}
		?>
	</div>
	<div class="center-fix"></div>
</body>
</html>
