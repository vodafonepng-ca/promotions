<?php
//session_start();
if(isset($_SESSION['isadmin'])&&$_SESSION['isadmin']==true){
  $title="Admin";
  include(__DIR__.'../../views/admin/index.php');
}else{

    $title="Admin Login";
  include(__DIR__.'../../views/admin/login.php');
}
 ?>
