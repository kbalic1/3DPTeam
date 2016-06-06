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
  
$ID=0;

  $sql="SELECT korisnikAccID from korisnik where korisnik_id='$id'";
  $result = $conn->query($sql);


  if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $ID= $row["korisnikAccID"];
    }
}

$sql="UPDATE `korisnik`
        SET `Aktivan`= \"0\"
        where korisnik_id='$id'";

$conn->query($sql);

$sql="UPDATE `korisnikaccount`
        SET `Aktivan`= \"0\"
        where korisnikAcc_id='$ID'";


$conn->query($sql);

}




?>