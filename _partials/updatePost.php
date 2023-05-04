<?php
$title = "";
$link = "";
$tags = "";
$desc = "";
$state = "";
$Msg = "";

$id = $_POST['id'];
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
		$id = $id;
		$query = "UPDATE `posts` SET `title` = ?, `link` = ?, `tags` = ?, `des` = ?, `state` = ? WHERE `posts`.`sno` = ?;";
		$stmt = $dbcon->prepare($query);
		$stmt->execute([$t,$l,$tg,$d,$s,$id]);
		$Msg = "Your Post is updated";

	}

}

echo $Msg;
?>