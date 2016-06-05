<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>


<?php require_once("config.php"); ?>

<?php

$sql= "SELECT  `brojPosjeta` 
FROM  `administracija` 
WHERE  `ID` =  1";
$result=$conn->query($sql);


if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $broj= $row["brojPosjeta"];
    }
}

$broj=$broj+1;

  $sql="UPDATE `administracija`
        SET `brojPosjeta`= \"$broj\"
        WHERE `ID` = 1";

  $conn->query($sql);


if (!session_id()) session_start();
if ($_SESSION['logon']){ 

  
    header("Location:indexGost.php");
    die();
        
}
else
{
  header("Location:indexGost.php");
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