<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php
print("NESTO");
  session_start(); // Starting Session
  $error=''; // Variable To Store Error Message
  if (isset($_POST['submit'])) { 
  if (empty($_POST['username']) || empty($_POST['password'])) {
  $error = "Username or Password is invalid";
print_r ($error);
  }
  
  else
  {
  // Define $username and $password
  $username=$_POST['username'];
  $password=$_POST['password'];
  // To protect MySQL injection for Security purpose
 /* $username = stripslashes($username);
  $password = stripslashes($password);
  $username = mysql_real_escape_string($username);
  $password = mysql_real_escape_string($password);*/
  // Establishing Connection with Server by passing server_name, user_id and password as a parameter
  $connection = mysql_connect("localhost", "root", "","3dpteam");
  // Selecting Database
  $db = mysql_select_db("3dpteam", $connection);
  // SQL query to fetch information of registerd users and finds user match.
  $query = mysql_query("select * from korisnikAccount where password='$password' AND username='$username'", $connection);
  $rows = mysql_num_rows($query);
  if ($rows == 1) {
  $_SESSION['Username']=$username; 
  $_SESSION['logon'] = true;

  header("location: index.php"); // Redirecting To Other Page
  die();
  } else {
  $error = "Username or Password is invalid";
  }
  mysql_close($connection); // Closing Connection
  }
  }
 


?>
<body>
</body>
</html>