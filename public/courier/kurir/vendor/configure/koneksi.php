<?php
$servername = "localhost";
$userdb = "u7195330_bmlcourier";
$password = "Densus-378";
$dbname = "u7195330_bmlcourier";


// Create connection
$conn = new mysqli($servername, $userdb, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>