
 <?php session_start(); if(isset($_SESSION['logon'])) {

   require_once("config.php"); 

   if(isset( $_SESSION["Username"])) {

    $rola = 0;

    $usernameZaRolu = $_SESSION["Username"];
    $sql = "SELECT rolaID from korisnikaccount where username= '$usernameZaRolu'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $rola= $row["rolaID"];
        }
    }

  }

  if($rola==1){

  ?>


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

     <script src="js/jquery-1.11.3.min.js"></script>

    <link rel="stylesheet" href="css/main.css" type="text/css">

</head>

<body >




<?php require_once('nav.php') ?>

<?php
         


          if(isset($_POST["submitNovi"]))
          {

              $ime=$_POST["ime"];
              $prezime=$_POST["prezime"];
              $brojTel=$_POST["telefon"];
              $username=$_POST["username"];
              $password=$_POST["password"];
              $email=$_POST["email"];
              $id=$_POST["id"];


              if($id==0)
              {         
                      $passwordHash = hash(md5,$password,false);

                      $sql="INSERT INTO korisnikaccount (username, password, rolaID,Aktivan)
                      VALUES('$username','$passwordHash',0,1)";

                      $conn->query($sql);

                      $sql="SELECT korisnikAcc_id from korisnikaccount where username = '$username'";
                      $result=$conn->query($sql);

                        if ($result->num_rows > 0) {
                       
                        while($row = $result->fetch_assoc()) {
                            $korisnikAccID= $row["korisnikAcc_id"];
                                }

                            }

                        $datum = date("Y.m.d");

                        $sql = "INSERT INTO korisnik (ime,prezime,BrojTelefona,datum,mail,korisnikAccID,Aktivan)
                  VALUES ('$ime', '$prezime','$brojTel' ,'$datum','$email', '$korisnikAccID',1)";


                  if ( $conn->query($sql) === TRUE) {
                  header("location: admin.php");
                  } 
               }
               else{

                        $sql="SELECT korisnikAccID from korisnik where korisnik_id='$id'";
                        $result = $conn->query($sql);


                        if ($result->num_rows > 0) {
                         
                          while($row = $result->fetch_assoc()) {
                              $korisnikAccID= $row["korisnikAccID"];
                          }
                      }

                      if($password=="")
                      {
                     

                        $upit = "UPDATE  korisnikaccount
                        SET username=\"$username \"
                        where korisnikAcc_id='$korisnikAccID'";


                      }
                      else
                      {
                          $passwordHash = hash(md5,$password,false);
                            $upit = "UPDATE  korisnikaccount
                        SET username=\"$username \",password=\"$passwordHash\"
                        where korisnikAcc_id='$korisnikAccID'";

                      }


                    $conn->query($upit);

                   $sql = "UPDATE  korisnik
                        SET ime=\"$ime \", prezime=\"$prezime \",BrojTelefona=\"$brojTel \",mail=\"$email \"
                        where korisnik_id='$id'";

                  if ($conn->query($sql) === TRUE) {
                  header("location: admin.php");
                  } 

               }




          }





    


 ?>

     
 <!-- <div class="unosNovog">

    <label>Dodaj/Uredi korisnika:</label>
    <form action="admin.php" method="post">

       <input name='id' type=text class='username sirinaUnosa' placeholder='' value='0' id='id'  hidden/>

        <p class='ime'>
            <label for'ime'>Ime:</label>
            <input name='ime' type=text class='username sirinaUnosa' placeholder='' id='ime' />
        </p>
        <p class='prezime'>
            <label for'prezime'>Prezime:</label>
            <input name='prezime' type=text class='username sirinaUnosa' placeholder='' id='prezime' />
        </p>
        <p class='brojTelefona'>
            <label for'brojTelefona'>Broj telefona:</label>
            <input name='brojTelefona' type=text class='username sirinaUnosa' placeholder='' id='brojTelefona'/>
        </p>
        <p class='username'>
            <label for'username'>Username:</label>
            <input name='username' type=text class='username sirinaUnosa' placeholder='' id='usernamee' />
        </p>
        <p class='password'>
            <label for'password'>Password:</label>
            <input name='password' type=text class='username sirinaUnosa' placeholder='' id='password' />
        </p>

        <input type='submit' value='Spasi' id='loginbutton' name='spasiButton' />

    </form>

    <input  type='submit' value='Ocisti polja' id='ocistiButton' onclick='javascript:ocisti()' name='spasiButton1' />



  </div> -->

  <div class="listaKorisnika">

    <a href="#formaUnosNovog" class="btn btn-info btn-md" onclick="javascript:prikaziFormu()">
          <span class="glyphicon glyphicon-plus"></span> Dodaj novog korisnika 
        </a>

    <?php 

      $sql = "SELECT ime, prezime, korisnik_id, datum,mail, BrojTelefona, ka.username as username from korisnik
      left join korisnikaccount ka on korisnik.korisnikAccID = ka.korisnikAcc_id where korisnik.Aktivan =1 ";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
            print "<table class='table table-striped'>
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Ime</th>
                          <th>Prezime</th>
                          <th>Email</th>
                          <th>Datum registracije</th>
                          <th>Broj telefona</th>
                          <th>Username</th>
                          <th>Akcije</th>
                        </tr>
                      </thead>
                      <tbody>";
               
                while($row = $result  ->fetch_assoc()) {


                       print "<tr>
                          <th scope='row' >".$row["korisnik_id"]."</th>
                          <td id='ime".$row["korisnik_id"]."'>".$row["ime"]."</td>
                          <td id='prezime".$row["korisnik_id"]."'>".$row["prezime"]."</td>
                          <td id='email".$row["korisnik_id"]."'>".$row["mail"]."</td>
                          <td id='datum".$row["korisnik_id"]."'>".$row["datum"]."</td>
                          <td id='brojTelefona".$row["korisnik_id"]."'>".$row["BrojTelefona"]."</td>
                          <td id='username".$row["korisnik_id"]."'>".$row["username"]."</td>
                          <td > <a href='javascript:uredi(".$row["korisnik_id"].")' class='btn btn-info btn-sm'>
                                <span class='glyphicon glyphicon-pencil'></span>  
                                </a> 
                                <a href='javascript:obrisi(".$row["korisnik_id"].")' class='btn btn-danger btn-sm'>
                          <span class='glyphicon glyphicon-trash'></span>  
                          </a></td>
                        

                        </tr>";
                       
                 

                  
                /*  print "<label id='korisnik".$row["korisnik_id"]."'>
                   ".$row["ime"]." ".$row["prezime"]."
                   <label id='ime".$row["korisnik_id"]."' hidden>".$row["ime"]." </label>
                   <label id='prezime".$row["korisnik_id"]."' hidden>".$row["prezime"]." </label>
                   <label id='brojTel".$row["korisnik_id"]."' hidden>".$row["BrojTelefona"]." </label>
                   

                   <input type='submit' value='Uredi' id='uredi".$row["korisnik_id"]."' onclick='javascript:uredi(".$row["korisnik_id"].")' name='uredi' class='dugmadUredjivanja' />
                  <input type='submit' value='Obrisi' id='obrisi".$row["korisnik_id"]."'  onclick='javascript:obrisi(".$row["korisnik_id"].")' name='obrisi' class='dugmadUredjivanja' />
                   </label> <br/> ";*/
                   
                }

                   print  "</tbody>
                    </table>"; 

      }


    ?>


  </div>  

   <div class="container marginaUnos" id="formaUnosNovog">
            <div class="row">

                <form novalidate  action="" method="post"  id ="formaUnos" hidden>

               

                    <div class="col-lg-4 col-lg-offset-4 text-center">

                       <input name='id' type=text  placeholder='' value='0' id='id'  hidden/>
                        
                        <div class="form-group tdp_form_group">
                            <label >Ime</label>
                            <div class="input-group ">

                                <input type="text" class="form-control" name="ime" id="ime" placeholder="Unesite ime"  >


                                <span class="input-group-addon"  ></span>  
                            </div>
                            
                        </div>
                        <div class="form-group tdp_form_group">
                            <label >Prezime</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="prezime" name="prezime" placeholder="Unesite prezime" >
                                 
                                <span class="input-group-addon"></span>
                            </div>
                           
                        </div>  
                          <div class="form-group tdp_form_group">
                            <label >Email</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Unesite email" >
                                 
                                <span class="input-group-addon"></span>
                            </div>
                           
                        </div>
                        <div class="form-group tdp_form_group">
                            <label >Broj telefona</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="telefon" name="telefon"  placeholder="Unesite broj telefona" >
                                 
                                <span class="input-group-addon"></span>
                            </div>
                         
                        </div>
                        <div class="form-group tdp_form_group">
                            <label >Username</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Unesite username"  >
                                 
                                <span class="input-group-addon"></span>
                            </div>
                           
                        </div>
                         <div class="form-group tdp_form_group">
                            <label >Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Unesite password"  >
                                 
                                <span class="input-group-addon"></span>
                            </div>
                           
                        </div>
                        <div  class="row">
                              <div class="col-md-4"></div>
                              <input type="submit" name="submitNovi" id="submitNovi" value="Spasi" class="btn btn-primary btn-sm col-md-3 btn-pr-sirina ">
                              <div class="col-md-1"></div>
                             <input type="submit" name="submit" id="submit" value="Poništi" class="btn btn-primary btn-sm col-md-3 btn-pr-sirina " onclick="javascript:hideForm()">
                       </div>
                    </div>
                </form>


            </div>
        </div>



