<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php require_once("config.php"); ?>

<?php


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


  $passwordHash = hash(md5,$password,false);

 

  $sql = "SELECT * from korisnikAccount where password='$passwordHash' AND username='$username'";

  $result=$conn->query($sql);


  if ($result->num_rows > 0) {
     
      while($row = $result->fetch_assoc()) {
         $_SESSION['Username']=$username; 
         $_SESSION['logon'] = true;
      }

      header("location: index.php"); // Redirecting To Other Page
      die();
  
  
  } else {
  $error = "Username or Password is invalid";
  }
  die();
  mysql_close($conn); // Closing Connection
  }
  }
 


?>
<body>
</body>
</html>