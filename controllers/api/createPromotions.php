<?php
$req_method = $_SERVER['REQUEST_METHOD'];

switch($req_method){

    case "GET":

        break;
    case "POST":
        $conn = require_once'./controllers/config/db-conn.php';
        $respose =Array("status"=>"","message"=>"");

        if(isset($_POST["promo_name"])&&isset($_POST["startdate"])&&isset($_POST["enddate"])&&isset($_POST["description"])){
          $promotion_link=strtolower(str_replace(' ', '-', $_POST["promo_name"]));

            $q="INSERT INTO promotions(promotion_name,promotion_start_date,promotion_end_date,status,promotions_descript,promotion_link) VALUES(:promoname,:start_dat,:end_date,:status,:description,:promolink)";
            $data=[
                ':promoname'=>$_POST["promo_name"],
                ':start_dat'=>$_POST["startdate"],
                ':end_date'=>$_POST["enddate"],
                ':status'=>'Inactive',
                ':description'=>$_POST['description'],
                ':promolink'=>$promotion_link
                ];
            try{
                $query= $conn->prepare($q);

            $qexe=$query->execute($data);

                if($qexe){
                    $respose["status"] = "success";
                    $respose["message"] = "New Promotion Created";
                    echo json_encode($respose);
                    die();
                }else{

                    $respose["status"] = "error";
                    $respose["message"] = "Problem Creating New Promotions";
                    echo json_encode($respose);
                    die();
                }
            }catch(\PDOException $e){

                    $respose["status"] = "error";
                    $respose["message"] = "Problem Creating New Promotions ".$e->getMessage();
                    echo json_encode($respose);
                    die();
            }


        }else{
            $respose["status"] = "error";
            $respose["message"] = "Data Now Recived";
            echo json_encode($respose);
            exit();
        }


        break;

    default:

        break;
}

?>