<?php include('footer.php') ?>


   
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>


</body>


  <script type="text/javascript">

    function uredi (id) {

      var ime = document.getElementById("ime"+id);
      var prezime = document.getElementById("prezime"+id);
      var brojTel = document.getElementById("brojTelefona"+id);
      var email = document.getElementById("email"+id);
      var username = document.getElementById("username"+id);
      var password = document.getElementById("password"+id);

      var imeForma = document.getElementById("ime");
      var prezimeForma = document.getElementById("prezime");
      var brojTelForma = document.getElementById("telefon");
      var emaiForma = document.getElementById("email");
      var usernameForma = document.getElementById("username");
      var idForma = document.getElementById("id");

      imeForma.value=ime.innerHTML;
      prezimeForma.value=prezime.innerHTML;
      brojTelForma.value=brojTel.innerHTML;
      usernameForma.value=username.innerHTML;
      emaiForma.value=email.innerHTML;

      prikaziFormu();
      idForma.value=id;

      



    }

    function obrisi (id) {

    
       var ajax = new XMLHttpRequest();

        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200)
            {

              console.log(ajax.responseText);
              window.location="admin.php";

                //document.getElementById("brojTelefona").innerHTML = pozivniBrojDrzave + "/";
            }
                
            if (ajax.readyState == 4 && ajax.status == 404)
                alert("GREŠKA!!! Molimo pokušajte kasnije.");
                
        }
        ajax.open("GET", "obrisiKorisnika.php?id="+id, true);
        ajax.send();
  

      



    }

    function hideForm (){

      var imeInput = document.getElementById("ime");
      var prezimeInput = document.getElementById("prezime");
      var brojTelInput = document.getElementById("telefon");
      var usernameInput = document.getElementById("username");
      var idInput = document.getElementById("id");
      var password = document.getElementById("password");

      imeInput.value="";
      prezimeInput.value="";
      brojTelInput.value="";
      usernameInput.value="";
      password.value="";
      idInput.value=0;

      var forma = document.getElementById("formaUnos");
      forma.hidden=true;


    }


    function prikaziFormu () {

        var forma = document.getElementById("formaUnos");
        forma.hidden=false;


    }


  </script>

</html>
<?php  } } else header("Location:index.php"); ?>

