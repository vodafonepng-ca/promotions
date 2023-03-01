<?php
$response = array('response' =>'' ,'message'=>'' );
if(isset($_SESSION['isadmin'])&&$_SESSION['isadmin']==true){
    unset($_SESSION['isadmin']);
    unset($_SESSION['isadminuser']);
    $response['response']="success";
    $response['message']="Loged out of the Admin Panel";
    echo json_encode($response);
    exit();
}else{

      $response['response']="error";
      $response['message']="System error";
      echo json_encode($response);
      exit();

}
