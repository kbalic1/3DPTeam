<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>3D-Platforma</title>

    <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link rel="stylesheet" href="css/logo.css" type="text/css">

  


 
  
  
</head>

<body>
        
    <?php require_once("config.php"); ?>

    <?php require_once('nav.php') ?>

    <?php 
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    if(isset($_REQUEST['repliciraj']))
    {

        $idKomentara=$_REQUEST['idKomentara'];
        $idObjekta=$_REQUEST['idObj'];
        $datum = date("Y-m-d h:i:sa");
        $replika=$_REQUEST['replika'];

         if(isset($_SESSION['Username']))
         {

             $username=$_SESSION['Username'];
         }
         else {

            $username=null;
             
         }


         if(!is_null($username)){
                 $sql= "SELECT  `korisnikAcc_id` 
                FROM  `korisnikaccount` 
                WHERE  `username` =  '$username'";
                $result=$conn->query($sql);


                if ($result->num_rows > 0) {
                   
                    while($row = $result->fetch_assoc()) {
                        $autorReplikeID= $row["korisnikAcc_id"];
                    }
                }
            }else{
                $autorReplikeID=0;
            }


        $sql = "INSERT INTO replika (KomentarID,Tekst,AutorID,Vrijeme,Aktivan)
        VALUES ('$idKomentara', '$replika','$autorReplikeID','$datum' ,1)";

        if ($conn->query($sql) === TRUE) {

            echo '<div class="alert alert-info text-center">
            <strong>Obavijest</strong> Uspjesno ste komentarisali na post.
            </div>';

             header("Location:pregledModela.php?id=".$idObjekta);
            //return;

        }


    }


    if(isset($_REQUEST['komentarisi']))
    {
         $komentar=$_REQUEST['komentar'];

         $datum = date("Y-m-d h:i:sa");

        if(isset($_SESSION['Username']))
         {

             $username=$_SESSION['Username'];
         }
         else {

            $username=null;
             
         }
         
         $idObjekta=$_REQUEST['idObj'];

         if(!is_null($username)){
                 $sql= "SELECT  `korisnikAcc_id` 
                FROM  `korisnikaccount` 
                WHERE  `username` =  '$username'";
                $result=$conn->query($sql);


                if ($result->num_rows > 0) {
                   
                    while($row = $result->fetch_assoc()) {
                        $autorKomentaraID= $row["korisnikAcc_id"];
                    }
                }
            }else{
                $autorKomentaraID=0;
            }

         $sql = "INSERT INTO komentar (ObjekatID,Tekst,AutorID,Vrijeme,Aktivan)
        VALUES ('$idObjekta', '$komentar','$autorKomentaraID','$datum' ,1)";

        if ($conn->query($sql) === TRUE) {

            echo '<div class="alert alert-info text-center">
            <strong>Obavijest</strong> Uspjesno ste komentarisali na post.
            </div>';

            header("Location:pregledModela.php?id=".$idObjekta);

        }

    }

    if(isset($_GET["id"]))
    {
        $id = $_GET['id'];
        
    } else {

        $id=$idObjekta;
        
    }
    

    $sql ="SELECT  `Naziv`,`BrojPregleda`,`DatumObjave`,`Ocjena`, `KorisnikObjavioID`,`Aktivan`,`Opis`,`BrojNovihKomentara`,`SrcObjekat`,`MogucnostKomentara`
    FROM `objekat` 
    WHERE `ObjekatID` = '$id' ";

    $result1=$conn->query($sql);


    if ($result1->num_rows > 0) {
       
        while($row = $result1->fetch_assoc()) {
            $naziv= $row["Naziv"];
            $brPregleda=$row["BrojPregleda"];
            $datumObjave=$row["DatumObjave"];
            $ocjena=$row["Ocjena"];
            $korisnikID=$row["KorisnikObjavioID"];
            $aktivan=$row["Aktivan"];
            $opis=$row["Opis"];
            $brNovihKom=$row["BrojNovihKomentara"];
            $srcObj=$row["SrcObjekat"];
            $mogucnostKom=$row["MogucnostKomentara"];

        }

        if($aktivan==0){

            echo '<div class="alert alert-danger text-center">
            <strong>Obavijest</strong> Model kojem pokusavate pristupit je obrisan.
            </div>';
            return;
        }

    }
    else{

        echo '<div class="alert alert-danger text-center">
            <strong>Upozorenje</strong> Pristupa se modelu koji ne postoji.
            </div>';
            return;
       
    }

    $brNovihKom=0;

    $brPregleda= $brPregleda+1;

    $sql="UPDATE `objekat`
        SET `BrojPregleda`= \"$brPregleda\",`BrojNovihKomentara`=\"$brNovihKom\"
        WHERE `ObjekatID` = $id";

     $conn->query($sql);



   

    $sql ="SELECT  `ime`,`prezime`,`korisnikAccID`
    FROM `korisnik` 
    WHERE `korisnik_id` = '$korisnikID' ";

    $result1=$conn->query($sql);


    if ($result1->num_rows > 0) {
       
        while($row = $result1->fetch_assoc()) {
            $ime= $row["ime"];
            $prezime=$row["prezime"];
            $idkorisnika=$row["korisnikAccID"];

        }

    }
    else{

        
    }

   

    $sql = "SELECT `username` 
    from `korisnikaccount` 
    where `korisnikAcc_id`='$idkorisnika'";

      $result=$conn->query($sql);


      if ($result->num_rows > 0) {
         
          while($row = $result->fetch_assoc()) {

             $username= $row["username"];
            
          }
      }

      $putObj=$srcObj.".obj";
      $putMtl=$srcObj.".mtl";







    ?>
    
    <div id="putObj" hidden> <?php echo $putObj?></div>
    <div id="putMtl" hidden> <?php echo $putMtl?></div>   
        <div class="infoIModel">

               
              <div class="pregledModel" id="pregledModelDiv"> </div>

              <div class="infoModelDiv ">

                <ul class="list-group">
            <li class="list-group-item text-muted"> <?php echo $naziv ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Korisnik</strong></span><?php echo "<a href='profilKorisnika.php?username=".$username."'>".$ime." ".$prezime."</a>"?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Datum objave</strong></span> <?php echo $datumObjave ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Broj pregleda</strong></span> <?php echo $brPregleda ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Ocjena</strong></span> <?php echo $ocjena ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Opis</strong></span> <?php echo $opis ?></li>

          </ul> 

                 

             </div>
        </div>

              <hr class="ispod"/>
        
            <div class="komentariIPitanja" >


                    <div class="komentariModelaDiv">

            <?php if($mogucnostKom==1) { ?>

                 <a href="javascript:prikaziFormu()" id="ostaviKomentarPrikazi" class="btn btn-primary btn-xl page-scroll ">Ostavi komentar</a>

                <div class="well" id="ostaviKomentar" hidden>
                    <h4>Ostavite komentar:</h4>
                    <form class="form" action= "pregledModela.php" method="post">
                        <div class="form-group">
                            <textarea id="komentar" name="komentar" class="form-control" rows="3"></textarea>
                        </div>
                        <input id="idObj" name="idObj" value = '<?php echo $id?>' hidden> 
                        <button id="komentarisi" name="komentarisi" type="submit" class="btn btn-primary">Komentarisi</button>
                    </form>
                </div>

                <hr>

          
            <?php require_once('komentariPosta.php') ?>

            <?php 
                  } 
            else{
                       print "<lable> Komentari na ovom postu nisu omoguceni </label>";
            }

            ?>


            </div>

             <div class="pitanjaModelaDiv">

                <?php require_once('listaModelaPoKorisniku.php') ?>

             </div> 
                    </div>
                   
             

             
      


   


   
  
   

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; 3DTeam 2016</p>
                </div>
            </div>
        </footer>

    </div>


   


</body>

  <script src="js/jquery-1.11.3.min.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/three.min.js"></script>
<script src="js/MTLLoader.js"></script>
<script src="js/OBJMTLLoader.js"></script>
<script src="js/OrbitControls.js"></script>

    <script src="js/pregledModel.js"></script>

    <script type="text/javascript">


    function prikaziFormu () {


        var divFormeKomentar = document.getElementById("ostaviKomentar");
        var dugmePrikazi =   document.getElementById("ostaviKomentarPrikazi");


        if(divFormeKomentar.hidden)
        {
        dugmePrikazi.innerHTML = "Sakrij formu";
        divFormeKomentar.hidden=false;
        }
        else {
        dugmePrikazi.innerHTML = "Ostavi komentar";
        divFormeKomentar.hidden=true;

        }
      
    }



    </script>


</html>

