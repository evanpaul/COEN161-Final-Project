<?php

$host = "dbserver.engr.scu.edu";
$user = "mwerner";
$password = "00001013261";
$db = "sdb_mwerner";

// Connect to db
$connection = mysqli_connect($host, $user, $password, $db);

//error case
if (!$connection)
{
  $error = 'Could not connect: ' . mysqli_error($connection);
  echo $error;
}

//get rows in random order
$sql="SELECT * FROM Products ORDER BY rand()";
$result = mysqli_query($connection, $sql);


// UPDATE mytablename SET columnname = value WHERE id = 0
// UPDATE mytable SET count = (count - 1) WHERE id = 0 LIMIT 1;

//store all rows into an assoc multidimentional array
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
