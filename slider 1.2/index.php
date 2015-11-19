<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>emil slider</title>
    
    
        <link rel="stylesheet" href="css/style.css">   
    
  </head>

  <body>
<div class="menu">
    <div class="brblogo">
      <img src="brblogo.png">
    </div>
</div>
<div class="maincontainer">
  
  <div id="slider">
    <a href="#" class="control_next">></a>
    <a href="#" class="control_prev"><</a>
    <ul>
      <li><img src="mynd1.jpg">SLIDE 2</li>
      <li><img src="mynd2.jpg">SLIDE 2</li>
      <li><img src="mynd3.jpg">SLIDE 3</li>
      <li><img src="mynd4.jpg">SLIDE 4</li>
    </ul>  
  </div>

  
      <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

          <script src="js/index.js"></script>

<div class="upplysingabox">
    <div class="skraatburd">
      
    </div>

    
    <div class="miniratburdir">
    
 <?php   
include_once "../Login/dbconnection.php";
include_once "../Login/update_database.php";

 //FYRIR LOGIN
if (isset($_POST['sublogin'])) {

   $login_kt = $_POST['login_kt'];
   $login_pass = $_POST['login_password'];

   
if ($notandi_pass[0] == hash("sha512",$login_pass) && $notandi_pass[0] != null) {
 // include_once "update_database.php";
  //Hér kemur allt sen kemur eftir að notandi loggar sig inn.
  echo "Halló, ". $login_kt;

    echo '<h1>Mínir Viðburðir</h1>';
     
     if (!isset($nafn_atburdar)) {
      echo "Þú hefur ekki skráð þig á neina viðburði."."\n"."Ef þú villt getur þú skráð þig á viðburð hér til hliðar!";
       }

       else{
     echo '<div class="events_box">';
    foreach ($nafn_atburdar as $heiti_atburdar) {
      
         echo '<div class="heiti_atburdar">'.$heiti_atburdar."</div>";
}
echo '</div>';
}

}//Endir á lykilorða compare

else{
  echo "Rangt notandanafn eða lykilorð!";
}

}
?>

    </div>

    <div class="frett">
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
        <div class="mynd">
        <img src="bobross.jpg">
        </div>
      </p>
    
</div>   
    
  </body>
  <footer>
    <p>
      efwwsfasfa
    </p>
  </footer>
</html>
