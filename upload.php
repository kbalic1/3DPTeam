<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>


<?php require_once("config.php"); ?>

<?php

session_start();

$target_dir = "data/".$_SESSION['Username']."/";
$target_file_slika = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file_slika,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
/*if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}*/
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
       // echo "Sorry, there was an error uploading your file.";
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
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_objekat)) {
      //  echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
      //  echo "Sorry, there was an error uploading your file.";
    }
}

$naziv = $_POST['nazivModela'];

$datum = date("Y-m-d h:i:sa");

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

$sql = "INSERT INTO objekat (Naziv,BrojPregleda,DatumObjave,Ocjena,SrcSLika,SrcObjekat,KorisnikObjavioID,Aktivan)
VALUES ('$naziv', 0,'$datum' ,0, '$target_file_slika', '$target_file_objekat','$ID', true )";


if ($conn->query($sql) === TRUE) {
    header("location: indexLogovan.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>
<body>
</body>
</html>