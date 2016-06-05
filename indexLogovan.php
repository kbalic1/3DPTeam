
 <?php session_start(); if(isset($_SESSION['logon'])) { ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>3D-Platforma</title>

    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link rel="stylesheet" href="css/logo.css" type="text/css">

     <script src="js/pozivniServis.js"></script>
     <script src="js/jquery-1.11.3.min.js"></script>

     <script src="js/provjeraNotifikacija.js"></script>

    <link rel="stylesheet" href="css/main.css" type="text/css">

</head>

<body >


<?php require_once("config.php"); ?>

<?php require_once('nav.php') ?>


<?php   



$username_k=$_SESSION['Username'];

$sql= "SELECT  `korisnikAcc_id` 
FROM  `korisnikaccount` 
WHERE  `username` =  '$username_k' ";
$result=$conn->query($sql);

$ID=0;

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $ID= $row["korisnikAcc_id"];
    }
}




$sql ="SELECT  `ime`,`prezime`,`datum`,`mail`,`korisnik_id`,`BrojTelefona`
FROM `korisnik` 
WHERE `korisnikAccID` = '$ID' ";

$result1=$conn->query($sql);


if ($result1->num_rows > 0) {
   
    while($row = $result1->fetch_assoc()) {
        $ime = "";
        $prezime = "";

        $ime= $row["ime"];
        $prezime=$row["prezime"];
        $datumStr=$row["datum"];
        $mail=$row["mail"];
        $korisnikovID=$row["korisnik_id"];
        $brojTelefona=$row["BrojTelefona"];
        $datum = strtotime($datumStr);

    }

}



if(isset($_REQUEST['spasi']))
{

  $novoIme=$_REQUEST['ime'];
  $novoPrezime=$_REQUEST['prezime'];
  $noviMail=$_REQUEST['email'];
  $noviBrojTelefona=$_REQUEST['brojTelefona'];
  

  $nizIme = str_split($novoIme);
  $nizPrezime = str_split($novoPrezime);
  $nizEmail = str_split($noviMail);
  $nizBrojTel = str_split($noviBrojTelefona);

  for($i=0;$i<strlen($novoIme);$i++)
  {

      if($nizIme[$i]=="<" || $nizIme[$i]==">")
       { header("location: erorrValidacija.php"); return; }

  }

  for($i=0;$i<strlen($novoPrezime);$i++)
  {

      if($nizPrezime[$i]=="<" || $nizPrezime[$i]==">")
       {header("location: erorrValidacija.php"); return; }

  }

  for($i=0;$i<strlen($novoPrezime);$i++)
  {

      if($nizEmail[$i]=="<" || $nizEmail[$i]==">")
       { header("location: erorrValidacija.php"); return; }

  }


  $sql="UPDATE `korisnik`
        SET `ime`= \"$novoIme\",`prezime`=\"$novoPrezime\",`mail`=\"$noviMail\", `BrojTelefona` = \"$noviBrojTelefona\"
        WHERE `korisnikAccID` = $ID";

  $conn->query($sql);
  
}

if(isset($_REQUEST['spasiPassword']))
{


  $noviPassword=$_REQUEST['password'];

  $hashPassworda = hash(md5,$noviPassword,false);

   $sql="UPDATE `korisnikaccount`
        SET `password`= \"$hashPassworda\"
        WHERE `korisnikAcc_ID` = $ID";

  $conn->query($sql);
  
}

?>

<div id="notifikacije">
</div>

