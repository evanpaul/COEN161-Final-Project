<?php
//something that i purposfully left out is how to grab the username of the person that posted it
//and put that into the database. The reason that I left this out is because i did not know how you 
//guys were storing it. i will ask you guys and put the finishing touches on it.

$servername = "dbserver.engr.scu.edu";
$username = "mwerner";
$password = "00001013261";
$dbname = "sdb_mwerner";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$title = $_POST['title'];
$description = $_POST['description'];
$date = date("Y-m-d");
$code = $_POST['code'];

$sql = "INSERT INTO forumPost (postTitle, postDescription, postDate, postAuthor) 
VALUES ('$title', '$description', '$date', '$code')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    echo '<a role="button" class"btn btn-primary" href="forum.php">Return to Forum Page </a>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>

