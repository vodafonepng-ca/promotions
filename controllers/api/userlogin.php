<?php
$conn = require_once'./controllers/config/db-conn.php';
$response = array('response' =>'' ,'message'=>'' );
$_SESSION["login_trials"] =0;
if(isset($_POST['username'])&&isset($_POST['password'])){
  $sql="SELECT * FROM users WHERE username='$_POST[username]'";

  try {
      $query=  $conn->query($sql);
      $rows=$query->fetch(PDO::FETCH_ASSOC);
      $rowCount=$query->rowCount();
      $data=json_encode($rows);
      if($rowCount===1){
       
        $upass=$rows['password'];
        if($upass===md5($_POST['password'])){
          if($rows['accout_status']==="Active"){

            $_SESSION["loggedin"]=true;
            $_SESSION["uid"]=$rows['id'];
            $_SESSION["user"]=$rows['fullname'];
            
             if($rows['create_promo_prev']==="true"&&$rows['update_promo_prev']==="true"&&$rows['create_user_prev']==="true"&&$rows['update_user_prev']==="true"&&$rows['delete_user_prev']==="true"){
               $_SESSION["isadmin"]=true;
               $_SESSION["isadminuser"]=$rows['fullname'];
             }
            $response['response']='success';
            $response['message']="Login Successful ";
              echo json_encode($response);
                exit();
          }else{
            $response['response']='error';
            $response['message']="You cannot Login now. Your account is ".$rows['accout_status'];
            echo json_encode($response);
              exit();
          }

        }else{
          if(isset($_SESSION["login_trials"])){
            $trial_count=$_SESSION["login_trials"]+1;
          }
        if($trial_count<5){
          $response['response']='error';
            $response['message']="Wrong Password entered. Please try again .".$trial_count;
            echo json_encode($response);
              //exit();
        }else{
          $sequel = "UPDATE users SET account_status='Blocked' WHERE username='$rows[username]'";
          $connn->prepare($sequel)->execute();
          $response['response']='error';
            $response['message']="Your account is blocked due to 5 wrong password attempts";
            echo json_encode($response);
            exit();
        }
            
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
