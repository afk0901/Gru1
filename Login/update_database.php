
<?php
 session_start();


/*HÉR ER SETT FENGIÐ NAFNIÐ Á ATBURÐINUM*/
    $atburdur_place_i_array = 0;
       
       $Valinn_atburdur = $_POST['event_selected'];
      $selected = $_COOKIE['select'];
      $selected_decode = json_decode($selected);


     $nafn_atburðar = $selected_decode[1][$atburdur_place_i_array];
           
      $sql_selected_atburdur_id = "SELECT id_atburdir from atburdir where nafn_atburdar = '$nafn_atburðar'";
      $sql_atburdur_id = $connection->query($sql_selected_atburdur_id);

      while ($row = $sql_atburdur_id->fetch()) {
                $id[] = $row['id_atburdir'];
            }
        $id_to_use = $id[0];
        $kt_to_use = $_SESSION["user_kt"];

    
       //Finna út númer hvað $valinn_atburdur er í listanum - Lúppa í gegnum array 1 þar til að array 1 index er $Valinn atburdur þá sjá hversu oft var lúppað.
       //Velja úr array 2 það sem oft var lúppað.
      //Lúppa í gegnum fyrri array $nafn_og_selected, stoppa þar sem $Valinn_atburdur er. Annars hækkar teljari um einn
$correct_selected = count($selected_decode) +1;//Atburðurinn fór alltaf einum meira eða tveimur meira á ákveðnum atburðum svo þetta fixar það.

    for ($i=0; $i <= $correct_selected; $i++) { 

         
          if ($selected_decode[0][$i] == $Valinn_atburdur) {
              break;
          }
          else{
             $atburdur_place_i_array++; 

          }
             
      }



//Þessi skrá heldur utan um allar tengingar við gagnagrunn.
if (isset($_POST['subnyskra'])) {//Ef ýtt er á Nýskrá þá er allt kennitala, nafn, lykilorð, tölvupóstur og sími sett í post arrayið.

$kt = $_POST['kt'];
$nafn = $_POST['user'];
$pass = hash("Sha512",($_POST['password']));
$email = $_POST['email'];
$simi = $_POST['simi'];

//Checka á hvort að það sé rétt fyllt inn.
if (empty($kt)){
  echo "Kennitölu vantar!";
  exit;
}

else if (strlen($kt) !== 10) {
  echo "Ógild kennitala!";
  exit;
}

else if (empty($nafn)) {
  echo "Nafn vantar!";
  exit;
  }

else if(strlen($_POST['password']) < 9){
  
  echo "Lykilorð verður að vera a.m.k 8 stafir!";
  exit;
}

else if (empty($email)){
  echo "Netfang vantar!";
} 

else if (empty($simi)) {
    echo "Símanúmer vantar!";
} 

 
if (!empty($kt) && !empty($nafn) && !empty($pass) && !empty($email) && !empty($simi)) {

try {
	//Byrja á því að gá hvort að kennitalan sé til í grunninum.
	//Vel kennitöluna sem notandi stimplaði inn 
         $sql_select_if_exist = "SELECT user_id FROM user where user_id = '$kt' ";
 		$sql_notandi = $connection->query($sql_select_if_exist);
         
          while ($row = $sql_notandi->fetch()) {
                $notandi_kt[] = $row['user_id'];
            }
        }


catch (Exception $e) {
	echo "Ekki tókst að skrá í grunninn!".$e;
}


if (strlen($_POST['password']) > 7) {

//Ef að kennitalan er ekki til í grunninum þá setjum við hana inn í grunninn
         if (!isset($notandi_kt[0])) {

      //Set upplýsingar um notanda inn í töfluna user
	//Nota prepare svo að við setjum ekki gildin inn strax.

	$sql_insert_notandi = "INSERT INTO user(user_id, nafn, Lykilord, Simi, Netfang)
     VALUES(:id,:nafn,:Lykilord,:Simi,:Netfang)
	";
	//Nota bindvalue til að binda gildin við. Þannig að nú eru komin gildi.
	$result = $connection->prepare($sql_insert_notandi);
	$result->bindvalue(':id',$kt);
	$result->bindvalue(':nafn',$nafn);
	$result->bindvalue(':Lykilord',$pass);
	$result->bindvalue(':Simi',$simi );
	$result->bindvalue(':Netfang',$email);
	$result->execute();
	echo "Þú hefur nýskráð þig!";
}
}

if (isset($notandi_kt[0])) {

    echo "Þessi kennitala er þegar til. Reyndu aftur";
    exit;
 }

}

}