<div class="container bootstrap snippet">
    <div class="row">  

        <div class="col-sm-10"><h1><?php echo $_SESSION['Username']; ?></h1></div>

        <div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a></div>
    </div>
    <div class="row">
        <div class="col-sm-3"><!--left col-->
              
          <ul class="list-group">
            <li class="list-group-item text-muted">Osnovne informacije</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Registrovan</strong></span><?php echo date('d.m.Y.',$datum); ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Zadnji put online</strong></span> Jučer</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Ime i Prezime</strong></span><span><p><?php echo $ime; echo " "; echo $prezime ?></p></span></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Broj telefona</strong></span><span><p><?php echo $brojTelefona; ?></p></span></li>
            
          </ul> 
               
          <!--<div class="panel panel-default">
            <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
          </div>-->

          <?php

           $modeli = $conn->query("select Count(*) from objekat where KorisnikObjavioID= '$korisnikovID' AND Aktivan=1 order by DatumObjave DESC;");

           if ($modeli->num_rows > 0) {
                   
                    while($row = $modeli->fetch_assoc()) {
                        $brojModela= $row["Count(*)"];
                    }
                }
          ?>
          
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Aktivnost <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Uploada</strong></span> <?php echo $brojModela?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Odgovora</strong></span> /</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Tema</strong></span> /</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Pratitelja</strong></span> /</li>
          </ul> 
               
          <!--<div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
                <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div>-->
          
        </div><!--/col-3-->
        <div class="col-sm-9">
          
          <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#home" data-toggle="tab">Modeli</a></li>
            <li><a href="#messages" data-toggle="tab">Diskusije</a></li>

            <li><a href="#settings" data-toggle="tab">Licni podaci</a></li>
            <li><a href="#pass" data-toggle="tab">Promjena passworda</a></li>
          </ul>
                 

           
          </ul>
              

          <div class="tab-content">
            <div class="tab-pane active" id="home">
              <div class="table-responsive">

                   <button  id="dugmeDodaj" class="btn btn-primary btn-xl page-scroll" data-toggle="modal" data-target="#myModalUpload" >+ Dodaj novi model</button>
                   
                    <div class="row modeli" id="models">

                    <?php require_once('modeliKorisnik.php') ?>

                  </div>


                <hr>
                
              </div><!--/table-resp-->
              
              <hr>
              
             </div><!--/tab-pane-->
             <div class="tab-pane" id="messages">
               
               <h2></h2>
               
               <ul class="list-group">
                  <li class="list-group-item text-muted">Topics</li>
                  <li class="list-group-item text-right"><a href="#" class="pull-left">Lore ipsum lit dolore is ipnet em a latin vukus simper partis</a> 2.13.2014</li>
                  <li class="list-group-item text-right"><a href="#" class="pull-left">Lore ipsum lit dolore is ipnet em a latin vukus simper partis</a> 2.11.2014</li>
                  <li class="list-group-item text-right"><a href="#" class="pull-left">Lore ipsum lit dolore is ipnet em a latin vukus simper partis</a> 2.11.2014</li>
                  <li class="list-group-item text-right"><a href="#" class="pull-left">Lore ipsum lit dolore is ipnet em a latin vukus simper partis</a> 2.11.2014</li>
                  <li class="list-group-item text-right"><a href="#" class="pull-left">Lore ipsum lit dolore is ipnet em a latin vukus simper partis</a> 2.11.2014</li>
                  <li class="list-group-item text-right"><a href="#" class="pull-left">Lore ipsum lit dolore is ipnet em a latin vukus simper partis</a> 2.11.2014</li>
                  <li class="list-group-item text-right"><a href="#" class="pull-left">Lore ipsum lit dolore is ipnet em a latin vukus simper partis.</a> 2.11.2014</li>
                  <li class="list-group-item text-right"><a href="#" class="pull-left">Lore ipsum lit dolore is ipnet em a latin vukus simper partis</a> 2.11.2014</li>
                  
                </ul> 
               
             </div><!--/tab-pane-->

            

              <div class="tab-pane" id="settings">             <!-- Validaciju odradit za ovo ovde-->
                    
                
                  <hr>
                  <div class="row">

                  <div class="col-md-2"></div>

                  <form novalidate class="form col-md-8" action="indexLogovan.php" method="post" id="registrationForm" onsubmit="return validate()">
                      <div class="form-group">
                          
                          <div class="col-xs-12">
                              <label for="first_name"><h4>Ime</h4></label>
                              <input type="text" class="form-control" name="ime" id="first_name" value='<?php echo $ime ?>' title="Unesite vaše ime.">
                              <label id="validacijaIme" class="textValidacija"></label>
                          </div>
                             
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-12">
                            <label for="last_name"><h4>Prezime</h4></label>
                              <input type="text" class="form-control" name="prezime" id="last_name" value='<?php echo $prezime ?>' title="Unesite vaše prezime.">
                              <label id="validacijaPrezime" class="textValidacija"></label>
                          </div>
                      </div>
          
                      
                      <div class="form-group">
                          
                          <div class="col-xs-12">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" value='<?php echo $mail ?>' title="Unesite vaš email.">
                              <label id="validacijaEmail" class="textValidacija"></label>
                          </div>
                      </div>
                       
                      <div class="form-group">
                        <label for="telphone_number"><h4>Broj telefona</h4></label>
                        <div class="row">
                          <div class="input-group-btn">
                              <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                              <span>Izaberite državu...</span> <span class="caret"></span></button>
                              <ul class="dropdown-menu option" role="menu">
                              <li value="ba"><a class="dda" href="#">Bosna i Hercegovina</a></li>
                              <li value="hr"><a class="dda" href="#">Hrvatska</a></li>
                              <li value="rs"><a class="dda" href="#">Srbija</a></li>
                              </ul>
                          </div>
                          <!--  <label id="brojTelefona"></label>-->
                       
                        <div class="col-sm-6">
                              <input type="text" class="form-control" name="brojTelefona" id="brojTelefona" title="Unesite vaš broj.">
                              <label id="" class="textValidacija"></label>
                          </div>

                        </div>


                    </div>

                
                     
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                                
                                <button  id="spasi" name="spasi" type="submit" class="btn btn-primary btn-xl page-scroll"  >Spasi</button>
                            </div>
                      </div>
                </form>
                      <div class="col-md-2"></div>
                 </div>
              </div>
               <div class="tab-pane" id="pass">             <!-- Validaciju odradit za ovo ovde-->
                    
                
                  <hr>
                  <form class="form" action="indexLogovan.php" method="post" id="registrationForm">
                      <div class="form-group">
                          
                          <div class="col-xs-6 ">
                              <label for="password"><h4>Password</h4></label>
                              <input type="password" class="form-control" name="password" id="password" placeholder="" title="enter your password.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="password2"><h4>Potvrdi password</h4></label>
                              <input type="password" class="form-control" name="password2" id="password2" placeholder="" title="enter your password2.">
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                                
                                <button   name="spasiPassword" type="submit" class="btn btn-primary btn-xl page-scroll"  >Spasi</button>
                            </div>
                      </div>
                </form>
              </div>
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->

