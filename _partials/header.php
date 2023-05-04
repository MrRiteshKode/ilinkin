<?php
if(isset($_COOKIE['name'])){
 $_SESSION['name'] = $_COOKIE['name'];
 $_SESSION['passwd'] = $_COOKIE['passwd'];
}

?>
<nav class="navbar navbar-expand-lg navbar-light bg-white ">
  <div class="container-fluid">
    <a class="navbar-brand bg-success" id="head" href="index.php">iLinkin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active fs-5" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active fs-5" href="portfolio.php">Portfolio</a>
        </li>
        <?php
        if(isset($_SESSION['name']) && isset($_SESSION['passwd'])){
          echo '
          <li class="nav-item">
          <a target="_blank" class="nav-link active fs-5" href="admin_login.php">Admin</a>
          </li>
          <li class="nav-item">
          <a class="nav-link active fs-5" href="logout.php">Logout</a>
          </li>
          ';
        }
        else
        {
          echo '
          <li class="nav-item">
          <a target="_blank" class="nav-link active fs-5" href="admin_login.php">Admin</a>
          </li>
          ';
        }
        ?>
        
      </ul>
      <div class="d-flex" role="search">
        <input class="form-control me-2" type="search" value="<?php if(isset($_GET['q'])){echo $_GET['q'];} ?>" id="search" placeholder="Search" aria-label="Search">
        <a class="btn btn-outline-success" type="" id="sBtn">Search</a>
      </div>
    </div>
  </div>
</nav>
<script type="text/javascript">
  
 $("#sBtn").click(function(){
   
  if($("#search").val().length > 0){
    window.location.href = "search.php?q="+$("#search").val();
  }
});
</script>