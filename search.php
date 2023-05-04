<?php
session_start();
$q = $_GET['q'];
if(empty($q)){
  header("location: index.php");
}
include_once '_partials/db.php';
$state = "PUBLIC";
$sql = "SELECT * from posts WHERE match(title, tags, des) against (?) and state=?";
$stmt = $dbcon->prepare($sql);
$stmt->execute([$q, $state]);

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Search - <?php echo $q; ?></title>
  <link rel="icon" type="image/x-icon" href="media/fav.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="static/style.css">
</head>
<style>
 a{
   text-decoration: none;
 }

</style>
<body>
  <?php include_once '_partials/header.php'; ?>

  <div class="container my-4">
   <h2>Search Results for :   '<?php echo $q;?>'</h2>
 </div>

 <div class="container my-4">
  <?php
  if($stmt->rowCount() > 0){
    while ($result = $stmt->fetch()) {

     echo '
     <div class="card my-3">
     
     <div class="card-body">
     <h5 class="card-title"><a href="blog.php?id='.$result->sno.'">'.$result->title.'</a></h5>
     <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
     <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
     <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
     </svg>&nbsp;&nbsp; '.$result->view.' &nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
     <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
     </svg>&nbsp;&nbsp; '.substr($result->dt,0,10).'
     </div>
     </div>

     ';
   }
 }
 else{
  echo '
  <div class="card my-3">
  
  <div class="card-body">
  <h3>Suggestion :</h3>

  <ul>
  <li>No results are found</li>
  <li>No content avaible for this query.</li>
  <li>Please try some other keywords.</li>
  <li>try more general words.</li>

  </ul>
  </div>
  </div>
  ';
}

?>



<!-- <div class="card my-3">
  <div class="card-body">
    <h5 class="card-title"><a href="l.php">Special title treatment</a></h5>
  </div>
</div>
<div class="card my-3">
  <div class="card-body">
    <h5 class="card-title"><a href="l.php">Special title treatment</a></h5>
  </div>
</div>
<div class="card my-3">
  <div class="card-body">
    <h5 class="card-title"><a href="l.php">Special title treatment</a></h5>
  </div>
</div> -->

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>]