<?php
$conn = require_once'./controllers/config/db-conn.php';
$respose=Array('status'=>'','message'=>'');

  if(isset($_FILES["upfile"])){
       $entries= array();
       $resEntries=array();
      if($_FILES['upfile']["error"]){
        $respose["status"]="error";
        $respose["message"]=$_FILES['upfile']["error"];
           echo  json_encode($respose);
      }else{

        try {
          $file_name = $_FILES['upfile']['name'];
          $file_size =$_FILES['upfile']['size'];
          $file_tmp =$_FILES['upfile']['tmp_name'];
          $file_type=$_FILES['upfile']['type'];
          $fileNameParts = explode('.', $file_name);
          $ext = end($fileNameParts);
          if($ext!=="csv"){
            $respose["status"]="error";
                $respose["message"]="Invalid file format Please Upload a .csv file";
                echo  json_encode($respose);
                die();
          }else{
            // ./public/files/entries/
            $target_dir ="./public/files/entries/";
          $newfileName=date("ymdHis").microtime(true);
          $newName=$newfileName.".".$ext;
          $fileNow=$target_dir.$newName;
          $moveFIle=move_uploaded_file($file_tmp,$fileNow);

          if($moveFIle){
            $csvFile=fopen( $fileNow,"r");
            $rows = [];
            while (($data = fgetcsv($csvFile))!==false) {

            $rows[] = $data;

          }
          fclose($csvFile);
          $array = [];
          $headers = array_shift($rows);
          foreach ($rows as $row) {

            $array[] = array_combine($headers, $row);

        }

          $a1=$array[0];
          if(!array_key_exists("msisdn",$a1)){
                $respose["status"]="error";
                $respose["message"]="File missing the 'msisdn field. Please include msisdn field' ";
                echo  json_encode($respose);
                unlink($fileNow);
                die();
          }else{
            // session_start();
                $_SESSION["file_loaded"]=true;
                $_SESSION["file_name"]=$fileNow;
                $respose["status"]="success";
                $respose["message"]="File Uploaded Successfully " ;
                echo  json_encode($respose);
          }




            }else{

              $respose["status"]="error";
              $respose["message"]="Error While Uploading file ".$fileNow;
              echo  json_encode($respose);
              die();

          }
          }

        } catch (\Exception $e) {

          $respose["status"]="error";
          $respose["message"]="Exception Error ".$e->getMessage();
          echo  json_encode($respose);

        }
      }
  }


  if(isset($_POST["results"])){
      $date=date ("d/m/Y");
      $headers=array("Draw","Wining Number","Date");
      $count=1;
      $resultArray=array("id"=>"","number"=>"","date"=>"");
      $a1 = array();
      $csvFile="./public/files/results/drawresults.csv";
      try {
        $fh= fopen($csvFile,"w");
         fputcsv($fh, $headers);
         foreach($_POST["results"] as $winner){
             $resultArray["id"]= $count;
             $resultArray["number"]=$winner;
             $resultArray["date"]=$date;
             array_push($a1,$resultArray);
             $count=$count+1;
         }
         foreach($a1 as $fields){
              fputcsv($fh, $fields);
         }
         if(file_exists($csvFile)){
             header("Cache-Control:public");
             header("Content-Desccription:File Transfer");
             header("Content-Despostion:attachement;filename=$csvFile");
             header("Content-Type:application/csv; charset=UTF-8");
             header("Content-Transfer-Encoding:binary");
             readfile($csvFile);
             exit();
         }else{
           echo json_encode("Oh! Nooo...");
           die();
         }
      } catch (\Exception $e) {
        echo json_encode($e->getMessage());
        die();
      }
  }
