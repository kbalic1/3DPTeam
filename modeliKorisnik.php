<?php
    
   

    require_once("config.php");

        $username= $_SESSION['Username'];

      $sql= "SELECT  `korisnikAcc_id` 
      FROM  `korisnikaccount` 
      WHERE  `username` =  '$username'";
      $result=$conn->query($sql);


      if ($result->num_rows > 0) {
         
          while($row = $result->fetch_assoc()) {
              $ID= $row["korisnikAcc_id"];
          }
      }

    mysqli_real_query($conn, "set names utf8;");
     
     $modeli = $conn->query("select * from objekat where KorisnikObjavioID= '$ID';");
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

     //print "<script>console.log(".(string)$nizModela[0].")</script>";
      /*   print "<script>console.log(\"";
             foreach ($nizModela as $key => $value) {
                     print ((string)$value['ObjekatID']);
             }
             print "\");</script>";*/

            //print "<script>console.log(".$result.")</script>";

            /*foreach ($nizModela as $element) {
                print "<script>console.log(".$element['Naziv']")</script>";
            }*/

          /*  function komparacija($a, $b)
            {
                return strcmp((string)$a['Naziv'], (string)$b['Naziv']);
            }*/

            /* print "<script>console.log(\"";
     foreach ($nizModela as $key => $value) {
             print ((string)$value['ObjekatID']);
     }
     print "\");</script>";*/

     if(isset($_GET['sortirano']))
     {
         if((string)$_GET['sortirano'] == "true")
         {
              // SORTIRANJE PO ABECEDI
                usort($nizModela, function($a,$b)
                {
                     return strcmp((string)$a['Naziv'], (string)$b['Naziv']);
                });

            $modeli = $nizModela;
         }
     }

        
           // print "<script>console.log(".$result.")</script>";

      /*  usort($modeli, 'sortirajPoNazivuModela');

                function sortirajPoNazivuModela($a, $b){
            print "<script>console.log(".$a["Naziv"].")</script>";
            
            return strcmp($a->Naziv, $b['Naziv']);
        }
        print "<script>console.log(".$nizModela[0]["Ocjena"].")</script>";*/
     ?>


<?php
     foreach ($modeli as $model) {

        print "<div class='col-sm-4 col-lg-4 col-md-4'>";
        print "<div class='thumbnail'>";
        print "<img src='".$model["SrcSlika"]."' class='homeModelImg' alt=''>".
              "<div class='caption'>".
              "<h4 class='pull-right'>".$model["BrojPregleda"]." pregleda</h4>".
              "<h4><a href='#'>".$model["Naziv"]."</a></h4>".
              "<p>#Ovdje #ce #biti #tagovi #za #3D #modele</p>". // zabetonirani hash tagovi bice poslije
              "<span class='uploadedAgo'></span>".
              "<input type='hidden' class='uploadDateTime' value='".$model["DatumObjave"]."' />".
              "</div>". // zatvaranje caption diva
              "<div class='ratings'>".
              "<p class='pull-right'><a href='#'>Više -></a></p>".
              "<p>";
              for($i = 0; $i<intval($model["Ocjena"]); $i++)
              {
                    print "<span class='glyphicon glyphicon-star'></span>";
              }
              print "</p> </div>"; // zatvaranje rating diva
            print "</div>"; // zatvaranej thumbnaila
            print "</div>";// zatvaranje cola
     }      

    // print "</div>" // zatvaranje row modeli models diva (containera za modele)
    ?>