<?php
if(isset($_SESSION['isadmin'])&&$_SESSION['isadmin']==true){
  $conn = require_once './controllers/config/db-conn.php';
if(!isset($id)){

  $respose =Array("status"=>"","message"=>"");
  $q="SELECT * FROM promotions";
  try{
      $statement=$conn->query($q);
      $rows=$statement->fetchAll(PDO::FETCH_ASSOC);
      $rowsCount=$statement->rowCount();

      if($rowsCount>0){
        include("views/admin/promotions.php");

      }else{
        echo "No Promotions Available";
      }

  //echo "You have $count entries register for back to school Promotions draw";
  }catch(\PDOException $e){
      $respose["status"]="error";
      $respose["message"]=$e->getMessage();

      echo json_encode($respose);
  }
}else{

  if(is_numeric($id)){
    $respose =Array("status"=>"","message"=>"");
    $q="SELECT * FROM  promotions WHERE id=$id";
    try{
        $statement=$conn->query($q);
        $rows=$statement->fetchAll(PDO::FETCH_ASSOC);
        $rowsCount=$statement->rowCount();

        include("views/admin/promo.php");

    //echo "You have $count entries register for back to school Promotions draw";
    }catch(\PDOException $e){
        $respose["status"]="error";
        $respose["message"]=$e->getMessage();

        echo json_encode($respose);
    }

  }else{
    echo "Invalid Url format";
  }


}
}else{
  $title="Admin Login";
  include(__DIR__.'../../views/admin/login.php');
}

