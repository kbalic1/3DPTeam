<?php 
session_start();

  require_once("config.php"); 



	$id=$_REQUEST["id"];

  
$ID=0;

  $sql="SELECT korisnikAccID from korisnik where korisnik_id='$id'";
  $result = $conn->query($sql);


  if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $ID= $row["korisnikAccID"];
    }
}

	  $sql="DELETE from korisnik where korisnik_id='$id'";

      if ($conn->query($sql) === TRUE) {
          
           
          
        }

         $sql="DELETE from korisnikaccount where korisnikAcc_id='$ID'";

      if ($conn->query($sql) === TRUE) {
          
          // header("location: admin.php");
          
        }




?>