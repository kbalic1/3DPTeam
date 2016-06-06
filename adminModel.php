
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



  <div class="listaKorisnika">

    <?php 

      $sql = "SELECT Naziv, DatumObjave, Ocjena, ObjekatID, ka.username as username from objekat
      left join korisnik k on objekat.KorisnikObjavioID = k.korisnik_id 
      left join korisnikaccount ka on k.korisnikAccID = ka.korisnikAcc_id where objekat.Aktivan = 1 ";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
            print "<table class='table table-striped'>
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Naziv</th>
                          <th>Datum objave</th>
                          <th>Ocjena</th>
                          <th>Objavio</th>
                        </tr>
                      </thead>
                      <tbody>";
               
                while($row = $result  ->fetch_assoc()) {


                       print "<tr>
                          <th scope='row' >".$row["ObjekatID"]."</th>
                          <td id='naziv".$row["ObjekatID"]."'>".$row["Naziv"]."</td>
                          <td id='prezime".$row["ObjekatID"]."'>".$row["DatumObjave"]."</td>
                          <td id='email".$row["ObjekatID"]."'>".$row["Ocjena"]."</td>
                          <td id='datum".$row["ObjekatID"]."'>".$row["username"]."</td>
                          <td > 
                              <a href='javascript:obrisi(".$row["ObjekatID"].")' class='btn btn-danger btn-sm'>
                          <span class='glyphicon glyphicon-trash'></span>  
                          </a></td>
                        

                        </tr>";
                       
                   
                }

                   print  "</tbody>
                    </table>"; 

      }


    ?>


  </div>  

 


<?php include('footer.php') ?>


   
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>


</body>


  <script type="text/javascript">

   
    function obrisi (id) {

    alert(id);
       var ajax = new XMLHttpRequest();

        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200)
            {

              console.log(ajax.responseText);
              window.location="adminModel.php";

                //document.getElementById("brojTelefona").innerHTML = pozivniBrojDrzave + "/";
            }
                
            if (ajax.readyState == 4 && ajax.status == 404)
                alert("GREŠKA!!! Molimo pokušajte kasnije.");
                
        }
        ajax.open("GET", "obrisiModel.php?id="+id, true);
        ajax.send();
  

      



    }

   


  </script>

</html>
<?php  } } else header("Location:index.php"); ?>

