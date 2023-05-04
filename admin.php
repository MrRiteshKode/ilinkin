<?php
session_start();
if(isset($_COOKIE['name'])){
 $_SESSION['name'] = $_COOKIE['name'];
 $_SESSION['passwd'] = $_COOKIE['passwd'];
}

if(!isset($_SESSION['name']) && !isset($_SESSION['passwd'])){
  header("location: admin_login.php");
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Page - iLinkin</title>
  <link rel="icon" type="image/x-icon" href="media/fav.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="static/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<style type="text/css">
  a {
    text-decoration: none;
    color: white;
  }


</style>
<body style="background-color:#EAEFF2;">
 <?php include_once '_partials/header.php'; ?>
  <?php
 if(!empty($_GET['login'])){
  echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You are successfully logged in admin-panel.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
  ';
 }

 ?>
 <h2 class="text-center my-4">Do action in your Blog <span type=""  class="btn btn-success"><a target="_blank" id="add" href="post.php">Add</a></span></h2>



 <div class="table-responsive container">
   <table class="table bg-white ">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Blog(Title)</th>
        <th scope="col">State</th>
        <th scope="col">Update</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $idNo = 0;
      include_once '_partials/db.php';
      $query = "SELECT * FROM `posts` ORDER BY dt DESC";
      $stmt = $dbcon->prepare($query);
      $stmt->execute();

      while ($result = $stmt->fetch()) {
        echo '
        <tr id="'.$result->sno.'">
        <th scope="row">'.++$idNo.'</th>
        <td>'.$result->title.'</td>
        <td>'.$result->state.'</td>
        <td><a target="_blank" class="btn btn-primary" href="update.php?id='.$result->sno.'">Update</a></td>
        <td><button class="btn btn-danger delete" id="'.$result->sno.'">Delete</button></td>
        </tr> 
        ';
      }

      ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function(){

    $("button.delete").click(function(event){
      if(confirm("Are you sure") == true){
        $.post('_partials/delete.php',{ 
          id : event.target.id,
          
        }, function(data,status){
        // $('#changehere').html(data);
        // alert(data);
          idName = event.target.parentNode.parentNode.id
          document.getElementById(idName).style.display = "none";
        });
      }
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>