<?php
 function logedinAuth($location){
  if(isset($_SESSION['loggedin'])&&isset($_SESSION['uid'])){
    return true;
  }else{
    include_once $location;
    exit();
  }
 }
