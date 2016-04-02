<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<?php










$servername = "localhost";
$username = "root";
$password = "";
$dbname = "3dpteam";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$username_k=$_REQUEST['username'];
$email_k=$_REQUEST['email'];
$password1_k=$_REQUEST['password1'];
$password2_k=$_REQUEST['password2'];



if($password1_k!=$password2_k)
{ 
	echo "Passwordi se ne podudaraju";
}



else{
$sql = "INSERT INTO korisnikAccount (username,password,rolaID)
VALUES ('$username_k', '$password2_k' ,1)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$datum=date("Y.m.d");
$sql= "SELECT  `korisnikAcc_id` 
FROM  `korisnikaccount` 
WHERE  `username` =  '$username_k'";
$result=$conn->query($sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
        $ID= $row["korisnikAcc_id"];
    }
}



$sql = "INSERT INTO korisnik (datum,mail,korisnikAccID,aktivan)
VALUES ('$datum','$email_k','$ID',TRUE)";
if ($conn->query($sql) === TRUE) {
	header("location: index.html");
	}

}




?>
<body>
</body>
</html>