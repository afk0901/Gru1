<?php
include_once "dbconnection.php";
include_once "update_database.php";

if (isset($_POST['subnyskra'])) {//Ef ýtt er á Nýskrá þá er allt kennitala, nafn, lykilorð, tölvupóstur og sími sett í post arrayið.


$kt = $_POST['kt'];
$nafn = $_POST['user'];
$pass = $_POST['password'];
$email = $_POST['email'];
$simi = $_POST['simi'];
//Hashar lykilorðið með sha1 algorithmanum 

$pass = sha1($pass);
$testing = sha1("123");//Til að prófa hvort hægt sé að bera saman hash gildin.

echo $pass." ";
echo $testing;

if ($pass == $testing) {
	echo "Yay!!!!";
}


}

if (isset($_POST['sublogin'])) {
	
}


?>
