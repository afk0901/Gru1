<?php
//Þessi skrá heldur utan um allar tengingar við gagnagrunn.

	
$kt = $_POST['kt'];
$nafn = $_POST['user'];
$pass = sha1($_POST['password']);
$email = $_POST['email'];
$simi = $_POST['simi'];

//FYRIR SIGN-UP FORM
if (isset($_POST['subnyskra'])) {//Ef ýtt er á Nýskrá þá er allt kennitala, nafn, lykilorð, tölvupóstur og sími sett í post arrayið.

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
         if ($notandi_kt[0] == null) {

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


else{//Ef hún er til kemur villa
    echo "Þessi kennitala er þegar til. Reyndu aftur";
 }

}

else{
	echo "Lykilorð verður að vera meira en 8 stafir!";
}

}

if (isset($_POST['sublogin'])) {
    
    try {
    	$kt_login = $_POST['login_kt'];
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

}
         
          try {
    	$kt_login = $_POST['login_kt'];
	//Næ í hashstrengin úr grunninum
    	if (isset($kt_login)) {
    //Vel atburðina sem notandi er skráður á.
         $sql_select_atburdir = "SELECT nafn_atburdar, atburdir.timi, atburdir.dagsetning
 FROM atburdir join bokanir_atburdur on atburdir.id_atburdir
= bokanir_atburdur.id_atburdir join user on user.user_id = bokanir_atburdur.user_id
where bokanir_atburdur.user_id = '$kt_login'";

 		$sql_atburdir = $connection->query($sql_select_atburdir);
         
          while ($row = $sql_atburdir->fetch()) {
                $nafn_atburdar[] = $row['nafn_atburdar'];
                $timi[] = $row['timi'];
                $dagsetning[] = $row['dagsetning'];
            }


        }
    }

catch (Exception $e) {
	echo "Ekki tókst að skrá í grunninn!".$e;
}
    	
?>
