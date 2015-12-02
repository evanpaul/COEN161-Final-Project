<?php
//something that i purposfully left out is how to grab the username of the person that posted it
//and put that into the database. The reason that I left this out is because i did not know how you
//guys were storing it. i will ask you guys and put the finishing touches on it.

$host = "dbserver.engr.scu.edu";
$user = "mwerner";
$password = "00001013261";
$db = "sdb_mwerner";

// Create connection
$conn = mysqli_connect($host, $user, $password, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$parentId = $_POST['id'];
$comment = $_POST['comment'];
$date = date("Y-m-d");

$sql = "INSERT INTO forumComment (parentId, commentText, commentDate)
VALUES ('$parentId', '$comment', '$date')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    echo '<a role="button" class"btn btn-primary" href="forum.php">Return to Forum Page </a>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>
