<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>


<?php require_once("config.php"); ?>

<?php
ini_set('upload_max_filesize', '20M');
ini_set('post_max_size', '20M');


session_start();
$naziv = $_POST['nazivModela'];

$datumIme=date('d-m-Y-H-i-s');

mkdir("data/".$_SESSION['Username']."/".$naziv."-".$datumIme );

$target_dir = "data/".$_SESSION['Username']."/".$naziv."-".$datumIme."/";

$target_file_slika = $target_dir .date('d-m-Y-H-i-s').basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file_slika,PATHINFO_EXTENSION);

// Check if file already exists
if (file_exists($target_file_slika)) {
   // echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file

} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_slika)) {
      //  echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file slika";
    }
}


$target_file_objekat = $target_dir . basename($_FILES["fileToUploadObj"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file_objekat,PATHINFO_EXTENSION);

if (file_exists($target_file_objekat)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}


if ($uploadOk == 0) {
   // echo "Sorry, your file was not uploaded.";


} else {
    if (move_uploaded_file($_FILES["fileToUploadObj"]["tmp_name"], $target_file_objekat)) {
      //  echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file model.";
    }
}


$target_file_objekat = $target_dir . basename($_FILES["fileToUploadObj1"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file_objekat,PATHINFO_EXTENSION);

if (file_exists($target_file_objekat)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}


if ($uploadOk == 0) {
   // echo "Sorry, your file was not uploaded.";


} else {
    if (move_uploaded_file($_FILES["fileToUploadObj1"]["tmp_name"], $target_file_objekat)) {
      //  echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
      //  echo "Sorry, there was an error uploading your file.";
    }
}




if(count($_FILES['upload']['name']) > 0){
        //Loop through each file
        for($i=0; $i<count($_FILES['upload']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
                $shortname = $_FILES['upload']['name'][$i];

                //save the url and the file
                $filePath = $target_dir.basename($_FILES['upload']['name'][$i]);

                //Upload the file into the temp dir
                if(move_uploaded_file($tmpFilePath, $filePath)) {

                }
              }
          }
      }
         


$putIIMe= substr($target_file_objekat, 0,-4);


$datum = date("Y-m-d h:i:sa");

$opis= $_POST["opisModela"];

$username= $_SESSION['Username'];

if(isset($_POST["mogucnostKomentara"]))
$mogucnostKomentara= true;

else
    $mogucnostKomentara=false;




$sql= "SELECT  `korisnikAcc_id` 
FROM  `korisnikaccount` 
WHERE  `username` =  '$username'";
$result=$conn->query($sql);


if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $ID= $row["korisnikAcc_id"];
    }
}



$sql ="SELECT  `korisnik_id`
FROM `korisnik` 
WHERE `korisnikAccID` = '$ID' AND Aktivan = 1 ";

$result1=$conn->query($sql);


if ($result1->num_rows > 0) {
   
    while($row = $result1->fetch_assoc()) {
        $korisnikovID=$row["korisnik_id"];
    }

}

$sql = "INSERT INTO objekat (Naziv,BrojPregleda,DatumObjave,Ocjena,SrcSLika,SrcObjekat,KorisnikObjavioID,Aktivan,Opis,MogucnostKomentara)
VALUES ('$naziv', 0,'$datum' ,1, '$target_file_slika', '$putIIMe','$korisnikovID', true,'$opis','$mogucnostKomentara')";


if ($conn->query($sql) === TRUE) {
    header("location: indexLogovan.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
<body>
</body>
</html>