//Allt sem gerist þegar notandi er skráður inn.
if (isset($_POST['sublogin']) || $_SESSION['pass_user_session'] 
  == hash("sha512",$_SESSION["login_password"])) {
    

    if (isset($_POST['logoff'])) {
       $_SESSION["login_password"] = null;
       header('Location: http://127.0.0.1:81/Gru1/NewIndex/');
    }

    if (isset($_POST['sublogin'])) {
    $login_kt = $_POST['login_kt'];
   $login_pass = $_POST['login_password'];
   $_SESSION["user_kt"] = $login_kt;//Set kennitöluna í session svo við getum notað hana annarsstaðar í kóðanum
   $_SESSION["login_password"] = $login_pass;
}

    try {
    	$kt_login = $_SESSION["user_kt"];
    
	//Næ í hashstrengin úr grunninum
         $sql_select_pass = "SELECT Lykilord FROM user where user_id = '$kt_login' ";
 		$sql_pass = $connection->query($sql_select_pass);
         
          while ($row = $sql_pass->fetch()) {
                $notandi_pass[] = $row['Lykilord'];
            }


        }

catch (Exception $e) {
	echo "Ekki tókst að skrá í grunninn!".$e;
}
         
          try {
        
    	$kt_login = $_SESSION["user_kt"];//Næ í kennitöluna sem geymd er í session

	//Næ í hashstrengin úr grunninum
    //Vel atburðina sem notandi er skráður á.
         $sql_select_atburdir = "SELECT bokanir_atburdur.id_atburdir as bokad_id, nafn_atburdar, atburdir.timi, atburdir.dagsetning
 FROM atburdir join bokanir_atburdur on atburdir.id_atburdir
= bokanir_atburdur.id_atburdir join user on user.user_id = bokanir_atburdur.user_id
where bokanir_atburdur.user_id = '$kt_login'";

 		$sql_atburdir = $connection->query($sql_select_atburdir);
         
          while ($row = $sql_atburdir->fetch()) {
                $bokanir_atburdur_id[] = $row['bokad_id'];
                $nafn_atburdar[] = $row['nafn_atburdar'];
                $timi[] = $row['timi'];
                $dagsetning[] = $row['dagsetning'];
            }
     
     }
     

catch (Exception $e) {
	echo "Ekki tókst að skrá í grunninn!".$e;
}

try{



$sql_select_atburdir_velja = "SELECT nafn_atburdar, timi, dagsetning FROM atburdir ORDER BY dagsetning";
  $sql_atburdir_valid = $connection->query($sql_select_atburdir_velja);
   
   while ($row2 = $sql_atburdir_valid->fetch()) {
                $nafn_ekki_booked[] = $row2['nafn_atburdar'];
                $timi_ekki_booked[] = $row2['timi'];
                $dagsetning_ekki_booked[] = $row2['dagsetning'];
            }
} 

catch (PDOException $e) {
  echo "Ekki tókst að velja atburði úr grunni!".$e;
}

   }


   if (isset($_POST['subskravidburd'])) {
    $takk = "Takk fyrir að skrá þig á viðburð hjá okkur! ";
    include_once "../Login/dbconnection.php";
    include_once  "minsida.php";
 
           
     try {
    
//Vel alla atburði sem notandi er bókaður á til að checka hvort notandi er skráður á atburð
$sql_selected_booked_id = "SELECT id_atburdir from bokanir_atburdur where user_id = '$kt_to_use'";
      $sql_atburdur_booked_id = $connection->query($sql_selected_booked_id);

      while ($row = $sql_atburdur_booked_id->fetch()) {
                $id_booked[] = $row['id_atburdir'];
            }
//Lúppa í gegnum bókaðra id og gái fyrir hvert id hvort að það sé það sama og idið sem notandinn valdi.
            foreach ($id_booked as $id) {

            if ($id_to_use == $id) {
            $takk = "Þú ert nú þegar skráð/ur á þennan atburð!";
            echo $takk;
            exit;
            }
        }

      $sql_insert_id = "INSERT INTO bokanir_atburdur(id_atburdir, user_id) 
      VALUES('$id_to_use','$kt_to_use');";

      $sql_insert_id = $connection->exec($sql_insert_id); 

  echo "Þú hefur skráð þig á ".$Valinn_atburdur;



 } catch (PDOException $e) {
    echo "Ekki tókst að ná í úr grunni Sjá:".$e;   
     }

    try {
      
      $sql_count_atburdur_id = "SELECT id_atburdir from atburdir where id_atburdir = '$nafn_atburðar'";
      $sql_count_atburdur_id = $connection->query($sql_count_atburdur_id);

      while ($row = $sql_atburdur_id->fetch()) {
             $count[] = $row['id_atburdir'];
            }
      }

      catch (PDOException $e) {
        echo "Villa kom upp! Sjá: ".$e;
      }

   }


    if (isset($_POST['subafskravidburd'])) {

   try {
    
         
     $sql_delete_event = "DELETE FROM bokanir_atburdur where user_id = '$kt_to_use' AND id_atburdir = '$id_to_use'";
     $sql_delete = $connection->exec($sql_delete_event);

   } 

    catch (PDOException $e) {
     echo "Villa! Sjá ".$e;
   }
}

   	
?>
