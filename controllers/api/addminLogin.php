<?php
$conn = require_once'./controllers/config/db-conn.php';
$response = array('response' =>'' ,'message'=>'' );
if(isset($_POST['uname'])&&isset($_POST['passwd'])){
  $sql="SELECT * FROM users WHERE username='$_POST[uname]'";

  try {
    //  TL@NE6ah
      $query=  $conn->query($sql);
      $rows=$query->fetch(PDO::FETCH_ASSOC);
      $rowCount=$query->rowCount();
      $data=json_encode($rows);
      if($rowCount===1){
        $upass=$rows['password'];
        if($upass===md5($_POST['passwd'])){
          if($rows['create_promo_prev']=="true"||$rows['create_user_prev']=="true"){
            //&&$rows['update_user_prev']=="true"&&$rows['delete_user_prev']=="true"
            $_SESSION["isadmin"]=true;
            $_SESSION["isadminuser"]=$rows['fullname'];
            $_SESSION['admin_user_previlleges']=['create_promo'=>$rows['create_promo_prev'],'create_user'=>$rows['create_user_prev']];
              $response['response']='success';
              $response['message']="Login Successful ";
              echo json_encode($response);
                exit();
          }else{
            $response['response']='error';
            $response['message']="You are not an admin user";
            echo json_encode($response);
              exit();
          }


        }else{
            $response['response']='error';
            $response['message']="User credentials does not match";
            echo json_encode($response);
              exit();
        }
      }else{
          $response['response']='error';
          $response['message']="Username Does Not Exist";
          echo json_encode($response);
            exit();
      }
  } catch (\PDOException $e) {
      $response['response']='error';
      $response['message']="Application Error 1";
      echo json_encode($response);
    exit();
  }
}else{
  $response['response']='error';
  $response['message']="Form data not received";
  echo json_encode($response);
  exit();
}
