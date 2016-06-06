<?php  session_start();  ?>

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
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/creative.css" type="text/css">
    <link rel="stylesheet" href="css/logo.css" type="text/css">

    <script src="js/three.js"></script>
    <script src="js/pozivniServis.js"></script>
    <script src="js/jquery-1.11.3.min.js"></script>

    <script type="text/javascript">

/*TESTNA METODA ZA PROVJERU RADA WEB SERVISA*/
function dobavi()
{
    var ajax = new XMLHttpRequest();

    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200)
        {

          console.log(ajax.responseText);

            //document.getElementById("brojTelefona").innerHTML = pozivniBrojDrzave + "/";
        }
            
        if (ajax.readyState == 4 && ajax.status == 404)
            alert("GREŠKA!!! Molimo pokušajte kasnije.");
            
    }
    ajax.open("GET", "modeliAutoraWebServis.php?UsernameAutora=kerimko&BrojModela=2", true);
    ajax.send();
}

dobavi();

</script>

        <!-- Izmjestiti u novi js fajl -->
    <script type="text/javascript">
    
        $(document).ready(function() 
        {
            $("#models").load("listaModela.php");  
        });

        function sortirajPoAbecedi()
        {
            $("#models").load("listaModela.php?sortirano=true");  
        }

        function sortirajPoDatumu()
        {
            $("#models").load("listaModela.php");  
        }

    </script>
  
</head>

