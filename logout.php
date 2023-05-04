<?php
session_start();
session_unset();
session_destroy();
setcookie("name", "", time() - 86400*30, "/");
setcookie("passwd", "", time() - 86400*30, "/");
header("location: admin_login.php");

?>