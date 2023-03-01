<?php
$req=$_SERVER["REQUEST_METHOD"];

    switch ($req) {
        case 'GET':
            $conn = require_once './config/db-conn.php';
            $respose =Array("status"=>"","message"=>"");
            $q="SELECT * FROM promotions";
            try{
                $statement=$conn->query($q);
            $rows=$statement->fetchAll(PDO::FETCH_ASSOC);
            $rowsCount=$statement->rowCount();
            $entryData=[];
            foreach($rows as $row){
                array_push($entryData,$row);
            }
            if(count($entryData)>0){
                $respose["status"]="success";
                $respose["message"]=$entryData;
                echo json_encode($respose);
            }else{
                $respose["status"]="error";
                $respose["message"]="No Entreis Data";
              echo json_encode($respose);
            }
            
            //echo "You have $count entries register for back to school Promotions draw"; 
            }catch(\PDOException $e){
                $respose["status"]="error";
                $respose["message"]=$e->getMessage();
                
                echo json_encode($respose);
            }
            break;
    case 'POST':
                # code...
        break;
        default:
            # code...
            break;
    }
?>