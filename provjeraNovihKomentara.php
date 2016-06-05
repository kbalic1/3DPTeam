<?php 
	session_start();
	$statusna = "pocetak";

	if(isset($_SESSION['logon']))
	{
		$statusna = "logovan";
		require_once("config.php");
    	mysqli_real_query($conn, "set names utf8;");


          $usernameUsera=$_SESSION['Username'];


            $sql= "SELECT  `korisnikAcc_id` 
            FROM  `korisnikaccount` 
            WHERE  `username` =  '$usernameUsera'";
            $result=$conn->query($sql);


            if ($result->num_rows > 0) {
               
                while($row = $result->fetch_assoc()) {
                    $IDUsera= $row["korisnikAcc_id"];
                }
            }



            $sql ="SELECT  `korisnik_id`
            FROM `korisnik` 
            WHERE `korisnikAccID` = '$IDUsera' AND Aktivan = 1 ";

            $result1=$conn->query($sql);


            if ($result1->num_rows > 0) {
               
                while($row = $result1->fetch_assoc()) {
                    $korisnikovIDUsera=$row["korisnik_id"];
                }

            }


     
	    $modeli = $conn->query("select Naziv, ObjekatID, BrojNovihKomentara from objekat where KorisnikObjavioID = '$korisnikovIDUsera';");
	     
	    if (!$modeli) 
	    {
	          $greska = $conn->errorInfo();
	          print "SQL greška: " . $greska[2];
	          exit();
     	}
     	else
     	{
     		$niz_novihKomentara = array();
     		
     		$i = 0;

     		foreach ($modeli as $model)
     		{
     			if($model["BrojNovihKomentara"] != 0)
     			{
     				$noviObjekat = new stdClass;
     				
     				$noviObjekat->ObjekatID = $model["ObjekatID"];
     				$noviObjekat->Naziv = $model["Naziv"];
					$noviObjekat->BrojNovihKomentara = $model["BrojNovihKomentara"];

     				//$noviObjekat = new { $model["ObjekatID"], $model["Naziv"], $model["BrojNovihKomentara"] };
     			 	$niz_novihKomentara[$i] = $noviObjekat;	
     			 	$i = $i + 1;
     			}
     		}
     		//return json_encode($niz_novihKomentara);
     	}
	}

	echo json_encode($niz_novihKomentara);
	//echo json_encode($arr);
	
?>