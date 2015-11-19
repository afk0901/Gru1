<html>
<head>
<title>BRB | Mínir viðburðir</title>
<meta charset="utf-8">
</head>
<body>
<?php  
include_once "../Login/dbconnection.php";
include_once "../Login/update_database.php";

if (isset($_POST['subnyskra'])) {
  $kt = $_POST['kt'];
$nafn = $_POST['user'];
$pass = $_POST['password'];
$email = $_POST['email'];
$simi = $_POST['simi'];
}
?>
</body>
</html>