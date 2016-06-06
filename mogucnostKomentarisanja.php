<?php 

	require_once("config.php"); 

	$vrijednost = $_REQUEST["mogucnost"];
	$objekatID = $_REQUEST["id"];

	if(isset($_REQUEST["mogucnost"]))
	{
		if($_REQUEST["mogucnost"] == "true")
		{
				$sql = "UPDATE 3dpteam.objekat
				SET MogucnostKomentara=1
				WHERE objekatID = '$objekatID';";
		}
		else if($_REQUEST["mogucnost"] == "false")
		{
				$sql = "UPDATE 3dpteam.objekat
				SET MogucnostKomentara=0
				WHERE objekatID = '$objekatID';";
		}
	}

	if ($conn->query($sql) === TRUE) {
	    header("location: indexLogovan.php");
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
