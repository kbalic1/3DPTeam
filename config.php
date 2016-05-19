<?php

/*
$servername = "localhost";
$username = "wtuser";
$password = "passWt!123";
$dbname = "3dpteam";*/

$servername = "127.6.241.130";
$username = "adminnNICk35";
$password = "bBiYhDrUQmFA";
$dbname = "3dpteam";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



?>