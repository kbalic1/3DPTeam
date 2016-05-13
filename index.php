<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php

if (!session_id()) session_start();
if ($_SESSION['logon']){ 

  
    header("Location:indexLogovan.php");
    die();
        
}
else
{
  header("Location:index.html");
}
 

	/*  echo '<script>';
	echo ' alert("'
.$_SESSION['Username'].'")';
echo '</script>';
?>*/


?>
<body>
</body>
</html>