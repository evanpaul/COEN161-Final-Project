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
$result = "SELECT * FROM Members WHERE Membid = '$user'";

$check = mysqli_query($conn, $result);
$rows = mysqli_num_rows($check);

if($rows > 0) {

    $row = mysqli_fetch_assoc($check);
    $user = $row['name'];
    $sql = "INSERT INTO forumPost (postTitle, postDescription, postDate, postAuthor)
    VALUES ('$title', '$description', '$date', '$user')";

    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully <br>";
      echo '<a role="button" class"btn btn-primary" href="forum.php">Return to Forum Page </a>';
    }
    else
    {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

else
{
  echo 'You are not a member <br>';
  echo '<a role="button" class"btn btn-primary" href="forum.php">Return to Forum Page </a>';
}

mysqli_close($conn);
?>
