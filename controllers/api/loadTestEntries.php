<?php
//$msisdn=$_REQUEST["msisdn"];
        $conn = require_once './config/db-conn.php';
        $respose =Array("status"=>"","message"=>"");
        $q="SELECT msisdn FROM test_entries";
        try{
            $statement=$conn->query($q);
        $rows=$statement->fetchAll(PDO::FETCH_ASSOC);
        $rowsCount=$statement->rowCount();
        $entryData=[];
        foreach($rows as $row){
            array_push($entryData,$row['msisdn']);
        }
        if(count($entryData)>0){
            $respose["status"]="success";
            $respose["message"]=$entryData;
            echo json_encode($respose);
        }else{
            $respose["status"]="error";
            $respose["message"]="No Entries Available";
          echo json_encode($respose);
        }
        
        //echo "You have $count entries register for back to school Promotions draw"; 
        }catch(\PDOException $e){
            $respose["status"]="error";
            $respose["message"]="Application Error. Please Contact the Development Team";
            
            echo json_encode($respose);
        }
        


?>