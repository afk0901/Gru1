<?php
$servername = "tsuts.tskoli.is";
$username = "0901972749";
$password = "mypassword";
$DB = "0901972749_lokaverkefni_gru1";

try {
    $connection = new PDO("mysql:host=$servername;dbname=$DB", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connection->exec('SET NAMES "utf8"');
    
    }
catch(PDOException $e)
    {
    echo "Ekki tókst að tengjast við grunninn! Sjá: " . $e->getMessage();
    }
?>
