<?php
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
          $target_dir =realpath("./files/entries/");
          $newfileName=date("ymdHis").microtime(true);
          $newName=$newfileName.".".$ext;
          $fileNow=$target_dir. $newName;
          $moveFIle=move_uploaded_file($file_tmp,$fileNow);
          if($moveFIle){
              if(file_exists($fileNow)){
                try {
                  $csvFile=fopen($fileNow,"r");
                      while (($data = fgetcsv($csvFile)) !==false) {
                          for($i=0;$i<sizeof($data);$i++){
                              array_push($entries,$data[$i]);
                          }
                        }
                        $respose["status"]="success";
                        $respose["message"]=$entries;
                      fclose($csvFile);
                      unlink($fileNow);
                      echo json_encode($respose);
                } catch (\Exception $e) {
                  $respose["status"]="error";
                  $respose["message"]="Exception Error ".$e->getMessage();
                  echo  json_encode($respose);
                }
              }else{
                $respose["status"]="error";
                $respose["message"]="Error while trying to retrieve file data";
                   echo  json_encode($respose);
                }
            }else{
              $respose["status"]="error";
              $respose["message"]="Error While Uploading file ".$fileNow;
                 echo  json_encode($respose);
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
      $csvFile=realpath("./files/results/drawresults.csv");
      try {
        $fh= fopen(realpath("./files/results/drawresults.csv"),"w");
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
