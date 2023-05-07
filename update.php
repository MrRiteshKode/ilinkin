<?php

session_start();
if(isset($_COOKIE['name'])){
 $_SESSION['name'] = $_COOKIE['name'];
 $_SESSION['passwd'] = $_COOKIE['passwd'];
}

if(!$_SESSION['name'] == "yourname" && !$_SESSION['passwd'] == "yourpasswd"){
  header("location: admin_login.php");
}


?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Post to Your Blog</title>
  <link rel="icon" type="image/x-icon" href="media/fav.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="static/style.css">
</head>
<body>
  <?php include_once '_partials/header.php'; ?>
   <div class="container my-4">
    <h2 class="text-center"><span class="bg-success mx-2" id="head">Update </span>Your post</h2>
  </div>

  <?php
  include_once '_partials/db.php';
  $idnum = $_GET['id'];
  $selectquery = " select * from posts where sno=:idnum";
  $stmt = $dbcon->prepare($selectquery);
  $stmt->bindparam(':idnum', $idnum);
  $stmt->execute();
$result = $stmt->fetch(); // FETCH_ASSOC, FETCH_OBJ
// echo "<br><pre>";
// print_r($result);



echo  '

<div class="container">
<div class="row g-3 ">
<div class="col-md-6">
<label for="inputEmail4" class="form-label">Title</label>
<input type="text" value="'.$result->title.'" placeholder="Add Title" class="form-control" id="title">
</div>
<div class="col-md-6">
<label for="inputPassword4"  class="form-label">Link</label>
<input type="text" value="'.$result->link.'" placeholder="Add Link" class="form-control" id="link">
</div>
<div class="mb-3">
<label for="exampleFormControlTextarea1"  class="form-label">Tags</label>
<textarea class="form-control"  placeholder="Add Tags" id="tags" rows="3">'.$result->tags.'</textarea>
</div>
<div class="mb-3">
<label for="exampleFormControlTextarea1"  class="form-label">Description</label>
<textarea class="form-control"  placeholder="Add Description" id="desc" rows="18">'.$result->des.'</textarea>
</div>';

?>

<?php

if($result->state == "PUBLIC"){
	echo ' 
  <select style=" border:2px solid white;" name="state" id="state">
  <option selected value="PUBLIC">PUBLIC</option>
  <option  value="PRIVATE">PRIVATE</option>         
  </select> 
  
  <div class="col-12 my-4">
  <button type="submit" id="submit" class="btn btn-primary">Update Post</button>
  </div>
  </div>
  </div>

  
  ';
}
if($result->state == "PRIVATE"){
	echo ' 
  <select style=" border:2px solid white;" name="state" id="state">
  <option  value="PUBLIC">PUBLIC</option>
  <option selected value="PRIVATE">PRIVATE</option>         
  </select> 
  
  <div class="col-12 my-4">
  <button type="submit" id="submit" class="btn btn-primary">Update Post</button>
  </div>
  </div>
  </div>

  
  ';	

}
?>

<script>

  $(document).ready(function(){

    
    $('#submit').click(function(){

      $.post('_partials/updatePost.php',{ 
        title : $('#title').val(),
        link: $('#link').val(),
        tags: $('#tags').val(),
        desc: $('#desc').val(),
        state : $('#state').val(),
        id : '<?php echo $idnum; ?>'
      }, function(data,status){
        alert(data);
      });

    });
  });
</script>

</body>
</html>
