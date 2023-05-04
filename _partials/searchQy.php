<?php
$Msg = "";
if($_SERVER["REQUEST_METHOD"]== "POST"){
	$q = htmlentities($_POST['q']);
	if(empty($q)){
		$Msg = "empty";
	}
	else{
		header("location: search.php?q=".$q);
		//  Query for enable full text search in db
		// alter table posts add FULLTEXT(`title`, `tags`);
		// SELECT * from posts WHERE match(title, tags) against ('hfh');

	}

}
echo $Msg;
?>