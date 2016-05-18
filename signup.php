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
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link rel="stylesheet" href="css/signup.css" type="text/css">
    <link rel="stylesheet" href="css/logo.css" type="text/css">
   
    <!-- <script src="fonts/mojfont.js"></script> -->

</head>

<body id="page-top">
 <?php include('nav.php') ?>


  

    <section id="signup">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Registrujte se!</h2>
                    <hr class="primary">
                    <p>Ukoliko niste registrovani ovdje se možete registrovati besplatno!</p>
                </div>
        </div>
        <div class="container">
            <div class="row">

                <form novalidate  action=" register.php" method="post" onsubmit="return validate()" >

               

                    <div class="col-lg-4 col-lg-offset-4 text-center">
                        <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Obavezna polja</strong></div>
                        <div class="form-group tdp_form_group">
                            <label >Unesite korisničko ime</label>
                            <div class="input-group ">

                                <input type="text" class="form-control" name="username" id="username" placeholder="Unesite korisničko ime"  >


                                <span class="input-group-addon"  ><span class="glyphicon glyphicon-asterisk"></span></span>  
                            </div>
                             <label id="validacijaUsername" class="textValidacija "></label>
                        </div>
                        <div class="form-group tdp_form_group">
                            <label >Unesite Email</label>
                            <div class="input-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Unesite Email" onkeyup="checkFilled();">
                                 
                                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                            </div>
                            <label id="validacijaEmail" class="textValidacija"></label>
                        </div>  
                        <div class="form-group tdp_form_group">
                            <label >Kreirajte šifru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password1" name="password1" placeholder="Unesite šifru" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password mora sadržavat minimalno 8 karaktera jedno veliko slovo i broj.">
                                 
                                <span class="input-group-addon" ><span class="glyphicon glyphicon-asterisk"></span></span>
                                 
                            </div>
                           <label id="validacijaPassword1" class="textValidacija"></label>
                                
                            
                           
                        </div>
                        <div class="form-group tdp_form_group">
                            <label >Ponovite šifru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password2" name="password2" onkeyup="javascript:provjeriPass()" placeholder="Potvrdite šifru" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password mora sadržavat minimalno 8 karaktera jedno veliko slovo i broj." >
                                 
                                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                            </div>
                            <label id="validacijaPassword2" class=" textValidacija"></label>
                        </div>
                        <input type="submit" name="submit" id="submit" value="Registruj se" class="btn btn-primary centered tdp_button_margin ">
                    </div>
                </form>


              <!--  <form >
                    <div class="col-lg-4 col-lg-offset-4 text-center" id="social-group">
                        <div class="form-group">
                        <a class="btn btn-block btn-social btn-facebook facebookButton">
                            <span class="fa fa-facebook"></span> Sign in with Facebook
                        </a>
                        <a class="btn btn-block btn-social btn-google googleButton" >
                            <span class="fa fa-google"></span> Sign in with Google
                        </a>

                        

                        </div>
                    </div>
                </form>
            -->

            </div>
        </div>
            </div>
       
    </section>
    <?php include('footer.php') ?>


  <script src="js/signUpValidation.js"></script>



</body>
</html>
