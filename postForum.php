<?php

$host = "dbserver.engr.scu.edu";
$username = "mwerner";
$password = "00001013261";
$db = "sdb_mwerner";

// Create connection
$conn = mysqli_connect($host, $username, $password, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$title = $_POST['title'];
$description = $_POST['description'];
$date = date("Y-m-d");
$user = $_POST['userId'];

$checkUserID = mysqli_query($conn, "SELECT * from Members WHERE Membid = '$user'");

if (!$checkUserID) {
    die('You are not a member');
}

if (mysql_num_rows($checkUserId) > 0) {

$sql = "INSERT INTO forumPost (postTitle, postDescription, postDate, postAuthor)
VALUES ('$title', '$description', '$date', '$user')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    echo '<a role="button" class"btn btn-primary" href="forum.php">Return to Forum Page </a>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

mysqli_close($conn);
?>
