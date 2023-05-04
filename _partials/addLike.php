<?php
// Like adding Logic here
$Msg = "";
if($_SERVER["REQUEST_METHOD"]== "POST"){
	$idNo = $_POST['id'];	
	$a_like = 1;
	$ip = $_POST['ip'];
	include_once 'db.php';
	$sql = "INSERT INTO `likes` (`post_id`, `likes`, `ip`) VALUES (:idNo, :a_like, :ip)";
	$stmt = $dbcon->prepare($sql);
	$stmt->execute(["idNo"=>$idNo, "a_like"=>$a_like, "ip"=>$ip]);
	$q = "select * from likes where post_id=:id";
	$Msg = "Like added";
}
echo $Msg;
?>