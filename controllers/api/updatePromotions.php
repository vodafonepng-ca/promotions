<?php
$conn = require_once'./controllers/config/db-conn.php';
$verb = $_SERVER["REQUEST_METHOD"];
$response =Array("status"=>"","message"=>"");
switch($verb){
    case "POST":
        if(isset($_POST['promoname'])&&isset($_POST['description'])){

            $sql = "UPDATE promotions SET promotion_name=:name,promotions_descript=:description,promotion_start_date=:start_date,promotion_end_date=:end_data,status=:status WHERE id=:id";

            try{

                $statement=$conn->prepare($sql);

                $qexec=$statement->execute([
                    ':name'=>$_POST["promoname"],
                    ':description'=>$_POST["description"],
                    ':start_date'=>$_POST["startdate"],
                    ':end_data'=>$_POST["enddate"],
                    ':status'=>$_POST["status"],
                    ':id'=>$_POST["id"]
                    ]);

                    if($qexec){

                        $response["status"] = "success";
                        $response["message"] = "Promotion Updated";
                        echo json_encode($response);

                    }else{

                        $response["status"] = "error";
                        $response["message"] = "Application Error 2 ";
                        echo json_encode($response);

                    }
            }catch(\PDOException $e){

                    $response["status"] = "error";
                    $response["message"] = "Application Error 1 ".$e->getMessage();
                    echo json_encode($response);
            }
        }else{

            $response["status"] = "error";
            $response["message"] = "Invalid Request data Recived";
            echo json_encode($response);

        }
        break;
    case "GET":
        break;
    default:
        break;
}
?>
