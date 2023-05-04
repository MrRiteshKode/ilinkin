<?php
// remove like Logic
$Msg = "";
if($_SERVER["REQUEST_METHOD"]== "POST"){	
	$ip = $_POST['ip'];
	$idNo = $_POST['id'];	
	include_once 'db.php';
	$sql = "DELETE FROM `likes` WHERE `ip` = ? and `post_id` = ?";
	$stmt = $dbcon->prepare($sql);
	$stmt->execute([$ip,$idNo]);
	$Msg = "like removed";
}
echo $Msg;
echo "ok";

?>