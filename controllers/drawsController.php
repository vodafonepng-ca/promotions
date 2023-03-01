<?php
$conn = require_once'./controllers/config/db-conn.php';
logedinAuth("views/login.php");
if(isset($drawname)){
  $stmt=$conn->query("SELECT *FROM promotions WHERE id='$drawname'");
  $rows=$stmt->fetch();
  $count=$stmt->rowCount();
  if($count>0){
    if($rows["status"]!=="Active"){
      $title="Inactive";
      $status="This Promotion is not Active";
        $details="Please contact your system administrator";
      include("views/statusError.php");
    }else{
        include("views/draws.php");
    }
  }else{
      $title="404 | Not available";
      $status="Promotion Not available";
      $details="This might be happening because: The resource is removed, moved to a different location or the link you have followed was broken";
     include("views/404.php");
  }
}else{
      include("views/home.php");
}
