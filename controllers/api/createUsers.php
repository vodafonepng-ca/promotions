<?php

      $conn = require_once'./controllers/config/db-conn.php';
      $response = array('response' =>'' ,'message'=>'' );
if(isset($_POST['super_admin'])&&isset($_POST['portal_admin'])&&isset($_POST['content_creator'])&&isset($_POST['portal_user'])&&isset($_POST['fullname'])&&isset($_POST['phone'])&&isset($_POST['email'])&&isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST["status"])){

        $fullname=$_POST['fullname'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $password=md5($_POST['password']);
        //set all user previliges to false;
        $create_promo_prev="false";
        $update_promo_prev="false";
        $create_user_prev="false";
        $update_user_prev="false";
        $delete_user_prev="false";
        $accout_status=$_POST["status"];



        if($_POST['super_admin']=="true"){
            $create_user_prev="true";
            $delete_user_prev="true";
            $update_user_prev="true";
            $update_promo_prev="true";
            $create_user_prev="true";
        }

        if($_POST['portal_admin']=="true"&&$_POST['super_admin']=='false'){
               $create_promo_prev="true";
               $update_promo_prev="true";
               $create_user_prev="false";
               $update_user_prev="false";
               // $delete_user_prev="false";
        }

        if($_POST['content_creator']=="true"){
               $create_promo_prev="true";
               $update_promo_prev="true";

        }
        $sql="INSERT INTO users (fullname,username,email,phone,password,create_promo_prev,update_promo_prev,create_user_prev,update_user_prev,delete_user_prev,accout_status) VALUES(:fullname,:username,:email,:phone,:password,:create_promo_prev,:update_promo_prev,:create_user_prev,:update_user_prev,:delete_user_prev,:accout_status)";
        $phonesql="SELECT* FROM users WHERE phone='$phone'";
        $emailsql="SELECT* FROM users WHERE email='$email'";
        $usersql="SELECT* FROM users WHERE username='$username'";
        try {
          $stmt1=$conn->query($phonesql)->rowCount();
          $stmt2=$conn->query($emailsql)->rowCount();
          $stmt3=$conn->query($usersql)->rowCount();
          if($stmt1>0){

            $response['response']="error";
            $response['message']="Phone number is in use. Use a different phone number";
            echo json_encode($response);
          die();

          }
          if($stmt2>0){

            $response['response']="error";
            $response['message']="Email is in Use. Use different email";
            echo json_encode($response);
          die();
          }
          if($stmt3>0){
            $response['response']="error";
            $response['message']="Username is in use. Try another username";
            echo json_encode($response);

          die();
          }
          $stmt=$conn->prepare($sql)->execute([
            ':fullname'=>$fullname,
            ':username'=>$username,
            ':email'=>$email,
            ':phone'=>$phone,
            ':password'=>$password,
            ':create_promo_prev'=>$create_promo_prev,
            ':update_promo_prev'=>$update_promo_prev,
            ':create_user_prev'=>$create_user_prev,
            ':update_user_prev'=>$update_user_prev,
            ':delete_user_prev'=>$delete_user_prev,
            ':accout_status'=>$accout_status
          ]);
          if($stmt){

            $response['response']="success";
            $response['message']="User created Successfully";
            echo json_encode($response);
            die();
          }else {
            $response['response']="error";
            $response['message']="User not created";
            echo json_encode($response);

            die();
          }

        } catch (\PDOException $e) {

          $response['response']="error";
          $response['message']="Application Error";
          echo json_encode($response);
          die();

        }

    }else{

      $response['response']="error";
      $response['message']="Form Data  not Received";
      echo json_encode($response);

      die();
    }
