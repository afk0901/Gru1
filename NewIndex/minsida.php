<!DOCTYPE html>
<html>
<head>
	<title>bob Ross bar</title>
	<link rel="stylesheet" type="text/css" href="script.js">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8";>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container"> 
<div class="well">
  <img src="brblogo.png">
  
  <!--Til að posta submit takkanum þá nota ég form taggið. Þarf að posta takkanum til að vita hvort að ýtt hafi verið á hann-->
  <form action="../Login/update_database.php" method="POST">
    <button type="submit" name="logoff">Skrá mig út</button>

  </form> 

</div>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="mynd1.jpg" alt="mynd1">
    </div>

    <div class="item">
      <img src="mynd2.jpg" alt="mynd2">
    </div>

    <div class="item">
      <img src="mynd3.jpg" alt="mynd3">
    </div>

    <div class="item">
      <img src="mynd4.jpg" alt="mynd4">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div> 

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <form role="form" action="skrad_a_vidburd.php" method="POST">
        <h1>Skrá mig á viðburð</h1>
       <?php 

include_once "../Login/dbconnection.php";
include_once "../Login/update_database.php";



       ?>

<select name ="event_selected">
<option>Veldu viðburð</option>
<?php 
include_once "../Login/dbconnection.php";
include_once "../Login/update_database.php";

//Bý til 2d array fyrir það sem stendur í selectboxinu og nafn viðburðarins.
       $nafn_og_selected = array(
         array(),//Það sem stendur í selectboxinu
         array()//Nafnið á viðburðinum sjálfum
        );

//Lúppa í gegnum allar færslurnar og skrifa út nafnið á taburðinum, tíma og dagsetningu.
//count() fallið er notað til að telja allar færslurnar. Síðan er echoað út <option> html taggið

//$nafn_ekki_booked = count($nafn_ekki_booked) + 1;

for ($i=0; $i < count($nafn_ekki_booked); $i++) { 
    echo '<option>'.$nafn_ekki_booked[$i].' klukkan '.$timi_ekki_booked[$i].' þann '.$dagsetning_ekki_booked[$i].'</option>';

    array_push($nafn_og_selected[0], $nafn_ekki_booked[$i].' klukkan '.$timi_ekki_booked[$i].' þann '.$dagsetning_ekki_booked[$i]);
    array_push($nafn_og_selected[1], $nafn_ekki_booked[$i]);

}
echo count($nafn_og_selected[1]);
//Nota json_encode til að geta geymt fylkið í köku
$array_nafn_og_selected_json = json_encode($nafn_og_selected);
setcookie('select', $array_nafn_og_selected_json);

?>
</select>
<button type="submit" name="subskravidburd"  class="btn btn-default">Skrá mig á þennann viðburð</button>
<button type="submit" name="subafskravidburd"  class="btn btn-default">Afskrá mig af viðburð</button>
</form>
 </div>

          
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


 //FYRIR LOGIN
if (isset($_POST['sublogin']) || !empty($_SESSION['pass_user_session'])) {

include_once "../Login/dbconnection.php";
include_once "../Login/update_database.php";

if (isset($_POST['sublogin'])) {
    $login_kt = $_POST['login_kt'];
   $login_pass = $_POST['login_password'];
   $_SESSION["user_kt"] = $login_kt;//Set kennitöluna í session svo við getum notað hana annarsstaðar í kóðanum
   $_SESSION["login_password"] = $login_pass;
}
  
//Ef að hashstrengurinn af passwordinu sem sleginn var inn er sá sami og hashstrengurinn frá gagnagrunni eða að pass_user_session
//sé passwordið frá notanda hashað þá loggast notandi inn. En ef Sessionið er lykilorðið hashað þá helst notandinn inni
//þartil hann ákveður að skrá sig út eða hann lokar vafranum.
if ($notandi_pass[0] == hash("sha512",$_SESSION["login_password"]) && $notandi_pass[0] != null || $_SESSION['pass_user_session'] 
  == hash("sha512",$_SESSION["login_password"])) {

 echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';

  $_SESSION['pass_user_session'] = hash("sha512",$_SESSION["login_password"]); 

  //Hér kemur allt sem kemur eftir að notandi loggar sig inn.
  echo "Halló, ". $_SESSION["user_kt"];

 

    echo '<h1>Mínir Viðburðir</h1>';
     
     if (!isset($nafn_atburdar)) {
      echo "Þú hefur ekki skráð þig á neina viðburði."."\n"."Ef þú villt getur þú skráð þig á viðburð hér til hliðar!";
       }

       else{
     echo '<div class="events_box">';
    foreach ($nafn_atburdar as $heiti_atburdar) {
      
         echo '<p>'.$heiti_atburdar."</p>";
         echo '</div>';
}
}

}//Endir á lykilorða compare

else{
  echo "Röng kennitala eða lykilorð!";
}
echo '</div>';
}
//Ef að það var ekki ýtt á login takkann er notandinn færður á login síðuna.
/*else{
  header('Location: http://tsuts.tskoli.is/2t/0901972749/Gru1/NewIndex/');
}*/

?>          
    </div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <img src="bobross.jpg">
</div>
<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
  <img src="bobross.jpg">
</div>
</div>
</body>
</html>