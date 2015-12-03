<!DOCTYPE HTML>
<?php

$host="dbserver.engr.scu.edu"; // Host name
$username="mwerner"; // Mysql username
$password="00001013261"; // Mysql password
$db_name="sdb_mwerner"; // Database name
$tbl_name="forumPost"; // Table name


// Create connection
$conn = mysqli_connect($host, $username, $password, $db_name);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// get value of id that sent from address bar
$id=$_GET['id'];
$sql="SELECT * FROM $tbl_name WHERE postId='$id'";
$result=mysqli_query($conn, $sql);
$rows=mysqli_fetch_assoc($result);
?>
<html lang = "en">
<head>
	<meta charset="utf-8">
	<title>Forums</title>
	<!-- External scripts and stylesheets -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css"></script>
	<!-- User defined stylesheet -->
	<link rel = "stylesheet" href = "style.css">
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
        <a id = "logo" href = "index.html" class="navbar-brand"><object width="50" height ="50"type="image/svg+xml" data="logo1.svg"></object></a>
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
<table width="70%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td><table width="100%" border="0" cellpadding="3" cellspacing="1" bordercolor="1" bgcolor="#FFFFFF">
<tr>
<td bgcolor="#F8F7F1"><h3><u><?php echo $rows['postTitle']; ?></u></h3></td>
</tr>

<tr>
<td bgcolor="#F8F7F1"><h5><?php echo nl2br($rows['postDescription']); ?></h5></td>
</tr>

<!-- <tr><td bgcolor="#F8F7F1"><strong>ID :</strong> <?php echo $rows['postAuthor']; ?></tr> -->

<tr>
<td bgcolor="#F8F7F1"><strong>Date : </strong><?php echo $rows['postDate']; ?></td>
</tr>
</table></td>
</tr>
</table>
<BR>
<h3 align="center">Comments</h3>
<?php

$tbl_name2="forumComment"; // Switch to table "forumPost"
$sql2="SELECT * FROM $tbl_name2 WHERE parentId='$id'";

$result2=mysqli_query($conn, $sql2);
while($rows=mysqli_fetch_assoc($result2)){
?>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td width="18%" bgcolor="#F8F7F1"><strong>ID</strong></td>
<td width="5%" bgcolor="#F8F7F1">:</td>
<td width="77%" bgcolor="#F8F7F1"><?php echo $rows['commentAuthor']; ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>Comment</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><?php echo nl2br($rows['commentText']); ?></td>
</tr>
<tr>
<td bgcolor="#F8F7F1"><strong>Date</strong></td>
<td bgcolor="#F8F7F1">:</td>
<td bgcolor="#F8F7F1"><?php echo $rows['commentDate']; ?></td>
</tr>
</table></td>
</tr>
</table><br>

<?php
}

$sql3="SELECT view FROM $tbl_name WHERE id='$id'";
$result3=mysqli_query($conn, $sql3);
//$rows=mysqli_fetch_assoc($result3);
$view=$rows['view'];

// if have no counter value set counter = 1
if(empty($view)){
$view=1;
$sql4="INSERT INTO $tbl_name(view) VALUES('$view') WHERE id='$id'";
$result4=mysqli_query($conn, $sql4);
}

// count more value
$addview=$view+1;
$sql5="update $tbl_name set view='$addview' WHERE id='$id'";
$result5=mysqli_query($conn, $sql5);
mysqli_close($conn);
?>

<BR>
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="postComment.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td valign="top"><strong>Comment</strong></td>
<td valign="top">:</td>
<td><textarea name="comment" cols="45" rows="3" id="a_answer"></textarea></td>
</tr>
<tr>
	<td valign="top"><strong>Member Id</strong></td>
	<td valign="top">:</td>
	<td><input type="text" name="userId" size="20"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="id" type="hidden" value="<?php echo $id; ?>"></td>
<td><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Submit2" value="Reset"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>

</body>
</html>

