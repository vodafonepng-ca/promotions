<?php

$conn = require_once './controllers/config/db-conn.php';


if(isset($_FILES['coverphoto'])&&isset($_POST['promoid'])){
  $accept = ["image/jpg", "image/jpeg", "image/gif", "image/png"];
  if(!in_array($_FILES['coverphoto']['type'],$accept)){
    echo "Invalid file type. Please upload an image file";
  }else{
    $upload_dir = "./public/images/uploads/";
    $file = $_FILES['coverphoto']["name"];
    $tempFile = $_FILES['coverphoto']["tmp_name"];
    $file_ext=pathinfo( $_FILES["coverphoto"]["name"], PATHINFO_EXTENSION ); ;
    $newFile = date("YmdHis").round(microtime(true)) .'.' .$file_ext;
    //echo $newFile;
    $move_to_dir = $upload_dir . $newFile;
    $move_file = move_uploaded_file($_FILES['coverphoto']["tmp_name"], $move_to_dir);
    if($move_file===true){
       //'$newFile'
      //$_POST[promoid]'
      $sql = "UPDATE promotions SET coverImage=:image WHERE id=:id";
      try{
        $statement=$conn->prepare($sql)->execute([
          ':image'=>$newFile,
          'id'=>$_POST['promoid']
          ]);
          if($statement){
            echo "Cover Photo uploade suceeded";
          exit();
          }else{
            if(file_exists($move_to_dir)){
                unlink($move_to_dir);
            }
            echo "Cannot upload photo";
            exit();
          }

      }catch(\PDOException $e){
        echo $e->getMessage();
        exit();
      }

      
      exit();
    }else{
      echo "File upload failedd";
      exit();
    }

  }
  //echo $_FILES['coverphoto']['type'];
}
