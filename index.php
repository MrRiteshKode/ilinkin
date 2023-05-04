<?php
// http://localhost/php/New_topics/iBlog/
session_start();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome to Ilinkin - Browse content</title>
  <link rel="icon" type="image/x-icon" href="media/fav.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="static/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<style>
.top{
  float: left;

  margin-right: 1rem ;
  border-radius: 5px;
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
<body style="background-color:#EAEFF2;">
  <?php include_once '_partials/header.php'; ?>

  <!-- Carousel for website -->
  <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="media/ib.jpg" class="d-block w-100" alt="..." height="450vh" width="100%">
        <div class="carousel-caption d-none d-md-block">
          <h5>What about your ideas?</h5>
          <p>Try to think and make your ideas into reality(your duty & destiny).</p>
        </div>
      </div> 
    </div>
  </div>

  <h3 class="text-center my-5">All Posts/Contents</h3>

  <div class="row row-cols-1 row-cols-md-3 mx-2 g-5">
    <?php
    include_once '_partials/db.php';
    $state = 'PUBLIC';
    $sql = "select * from posts where state=? ORDER BY dt DESC";
    $stmt = $dbcon->prepare($sql);
    $stmt->execute([$state]);

    while ($result = $stmt->fetch()) {
     echo '
     <div class="col">
     <div class="card">';

     if(empty($result->link)){
      echo '   
      <div class="card-body">
      <h5 class="card-title">'.$result->title.'</h5>
      <p class="card-text">
      '.substr($result->des,0, 400) .'...
      </p>
      <a href="blog.php?id='.$result->sno.'" class="btn btn-success">Start Reading</a>&nbsp;&nbsp;&nbsp;

      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
      <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
      </svg>&nbsp; <small>'.$result->view.'</small &nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
      <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
      </svg>&nbsp; <small>'.substr($result->dt,0,10).'</small>
      </div>
      </div>
      </div>
      ';

    }
    else{

      echo '
      <img src="'.$result->link.'" height="220px" class="card-img-top"
      alt="Hollywood Sign on The Hill" />
      <div class="card-body">
      <h5 class="card-title">'.$result->title.'</h5>
      <p class="card-text">
      '.substr($result->des,0, 400) .'...
      </p>
      <a href="blog.php?id='.$result->sno.'" class="btn btn-success">Start Reading</a>&nbsp;&nbsp;&nbsp;

      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
      <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
      </svg>&nbsp; <small>'.$result->view.'</small> &nbsp;&nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
      <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
      </svg>&nbsp; <small>'.substr($result->dt,0,10).'</small>
      </div>

      </div>

      </div>
      ';
      
    }

  }


  ?>
</div> 
<div class="container my-5">
  <h3 class="text-center mb-4">Top 3 Posts</h3>
  
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
  <!-- <a href="blog.php?id='.$resultTop->sno.'" class="list-group-item">'..'</a> -->
</div>
<?php include_once '_partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>