        <?php

        if(isset($_REQUEST["reload"]))
        {
          require_once("config.php");

          if(isset($_REQUEST["objekatID"]))
          {
              $id = $_REQUEST["objekatID"]; 
          }
        }

      $komentari = $conn->query("SELECT * FROM komentar WHERE Aktivan = 1 AND ObjekatID =".$id." ORDER BY Vrijeme ;");
     if (!$komentari) {
          $greska = $conn->error;
          print "SQL greška: " . $greska;
          exit();
     }

        /*while( $row = mysql_fetch_assoc( $modeli)){
            $nizModela[] = $row; // Inside while loop
           // $nizModela[ $row['ObjekatID']] = $row;
        }*/

            // KONVEROTVANJE OBJEKATA U NIZ
              while($row = $komentari->fetch_assoc()) {
                    $nizKomentara[] = $row; // Inside while loop
            }



?>

<?php

 foreach ($komentari as $komentar) {

                $sql= "SELECT  `username` 
                FROM  `korisnikaccount` 
                WHERE  `korisnikAcc_id` =  '".$komentar["AutorID"]."' ";
                $result=$conn->query($sql);

                if ($result->num_rows > 0) {
                   
                    while($row = $result->fetch_assoc()) {
                        $usernameKomentar= $row["username"];
                    }
                }
                else{
                   $usernameKomentar="Anonimni Korisnik";
                }


                 $replike = $conn->query("SELECT * FROM replika WHERE Aktivan = 1 AND KomentarID =".$komentar["Komentar_id"]." ORDER BY Vrijeme ;");


               
               print "<div class='media'>
                    <a class='pull-left' href='#''>
                        <img class='media-object' src='http://placehold.it/64x64' alt=''>
                    </a>
                    <div class='media-body'>
                        <h4 class='media-heading text-danger'>";

                        if($usernameKomentar=="Anonimni Korisnik")
                          {
                            print  "".$usernameKomentar."";
                          }
                          else
                            {
                              print "<a href='profilKorisnika.php?username=".$usernameKomentar."'>".$usernameKomentar."</a>";
                            }
                           print " <small>".$komentar["Vrijeme"]."</small>
                        </h4>"
                        .$komentar["Tekst"];

                        print "<button id='repliciraj".$komentar["Komentar_id"]."' name='repliciraj".$komentar["Komentar_id"]."' onclick='repliciraj(".$komentar["Komentar_id"].")' class='btn btn-primary pull-right tdp_repliciraj'>Repliciraj</button>";

                        print "<button id='brisi".$komentar["Komentar_id"]."' name='brisi".$komentar["Komentar_id"]."' onclick='obrisiKomentar(".$komentar["Komentar_id"].")' class='btn btn-primary pull-right tdp_repliciraj btnRepliciraj'>Briši
                        </button>";

                             if ($replike->num_rows > 0) {
                                  
                                   foreach ($replike as $replika) {

                                     $sql= "SELECT  `username` 
                                      FROM  `korisnikaccount` 
                                      WHERE  `korisnikAcc_id` =  '".$replika["AutorID"]."' ";
                                      $result=$conn->query($sql);

                                      if ($result->num_rows > 0) {
                                         
                                          while($row = $result->fetch_assoc()) {
                                              $usernameReplika= $row["username"];
                                          }
                                      }
                                      else{
                                        $usernameReplika="Anonimni Korisnik";
                                      }


                                 print   "<div class='media'>
                                          <a class='pull-left' href='#'>
                                              <img class='media-object' src='http://placehold.it/64x64' alt=''>
                                          </a>
                                          <div class='media-body'>
                                              <h4 class='media-heading text-danger'>";
                                          if($usernameReplika=="Anonimni Korisnik")
                                          {
                                            print  $usernameReplika;
                                          }
                                          else
                                            print "<a href='profilKorisnika.php?username=".$usernameReplika."'>".$usernameReplika."</a>";

                                              
                                             print"<small>".$replika["Vrijeme"]."</small>
                                              </h4>"
                                              .$replika["Tekst"]."
                                          </div>
                                      </div>";


                                   }

                              
                            }

                            print "<div class='media'>
                                          <a class='pull-left' href='#''>

                                          </a>
                                          <div class='media-body'>

                                            <div class='well' id='ostaviRepliku".$komentar["Komentar_id"]."' hidden>
                                            <h4>Ostavite repliku:</h4>
                                            <form class='form' action= 'pregledModela.php' method='post'>
                                                <div class='form-group'>
                                                    <textarea id='replika' name='replika' class='form-control' rows='3'></textarea>
                                                </div>
                                                <input id='idObj' name='idObj' value = '".$id."' hidden>
                                                <input id='idKomentara' name='idKomentara' value = '".$komentar["Komentar_id"]."' hidden> 
                                                <button id='repliciraj' name='repliciraj' type='submit' class='btn btn-primary'>Repliciraj</button>
                                            </form>
                                        </div>
                                             
                                          </div>
                                      </div>";

                                        
                print    "</div>";
                print    "</div>";



    }


?>



               
<script type="text/javascript">


function repliciraj (id){

        var replikaDiv=document.getElementById("ostaviRepliku"+id);
        var dugmeOstaviRepliku = document.getElementById("repliciraj"+id);

        if(replikaDiv.hidden){
        replikaDiv.hidden=false;
        dugmeOstaviRepliku.innerHTML="Zatvori";
         }
         else{

        replikaDiv.hidden=true;
        dugmeOstaviRepliku.innerHTML="Repliciraj";

         }
}

</script>