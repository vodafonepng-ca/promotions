<?php
$conn = require_once'./controllers/config/db-conn.php';
$verb = $_SERVER["REQUEST_METHOD"];
$response =Array("status"=>"","message"=>"");
switch($verb){
    case "POST":
        if(isset($_POST["id"])){
            $sql = "SELECT *FROM users WHERE id='$_POST[id]'";
            try{
                $statement=$conn->query($sql);
                if($statement){
                    $rows=$statement->fetchAll(PDO::FETCH_ASSOC);
                    $rowsCount=$statement->rowCount();
                    if($rowsCount>0){
                        $dataArr= Array();
                        foreach($rows as $row){
                            array_push($dataArr,$row);
                        }
                        $response["status"] = "success";
                        $response["message"] = $dataArr;
                        echo json_encode($response);
                    }else{
                        $response["status"] = "error";
                    $response["message"] = "Information does not exists";
                    echo json_encode($response);
                    }
                }else{
                    $response["status"] = "error";
                    $response["message"] = "Application Error 2";
                    echo json_encode($response);
                }
            }catch(\PDOException $e){
                    $response["status"] = "error";
                    $response["message"] = "Application Error 1 ".$e->getMessage();
                    echo json_encode($response);
            }
        }else{
            $response["status"] = "error";
            $response["message"] = "Invalid Request Data";
            echo json_encode($response);
        }
        break;
    case "GET":
        break;
    default:
        break;
}
?>
