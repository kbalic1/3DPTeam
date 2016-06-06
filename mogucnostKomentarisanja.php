<?php 

	require_once("config.php"); 

	$vrijednost = $_REQUEST["mogucnost"];
	$objekatID = $_REQUEST["id"];



		
		$sql = "UPDATE objekat
		SET `MogucnostKomentara`= $vrijednost
		WHERE objekatID = '$objekatID'";
		


	if ($conn->query($sql) === TRUE) {
	    header("location: pregledModela.php?=".$objekatID);
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

?>
