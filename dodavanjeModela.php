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
  

</head>

<body >

<?php require_once("config.php"); ?>

<?php require_once('nav.php') ?>



<div class="unosModelaPodaci">

 <form novalidate  action=" register.php" method="post" onsubmit="return validate()" >

               

                    <div class="col-lg-4 col-lg-offset-4 text-center">
                        
                        <div class="form-group tdp_form_group">
                            <label >Unesite naziv modela</label>
                            <div class="input-group ">

                                <input type="text" class="form-control" name="username" id="username" placeholder="Naziv modela"  >


                                
                            </div>
                             <label id="validacijaUsername" class="textValidacija "></label>
                        </div>
                       
                        <input type="submit" name="submit" id="submit" value="Registruj se" class="btn btn-primary centered tdp_button_margin ">
                    </div>
                </form>

                <form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</div>

<?php include('footer.php') ?>


   
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>



</body>



</html>
<?php } else header("Location:index.html"); ?>