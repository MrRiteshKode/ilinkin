<?php
try{
	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "iblog";
	$dbcon = new PDO("mysql:host=$server; dbname=$db", $user,$password);
	$dbcon->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ); //INITIALISE ATTRIBUTE

}catch(PDOException $e){
	echo 'Error: '.$e->getMessage();
}

?>