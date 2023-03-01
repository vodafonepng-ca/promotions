<?php
$conn = require_once'./controllers/config/db-conn.php';
$verb=$_SERVER["REQUEST_METHOD"];
$response =Array("status"=>"","message"=>"");
switch($verb){
    case "GET":
        echo "Invalid Request";
        break;

        case "POST":
            if(isset($_POST["id"])){
                $sql="DELETE FROM promotions WHERE id=:id";
                try{
                    $statement=$conn->prepare($sql);
                    $qexe=$statement->execute([
                        ':id'=>$_POST["id"]
                        ]);
                        if($qexe){
                            $response["status"]="success";
                            $response["message"]="Promotion Deleted";
                            echo json_encode($response);
                        }else{
                            $respose["status"]="error";
                            $respose["status"]="Promotion Deletion error";
                            echo json_encode($response);
                        }

                }catch(\PDOException $e){

                    $response["status"]="error";
                    $response["message"]="Application Error ".$e->getMessage();
                    echo json_encode($response);

                }


                //echo "Deleting Promotions";
            }else{
                $respose["status"]="error";
                $respose["message"]="Invalid Request data";
                echo json_encode($response);
            }

        break;
}
?>
