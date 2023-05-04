<?php
$Msg = "";
if($_SERVER["REQUEST_METHOD"]== "POST"){
	$id = $_POST['id'];
	include_once 'db.php';
	$sql = "UPDATE `posts` SET `view` = view+1 WHERE `posts`.`sno` = :id";
	$stmt = $dbcon->prepare($sql);
	$stmt->bindparam(":id",$id);
	$stmt->execute();

}
echo $_POST['id'];
?>