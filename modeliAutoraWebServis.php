
<?php
function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}
function rest_get($request, $data) { }
function rest_post($request, $data) { }
function rest_delete($request) { }
function rest_put($request, $data) { }
function rest_error($request) { }

$method  = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch($method) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        zag(); $data = $put_vars; rest_put($request, $data);
        echo "PUTTTIIYYY";
         break;
    case 'POST':
        zag(); $data = $_POST; rest_post($request, $data);
        echo "PPOSTY";
         break;
    case 'GET':
        zag(); $data = $_GET; rest_get($request, $data);
        $Autor = $_GET["UsernameAutora"];
        $BrojModela = $_GET["BrojModela"];

        require_once("config.php");
        mysqli_real_query($conn, "set names utf8;");  

$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO('mysql:dbname=3dpteam;host=localhost','root','Sitim12');

$pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );

    $stm = $pdo->prepare("select * from 3dpteam.objekat 
 left join 3dpteam.korisnik on 3dpteam.objekat.KorisnikObjavioID = 3dpteam.korisnik.korisnik_id
left join 3dpteam.korisnikaccount on 3dpteam.korisnik.korisnikAccID = 3dpteam.korisnikaccount.korisnikAcc_id 
                                       where 3dpteam.korisnikaccount.username = ? limit ?;");

$stm->bindParam(1, $Autor, PDO::PARAM_STR);
$stm->bindParam(2, $BrojModela, PDO::PARAM_INT);
$stm->execute();

$podaci = $stm->fetchAll(\PDO::FETCH_ASSOC);

print json_encode($podaci);

$pdo = null; /*zatvaranje PDO konekcije*/
$conn->close();

        break;
    case 'DELETE':
        zag(); rest_delete($request); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}
?>
