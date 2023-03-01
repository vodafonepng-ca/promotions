<?php

$reqtype=$_SERVER["REQUEST_METHOD"];
switch($reqtype){
    case "GET":
        include("./views/topuppage.php");
        break;
    case "POST":
        $conn = require_once './config/db-conn.php';
        $response=array("response"=>"","response_message"=>"");
        if(isset($_REQUEST["msisdn"])&&$_REQUEST["msisdn"]!==""&&isset($_REQUEST["topupamt"])&&$_REQUEST["topupamt"]!==""){
            $msisdn= $_POST["msisdn"];
            $topupamount=number_format($_POST["topupamt"]);
            if($topupamount>=5){
                $entrieRec=[];
                $q='INSERT INTO entries(msisdn) VALUES(:msisdn)';
                $statement= $conn->prepare($q);
                $entries=floor($topupamount/5);
                $ptlural;

                if($entries>1){

                        $plural='entries';
                }else{
                        $plural='entry';
                }

                for($i=0;$i<$entries;$i++){

                    array_push($entrieRec,$msisdn);  

                }

                foreach($entrieRec as $number ){

                     $statement->execute([':msisdn'=>$number]);
                     
                }
                        $response["response"]="success";
                        $response["response_message"]="Congradulations! You have $entries $plural  now for The  BACK TO SHOOL PROMOTIONS DRAW";
                        echo json_encode($response);
            }else{

                $response["response"]="success";
                $response["response_message"]="Topup K 5.00 or more for your chance to Go into the BACK TO SCHOOL PROMOTIONS DRAW";
                echo json_encode($response);
            }
        }else{
            $response["response"]="error";
            $response["response_message"]="Request Error";
            echo json_encode($response);
        }
        default:

}

?>