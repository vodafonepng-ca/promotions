<?php

$reqtype=$_SERVER["REQUEST_METHOD"];
switch($reqtype){
    case "GET":
        include("./views/entriesPage.php");
        break;
    case "POST":

    if(isset($_REQUEST["msisdn"])&&$_REQUEST["msisdn"]!==""){
        $msisdn=$_REQUEST["msisdn"];
        $conn = require_once './config/db-conn.php';
        $q="SELECT* FROM entries WHERE msisdn='$msisdn'";
        $rows=$conn->query($q);
        $count=$rows->rowCount();
        echo "You have $count entries register for back to school Promotions draw"; 

    }
    
    break;
        default:

}

?>