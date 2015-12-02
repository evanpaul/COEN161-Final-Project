<!DOCTYPE HTML>
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
        <a id="logo" href = "index.html" class="navbar-brand"><object width="50" height ="50"type="image/svg+xml" data="logo1.svg"></object></a>
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
<div class="forum-header">
<h1 id="forum-title">Forums</h1>
<h4 id="forum-discrip">This is a place for members to talk about anything they would like to share about recycling</h4>
</div>

<div id="forum-list">
	<?php

$host="dbserver.engr.scu.edu"; // Host name
$username="mwerner"; // Mysql username
$password="00001013261"; // Mysql password
$db_name="sdb_mwerner"; // Database name
$tbl_name="forumPost"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");
$sql="SELECT * FROM $tbl_name ORDER BY postId ASC";
// OREDER BY id DESC is order result by descending

$result=mysql_query($sql);
?>

<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td width="6%" align="center" bgcolor="#E6E6E6"><strong>#</strong></td>
<td width="53%" align="center" bgcolor="#E6E6E6"><strong>Topic</strong></td>
<td width="15%" align="center" bgcolor="#E6E6E6"><strong>ID</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Date</strong></td>
</tr>

<?php

// Start looping table row
while($rows=mysql_fetch_array($result)){
?>
<tr>
<td bgcolor="#FFFFFF" align="center"><? echo $rows['postId']; ?></td>
<td bgcolor="#FFFFFF" align="center"><a href="view_topic.php?id=<? echo $rows['postId']; ?>"><? echo $rows['postTitle']; ?></a><BR></td>
<td align="center" bgcolor="#FFFFFF"><? echo $rows['postAuthor']; ?></td>
<td align="center" bgcolor="#FFFFFF"><? echo $rows['postDate']; ?></td>
</tr>

<?php
// Exit looping and close connection
}
mysql_close();
?>

<tr>
<td colspan="5" align="right" bgcolor="#E6E6E6"><a href="postForum.html"><strong>Create New Topic</strong> </a></td>
</tr>
</table>
</div>

</body>
</html>