<div id="myModalUpload" class="modal fade" role="dialog">
     <div class="modal-dialog">



    <!-- Modal content-->
        <div class="modal-content" id="tdp_uploadModal">

          <div class = "modal-header text-center"> OBJAVITE VAS NOVI MODEL!</div>
    
            <div style="margin:5% 0 0 10%;">

                    
                     <div class="col-md-6">

                          <label class = "slikaUpload">Odaberite sliku Vaseg modela: </label>
                          <label class = "objekatUpload">Odaberite Vas model (.obj i .mtl): </label>
                          <label class = "objekatUpload">Selektirajte teksture Vaseg modela </label>

                          <label class = "nazivUpload">Unesite naziv modela</label>
                          <label class = "nazivUpload">Unesite opis modela</label>
                          <label class = "mogucnostKomentara">Mogucnost komentarisanja</label>


                    </div>
                     <div class="col-md-6">

                      <form novalidate action="upload.php" method="post" enctype="multipart/form-data" onsubmit="return validateNoviModel()">

                        <input class="slikaUpload" type="file" name="fileToUpload" id="fileToUploadImg">
                        
                
                         <input class="objekatUpload" type="file" name="fileToUploadObj" id="fileToUploadObj">
                         <input class="objekatUpload1" type="file" name="fileToUploadObj1" id="fileToUploadObj1">

                         <input id='upload' name="upload[]" class="objekatUpload" type="file" multiple="multiple" />


               
                        
                        <div class="form-group tdp_form_group_upload nazivUpload">
                           
                            <div class="input-group ">

                                <input type="text" class="form-control" name="nazivModela" id="nazivModela" placeholder="Naziv modela"  >
                                <label id="validacijaNazivModela" class="textValidacija"></label>

                                
                            </div>
                             <label id="validacijaUsername" class="textValidacija "></label>
                        </div>

                          <textarea id='opisModela' name='opisModela' class='form-control tdp_opis' rows='3'></textarea>

                           <input type="checkbox" name="mogucnostKomentara" id="mogucnostKomentara" value="" checked>
                       
                        <input type="submit" name="submit" id="submit" value="Objavi" class="btn btn-primary centered tdp_button_margin ">
                    
                </form>

                    </div>
                    
                        

                     
     
             </div>


        </div>

     </div>
    </div>
                         

<?php include('footer.php') ?>


   
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/validacijaUnosaLicnihPodataka.js"></script>


</body>
  

</script>


    <script type="text/javascript">

    $('a.dda').click(function(e)
{
    e.preventDefault();
});

        $('body').on('click','.option li',function(){
        var dvoslovniKod = $(this).attr('value');
        dobaviPozivniBroj(dvoslovniKod);

});
        
        
    </script>




</html>
<?php  } else header("Location:index.php"); ?>