<body>

    <?php require_once("config.php"); ?>

      <?php 

    $rola = 0;

    if(isset( $_SESSION["Username"])) {

    $usernameZaRolu = $_SESSION["Username"];
    $sql = "SELECT rolaID from korisnikaccount where username= '$usernameZaRolu'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $rola= $row["rolaID"];
            }

        }

    }


    ?>

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class=" navbar-brand  stage" >
                  <div class=" cube" >
                    <figure class="back"></figure>
                    <figure class="top"></figure>
                    <figure class="bottom"></figure>
                    <figure class="left"></figure>
                    <figure class="right"></figure>
                    <figure class="front"><div>3DP</div></figure>
                  </div>
                </div>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand page-scroll" href="index.php">3D Platforma</a>
            </div>
           

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
             
                    <?php

                         if(!isset($_SESSION['Username'])) {
                           
                        print(" <li>
                        <a class='page-scroll' href='signup.php'>SignUp</a>
                    </li>
                    ");
                            }

                           
                           

                     ?>

                      <?php 

                        if($rola==1){


                            print "
                                <li>
                                    <a class='page-scroll' href='admin.php'>Korisnici</a>
                                </li>
                                <li>
                                    <a class='page-scroll' href='adminModel.php'>Modeli</a>
                                </li>";





                        }
                     ?>
                    
                    <li>
                        <a class="page-scroll" href="tableAndLinks.php">Info</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="kontakt.php">Kontakt</a>
                    </li>
                       <?php

                         if(isset($_SESSION['Username'])) {
                            $username=$_SESSION['Username'];
                        print " <li  id='tdp_border' >";
                       
                            if($rola==0) {
                      print" <a class='username page-scroll' href='indexLogovan.php'>" .$_SESSION['Username']."</a>";
                         }     
                      else{

                             print" <a class='username page-scroll' href='admin.php'>" .$_SESSION['Username']."</a>";
                      }
                        print "</li>

                        <li>
                        <a class='page-scroll' href='logout.php'>LogOut</a>
                        </li>
                    ";
                            }

                           
                     ?>
                    
                    

                </ul>
            </div>
           
        </div>
        
    </nav>
    <div class="header-main">

        <div class="header-sadrzaj" >

              <div class="wellcomeModel" id="wellcomeModelDiv"> </div>
              <div class="infoDiv">

                <?php if(!isset($_SESSION["logon"])) { ?>

                 <p class="loginTekst">Prijavi se 3DP računom</p>
                 <button  id="login" class="btn btn-primary btn-xl page-scroll" data-toggle="modal" data-target="#myModal" >Prijavi se!</button>
                 <br/>
                 <p>ILI</p>
                  <a href="signup.php" id="signup" class="btn btn-primary btn-xl page-scroll">Registruj se!</a>
                  <p class="signUptekst">na najveću domaću 3D web platformu</p>

                  <?php } ?>

             </div>
              <hr class="ispod"/>
        </div>

        <div class="header-footer">
            <h2 > Prvi put ste ovdje? Kliknite na ovaj link za više detalja.</h2> 
            <a href="#"> 3D-Detaljnije</a>
        </div>


    </div>
    <div id="myModal" class="modal fade" role="dialog">
     <div class="modal-dialog">

    <!-- Modal content-->
        <div class="modal-content" id="tdp_loginModal">
    
            <div class="row">
                    <div class="col-md-1">
                    </div>

                    <div class="col-md-5 modal-body" style="display:inline-block;">
                       <form  novalidate action="provjeri.php" method="post">
                        <div class=" text-center">
                        
                            <div class="form-group">
                            <label for="InputName">Korisničko ime</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="username" id="InputName" placeholder="Unesite korisničko ime" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                            </div>
                            </div>
                          
                        <div class="form-group">
                            <label for="InputName">Šifra</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="InputPassFirst" name="password" placeholder="Unesite šifru" required>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                            </div>
                        </div>

                        <?php 
                           
                        if(isset($_SESSION['errorLogin'])) 
                           {


                                print "<p id='tdp_errorLoginStyle'><span>".$_SESSION["errorLogin"]."</span></p>";
                                
                                //$_SESSION["errorLogin"] = "";
                            } 

                        ?>

                        <a href="#">Zaboravili ste šifru?</a>
                       
                        <input type="submit" name="submit" id="submit" value="Prijavi se" class="btn btn-primary centered">
                         </div>
                         </form>

                     </div>
                     <div class="col-md-4 tdp_externalLogins" id="social-group" >       
                        
                            <div class="form-group">
                            <a class="btn btn-block btn-social btn-facebook facebookButton">
                                <span class="fa fa-facebook"></span>   Facebook
                            </a>  
                            <br/>
                            <br/>
                            <a class="btn btn-block btn-social btn-google googleButton" >
                                <span class="fa fa-google"></span> Google
                            </a>
                            </div>
                        
                    
                     </div>
                    <div class="col-md-2">
                    </div>
     
             </div>
        </div>

     </div>
    </div>

    <hr class="below"/>
    <div class="separation">

        Lista modela
    </div>
   <div class="modelsWrapper">
        <div id="filterLabel">Prikaz modela:</div>
            <div id="modelFilter">
                <ul id="ulFilter">
                    <!-- <li>Pozovi Servis<button type="button" onclick="dobavi()" /></li> --> <!-- TESTNO DGUME ZA SERVIS --> 
                    <li onclick="filterModels(this, 1)">Svi modeli</li>
                    <li onclick="filterModels(this, 2)">Današnji modeli</li>
                    <li onclick="filterModels(this, 3)">Modeli ove sedmice</li>
                    <li onclick="filterModels(this, 4)">Modeli ovog mjeseca</li>
                </ul>
            </div>
            <br />
            <div id="filterLabel">Sortiraj modele:</div>
            <div id="modelFilter">
                <ul id="ulFilter">
                    <li onclick="sortirajPoDatumu()">Po datumu objave</li>
                    <li onclick="sortirajPoAbecedi()">Abecedno</li>
                </ul>
            </div>
         <hr class="below"/>
        <div class="text-center" id="loading"><img src="img/loading_spinner.gif"></div>
            <div class="row modeli" id="models">

            </div>
    </div>

   
         

                <div class="exploreMore">

                    <a href="#" id="moreModels" class="btn btn-primary btn-xl page-scroll">Prikaži još</a>

                </div> 


               <!-- DROPDOWN IDE NA FORMU -->

                <!-- <div class="input-group-btn select" id="select1">
                    <button style="width:25%;" type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                    <span class="selected">Izaberite državu...</span> <span class="caret"></span></button>
                    <ul style="width:25%;" class="dropdown-menu option" role="menu">
                    <li value="ba"><a class="dda" href="#">Bosna i Hercegovina</a></li>
                    <li value="hr"><a class="dda" href="#">Hrvatska</a></li>
                    <li value="rs"><a class="dda" href="#">Srbija</a></li>
                    </ul>
                </div>

                <label id="brojTelefona"></label> -->

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


    <script src="js/wellcomeKocka.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/modelUploadDates.js" type="text/javascript"></script>


</body>



</html>

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

<?php 
        if(isset($_SESSION['errorLogin']))
        {
            if($_SESSION['errorLogin'] != "")
            {

                print "<script type='text/javascript'>  
                    $('#myModal').modal('show');
                    
               </script>";

               /*print "<script type='text/javascript'>  
                    $( document ).ready(function() {
                        $('#myModal').modal('show');
                    });
               </script>";*/
            }
        } 

       // session_destroy();
?>
