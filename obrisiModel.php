<?php 
session_start();

  require_once("config.php"); 



	$id=$_REQUEST["id"];

     if(isset( $_SESSION["Username"])) {

    $rola = 0;

    $usernameZaRolu = $_SESSION["Username"];
    $sql = "SELECT rolaID from korisnikaccount where username= '$usernameZaRolu'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $rola= $row["rolaID"];
        }
    }

  }

  if($rola==1){


$sql="UPDATE `objekat`
        SET `Aktivan`= false
        where ObjekatID='$id'";

$conn->query($sql);

}


?>