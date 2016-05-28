<?php 
	session_start();
	$statusna = "pocetak";

	if(isset($_SESSION['logon']))
	{
		$statusna = "logovan";
		require_once("config.php");
    	mysqli_real_query($conn, "set names utf8;");
     
	    $modeli = $conn->query("select Naziv, ObjekatID, BrojNovihKomentara from 3dpteam.objekat where KorisnikObjavioID = 3;");
	     
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