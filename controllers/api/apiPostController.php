<?php
    if($_SERVER["REQUEST_METHOD"]==="POST"){

        if(isset($_POST["msisdn"])&&isset($_POST["topupamt"])){
            $msisdn= $_POST["msisdn"];
            $topupamount=number_format($_POST["topupamt"]);
           // $query=Array("msisdn"=>$msisdn,"topupamt"=>$topupamount);
            echo json_encode("Respost Contact");
          $conn = require_once'./controllers/config/db-conn.php';
            $entrieRec=[];
            $q='INSERT INTO entries(msisdn) VALUES(:number)';
           $statement= $conn->prepare($q);
            $entries=floor($topupamount/5);

            for($i=0;$i<$entries;$i++){
                array_push($entrieRec,$msisdn);

            }
        foreach($entrieRec as $number ){
            $statement->execute([
                ':number'=>$number
                ]);
        }
        echo "Congradualtions You no have $entries entriess in the text and wind Promotions";
        echo json_encode($entrieRec);
        }


    }else{

        echo $_SERVER["REQUEST_METHOD"]." Request is not allowed";

    }

?>
