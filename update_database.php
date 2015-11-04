<!DOCTYPE html>
<html>
<head>
  <title>dub16</title>
  <meta charset="utf-8">
</head>
<body>
<?php
include_once "dbconnection.php";
include_once "update_database.php";

$kt = $_POST['kt'];
$nafn = $_POST['user'];
$pass = $_POST['password'];
$email = $_POST['email'];
$simi = $_POST['simi'];

//FYRIR LOGIN
if (isset($_POST['sublogin'])) {

   $login_kt = $_POST['login_kt'];
   $login_pass = $_POST['login_password'];

	//Bara að checka hvort að ég get staðfest að lykilorðið sé rétt
   if (strlen($login_pass)) {
   	
   
if ($notandi_pass[0] == hash("sha512",$login_pass) && $notandi_pass[0] != null) {
	//Hér kemur allt sen kemur eftir að notandi loggar sig inn.
  echo "Halló, ". $login_kt;

echo '<form class="pure-form-stacked" action="login.php" method="POST">
    <h1>Mínir Viðburðir</h1>';
    //Pælingin hér er að láta lítið box birtast fyrir hvern atburð

    foreach ($nafn_atburdar as $heiti_atburdar) {
    	echo '<div class="events_box">';
         echo '<div class="heiti_atburdar">'.$heiti_atburdar."</div>";

    	echo '</div>';
    }

     
   
   echo '</div>
</form>';

}

else{
	if (!isset($notandi_pass)) {
		
	echo "Rangt notandanafn eða lykilorð";
}
else{
	echo "Rangt notandanafn eða lykilorð";
	}
}
}

}

?>

</body>
</html>
