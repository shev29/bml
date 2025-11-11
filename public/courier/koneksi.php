<?php
$servername = "bmldev.logisteed.id";
$userdb = "bmldev";
$password = "G5S1LMQ4VHQ1";
$dbname = "bml_courier";

// Create connection
$conn = new mysqli($servername, $userdb, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>