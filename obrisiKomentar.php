<?php 

	//print ($_REQUEST["id"]);
	require_once("config.php"); 

	if(isset($_REQUEST["id"]))
	{
		$idKomentara = $_REQUEST["id"];

		$sql = "UPDATE 3dpteam.komentar
		SET Aktivan=0
		WHERE Komentar_id = '$idKomentara';";
	}

	if ($conn->query($sql) === TRUE) {
		echo "OK";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

?>