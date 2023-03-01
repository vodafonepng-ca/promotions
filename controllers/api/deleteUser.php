<?php
$conn = require_once'./controllers/config/db-conn.php';

$response =Array("status"=>"","message"=>"");


       
            if(isset($_POST["uid"])){
                $sql="DELETE FROM users WHERE id=:id";
                try{
                    $statement=$conn->prepare($sql);
                    $qexe=$statement->execute([
                        ':id'=>$_POST["uid"]
                        ]);
                        if($qexe){
                            $response["status"]="success";
                            $response["message"]="User Deleted";
                            echo json_encode($response);
                        }else{
                            $respose["status"]="error";
                            $respose["status"]="User Deletion error";
                            echo json_encode($response);
                        }

                }catch(\PDOException $e){

                    $response["status"]="error";
                    $response["message"]="Application Error ";
                    echo json_encode($response);

                }


                //echo "Deleting Promotions";
            }else{
                $respose["status"]="error";
                $respose["message"]="Invalid Request data";
                echo json_encode($response);
            }

    
?>
