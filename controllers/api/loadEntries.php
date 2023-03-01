<?php

$conn = require_once './config/db-conn.php';
$respose =Array("status"=>"","message"=>"");

session_start();
if (isset($_SESSION["file_loaded"])&&isset($_SESSION["file_name"])) {
        $entries= array();
       $resEntries=array();
        try {

            if(file_exists($_SESSION["file_name"])){
            $rows = [];
                $csvFile=fopen($_SESSION["file_name"],"r");
             while (($data = fgetcsv($csvFile))!==false) {

                     

                        $rows[] = $data;

                    }
                        
                fclose($csvFile);

                $headers = array_shift($rows);
                    // Combine the headers with each following row
                 $array = [];
                foreach ($rows as $row) {

                        $array[] = array_combine($headers, $row);
                        
                    }
                    foreach ($array as $data){

                         array_push($entries,$data["msisdn"]);

                        }
               
                $respose["status"]="success";
                $respose["message"]=$entries;
                echo json_encode($respose);
            }else{
                $respose["status"]="error";
                $respose["message"]="Entries not Avaialble";
                echo json_encode($respose);  
            }
            
                        
                }catch (\Exception $e) {
                    $respose["status"]="error";
                    $respose["message"]="Exception Error ".$e->getMessage();
                    echo  json_encode($respose);
                }
        }else{
                try{
                    $q = "SELECT msisdn FROM entries";
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
                            $respose["message"]="Entries not available. Please upload entries via a csv file or contact the development Team";
                            echo json_encode($respose);

                        }
                
                //echo "You have $count entries register for back to school Promotions draw"; 
                }catch(\PDOException $e){
                    $respose["status"]="error";
                    $respose["message"]=$e->getMessage();
                    
                    echo json_encode($respose);
                }

        }
?>