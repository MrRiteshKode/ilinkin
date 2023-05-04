<?php
$title = "";
$link = "";
$tags = "";
$desc = "";
$state = "";
$Msg = "";

$title = htmlentities($_POST['title']);
$link = htmlentities($_POST['link']);
$tags = htmlentities($_POST['tags']);
$desc = htmlentities($_POST['desc']);
$state = $_POST['state'];

if($_SERVER["REQUEST_METHOD"]== "POST"){
	if(empty($title) || empty($desc)){
		$Msg = "Fill title or desc.";
	}
	else{
		include_once 'db.php';
		$t = $title;
		$l = $link;
		$tg = $tags;
		$d = $desc;
		$s = $state;
		$query = "INSERT INTO `posts` (`title`, `link`, `tags`, `des`, `state`, `dt`) VALUES (:t, :l, :tg, :d, :s, current_timestamp())";
		$stmt = $dbcon->prepare($query);
		$stmt->bindparam(':t',$t);
		$stmt->bindparam(':l',$l);
		$stmt->bindparam(':tg',$tg);
		$stmt->bindparam(':d',$d);
		$stmt->bindparam(':s',$s);
		$stmt->execute();
		$Msg = "Your post is added";

	}

}

echo $Msg;
?>