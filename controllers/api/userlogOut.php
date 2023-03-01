<?php


$response = array('response' =>'' ,'message'=>'' );
if(isset($_SESSION["loggedin"])&&isset($_SESSION["uid"])&&isset($_SESSION["user"])){
  // if(isset($_POST['logout'])){
    unset($_SESSION["loggedin"]);
    unset($_SESSION["uid"]);
    unset($_SESSION["user"]);
    $response['respose']='success';
    $response['message']="Logge out successfully";
    echo json_encode($response);
    exit();
  // }else{
  //   $response['respose']='error';
  //   $response['message']="User date no recived";
  //   echo json_encode($response);
  //   exit();
  // }

}else{
  $response['respose']='error';
  $response['message']="User date no set";
  echo json_encode($response);
  exit();
}
