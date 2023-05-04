<?php
$Msg = "";
if($_SERVER["REQUEST_METHOD"]== "POST"){
	include_once 'db.php';
	$idnum = $_POST['id'];
	$sql = "DELETE FROM `posts` WHERE `posts`.`sno` = $idnum";
	$dbcon->exec($sql);
	$Msg = "Successfully deleted";

}
echo $Msg;
// echo $_POST['id'];
?>