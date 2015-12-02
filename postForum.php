<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "forum";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$title = $_POST['title'];
$description = $_POST['description'];
$date = date("Y-m-d");

$sql = "INSERT INTO forumPost (postTitle, postDescription, postDate)
VALUES ('$title', '$description', '$date')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    echo '<a role="button" class"btn btn-primary" href="forum.php">Return to Forum Page </a>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
