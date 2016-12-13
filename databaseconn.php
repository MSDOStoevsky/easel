<?php
$servername = "localhost";
$schema = "easel";
$username = "root";
$password = "20004132Bds";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $schema);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}