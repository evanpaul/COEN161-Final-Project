<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css">
<?php
$host = "localhost";
$user = "root";
$password = "root";
$db = "Test";
// Assumes database format:
// Members(membID, name, email) [I've been using VARCHAR(30) for all columns]
$error;
// Check for blank fields
if($_POST['name'] == '' || $_POST['email'] == ''){
  $error = "Do not leave any fields blanks!";
}
// Connect to DB and connect
$connection = mysqli_connect($host, $user, $password, $db);
if (!$connection) {
  $error = 'Could not connect: ' . mysqli_error($connection);
}

// Generate the most cryptograhpically insecure Member ID imaginable
// (a careful dictionary attack could probably crack this in less than a minute)
// But hey, this is Web Dev, not Cryptography.
$membID = mb_strtoupper(substr($_POST['name'], 0, 4));
$membID .= dechex(mt_rand(10000, 99999));
$membID = substr($membID, 0, 8);

// SQL Escapes
$membID = mysql_real_escape_string($membID);
$name = mysql_real_escape_string($_POST['name']);
$email = mysql_real_escape_string($_POST['email']);
$statement = "INSERT INTO `Members` (`membID`, `name`, `email`)
VALUES ('$membID', '$name', '$email')";

// Try to insert into table
if(!isset($error)){
  $result = $connection->query($statement);
  if (!$result){
    $error = 'Error: ' . mysqli_error($connection);
  }
}

// If an error occurred, display the error message
if(isset($error)){
  ?>
  <div class="alert alert-dismissible alert-danger">
    <strong><?=$error?></strong><br>
  </div>
  <?php
}
// Otherwise, alert success and return the Member ID
else{
  ?>
  <div class="alert alert-dismissible alert-success">
    <strong>Successfully registered:</strong><br>
    <?php
    echo "<strong>Name: </strong>", $name, "<br>";
    echo "<strong>Email: </strong>", $email, "<br>";
    ?>
  </div>
  <div class="alert alert-dismissible alert-info">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Hey!</strong> You'll need to make note of your member ID, it will function as your password.<br>
    <strong>Member ID: </strong><?=$membID?>
  </div>
  <?php
}
?>
<a href="index.html" class="btn btn-link">Back home</a>
<a href="register.html" class="btn btn-link">Back to registration</a>

<?php
// Close database connection
mysqli_close($connection);
?>
