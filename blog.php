<?php
$id = $_GET['id'];
if(!isset($id)){
header("location: index.php");
}
session_start();
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Blog - ilinkin</title>
<link rel="icon" type="image/x-icon" href="media/fav.ico">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="static/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<style type="text/css">
#wrap{
word-break: break-word;
/*    overflow-x: auto;*/
white-space: pre-wrap;
/*font-weight: 400;*/
}
.top{
  float: left;
   border-radius: 5px;
  margin-right: 1rem ;
}
.tit{
  word-break: break-word;
  white-space: pre-wrap;
}
a{
  text-decoration: none;
  color: black;
}
</style>
</head>
<body>
<?php include_once '_partials/header.php'; ?>
<?php
include_once '_partials/db.php';
$sql = "select * from posts where sno=:id";
$stmt = $dbcon->prepare($sql);
$stmt->execute(["id"=>$id]);
$result = $stmt->fetch();
if($result->state == "PRIVATE"){
    header("location: index.php");
}
if(empty($result)){
header("location: index.php");
}

echo '
<div class="container loadContent my-4">
&nbsp;&nbsp;&nbsp;

<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
<path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
<path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
</svg>&nbsp;&nbsp;<small id="view">'.$result->view.'</small>&nbsp;
';

// Logic for Like system
$id = $_GET['id'];
$ip = $_SERVER['REMOTE_ADDR'];
// echo $ip;
$query = "select * from likes where post_id=:id and ip=:ip";
$stmtq = $dbcon->prepare($query);
$stmtq->bindparam(":id",$id);
$stmtq->bindparam(":ip",$ip);
$stmtq->execute();
// $resultq = $stmtq->fetch();
// echo $stmtq->rowCount();
$q = "select * from likes where post_id=:id";
$st = $dbcon->prepare($q);
$st->execute(["id"=>$id]);
// $resultSt = $st->fetch();
$likes = $st->rowCount();

if($stmtq->rowCount() == 0){
echo '
<!-- Like system -->
<span class="addLike">

<svg xmlns="http://www.w3.org/2000/svg" width="21" height="22" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
<path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
</svg>&nbsp;</span><span id="likeCount">&nbsp;'.$likes.'</span>

';
}
else{
echo '

<span class="removeLike">
<span id="remove">
<svg id ="lik" xmlns="http://www.w3.org/2000/svg" width="28" height="21" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
<path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
</svg>&nbsp;</span><small><span id="removeCount">'.$likes.'</span></small>
';
}




echo '<!-- Date system -->
&nbsp;&nbsp;

<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
</svg>&nbsp;&nbsp;'.substr($result->dt,0,10).'

<div class="card mb-4 my-2">

<div class="card-body">
<h4 class="mb-4">'.$result->title.'</h4>
<pre id="wrap">
'.html_entity_decode($result->des).'
</pre>
</div>
</div>

</div>
';
?>

<!-- Top 3 Blogs Show  -->


<script type="text/javascript">
$(document).ready(function(){
setTimeout(addView, 15000);
function addView() {
  $.post('_partials/upViews.php',{ 
    id : "<?php echo $id; ?>",
  }, function(data,status){
  // alert(data);
  });
}


// Like adding request here

$("span.addLike").click(function(){
  $.post('_partials/addLike.php',{ 
    id : "<?php echo $id; ?>",
    ip : "<?php echo $ip; ?>",
  }, function(data,status){
  // alert(data);
    location.reload();

  });  
});

  // remove adding request here
$("span.removeLike").click(function(){
  $.post('_partials/removeLike.php',{ 
    id : "<?php echo $id; ?>",
    ip : "<?php echo $ip; ?>",
  }, function(data,status){
  // alert(data);
    location.reload();


  });  
});
});
</script>
<div class="container my-5">
  <h3 class="text-center">Top 3 Blogs</h3>
  <ul class="list-group my-4">
    <?php
      // Php logic for getiing top 3
      $stat = "PUBLIC";
      $top = "SELECT * FROM `posts` where state=? ORDER BY view DESC LIMIT 3";       
      $stmtTop = $dbcon->prepare($top);
      $stmtTop->execute([$stat]);
      
      // print_r($resultTop);
       while($resultTop = $stmtTop->fetch()){
      if(!empty($resultTop->link)){

        echo '<ul class="list-group my-2">
        <div class="list-group-item">
        <img src="'.$resultTop->link.'" class="top mr-2"  height="75" width="100"
        alt=""/><a href="blog.php?id='.$resultTop->sno.'" class="tit">'.$resultTop->title.'</a></div>

        ';
      }
      else{
        echo '<ul class="list-group my-2">
        <div class="list-group-item">
        <a href="blog.php?id='.$resultTop->sno.'" class="">'.$resultTop->title.'</a></div>
        ';
      }
    }
?>

</ul>

</div>
<?php include_once '_partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
