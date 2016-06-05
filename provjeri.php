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
  $error = "Korisnički podaci nisu ispravni! Pokušajte ponovno.";
    
    $_SESSION["errorLogin"] = $error;
        header("Location: indexGost.php");

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

      header("location: index.php"); 
      die();
  
  
  } else {
    $error = "Korisnički podaci nisu ispravni! Pokušajte ponovno.";
    
    session_start();
    $_SESSION["errorLogin"] = $error;
    header("Location: indexGost.php");
  }
  die();
  mysql_close($conn); // Closing Connection
  }
  }
 


?>
<body>
</body>
</html>