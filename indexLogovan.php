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
  

</head>

<body >

<?php include('nav.php') ?>

<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3dpteam";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

$username_k=$_SESSION['Username'];

$sql= "SELECT  `korisnikAcc_id` 
FROM  `korisnikaccount` 
WHERE  `username` =  '$username_k' ";
$result=$conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $ID= $row["korisnikAcc_id"];
    }
}



$sql ="SELECT  `ime`,`prezime`,`datum`,`mail`
FROM `korisnik` 
WHERE `korisnikAccID` = '$ID' ";

$result1=$conn->query($sql);


if ($result1->num_rows > 0) {
   
    while($row = $result1->fetch_assoc()) {
        $ime= $row["ime"];
        $prezime=$row["prezime"];
        $datum=$row["datum"];
        $mail=$row["mail"];

    }
}





?>


<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10"><h1><?php echo $_SESSION['Username']; ?></h1></div>
        <div class="col-sm-2"><a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a></div>
    </div>
    <div class="row">
        <div class="col-sm-3"><!--left col-->
              
          <ul class="list-group">
            <li class="list-group-item text-muted">Osnovne informacije</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Registrovan</strong></span><?php echo $datum ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Zadnji put online</strong></span> Juce</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Ime i Prezime</strong></span> <?php echo $ime; echo " "; echo $prezime ?></li>
            
          </ul> 
               
          <!--<div class="panel panel-default">
            <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
            <div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
          </div>-->
          
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Aktivnost <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Uploada</strong></span> 125</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Odgovora</strong></span> 13</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Tema</strong></span> 37</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Pratitelja</strong></span> 78</li>
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
            <li><a href="#settings" data-toggle="tab">Postavke</a></li>
          </ul>
              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
              <div class="table-responsive">

                    MODELI

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
             <div class="tab-pane" id="settings">
                    
                
                  <hr>
                  <form class="form" action="##" method="post" id="registrationForm">
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>Ime</h4></label>
                              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="" title="enter your first name if any.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Prezime</h4></label>
                              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="" title="enter your last name if any.">
                          </div>
                      </div>
          
                      
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Email</h4></label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="example@email.com" title="enter your email.">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="email"><h4>Lokacija</h4></label>
                              <input type="email" class="form-control" id="location" placeholder="" title="enter a location">
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
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
                                <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Spasi</button>
                                
                            </div>
                      </div>
                </form>
              </div>
               
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
                         

<?php include('footer.php') ?>


   
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>



</body>



</html>