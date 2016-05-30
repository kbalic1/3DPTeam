<?php

    require_once("config.php");
    mysqli_real_query($conn, "set names utf8;");
     
     $modeli = $conn->query("SELECT * FROM objekat WHERE Aktivan = 1 AND KorisnikObjavioID =".$korisnikID." ORDER BY BrojPregleda DESC LIMIT 5;");
     if (!$modeli) {
          $greska = $conn->errorInfo();
          print "SQL greška: " . $greska[2];
          exit();
     }

        /*while( $row = mysql_fetch_assoc( $modeli)){
            $nizModela[] = $row; // Inside while loop
           // $nizModela[ $row['ObjekatID']] = $row;
        }*/

            // KONVEROTVANJE OBJEKATA U NIZ
              while($row = $modeli->fetch_assoc()) {
                    $nizModela[] = $row; // Inside while loop
            }



    
     ?>


<?php
     foreach ($modeli as $model) {

        print "<div >";
        print "<div class='thumbnail'>";
        print "<img src='".$model["SrcSlika"]."' class='homeModelImg' alt='' onclick='otvoriModel(".$model["ObjekatID"].")'>".
              "<div class='caption'>".
              "<h4><a href='pregledModela.php?id=".$model["ObjekatID"]."'>".$model["Naziv"]."</a></h4>".
              "</div>"; // zatvaranje caption diva
 
            print "</div>"; // zatvaranej thumbnaila
            print "</div>";// zatvaranje cola
     }      

    // print "</div>" // zatvaranje row modeli models diva (containera za modele)
    ?>



 <script type="text/javascript">

    function otvoriModel(x){

      document.location.href='pregledModela.php?id=' + x;
    }

    </script>