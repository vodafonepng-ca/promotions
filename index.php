<?php
    date_default_timezone_set("Pacific/Port_Moresby");
    $project_location = "/promotions";
    $me = $project_location;

    // For get URL PATH
    $request = $_SERVER['REQUEST_URI'];
    $logfile = fopen("./files/logs/".date("dmyH")."logs.txt", "a") or die("Unable to open file!");
    $log = $_SERVER["REMOTE_ADDR"]."| ".$_SERVER["HTTP_USER_AGENT"]." | ".$request."| ".$_SERVER["REQUEST_METHOD"]." |".date("dmY-H:i:s")."\n";
    fwrite($logfile, $log);
    fclose($logfile);
    switch ($request) {
    
        case $me.'/' :
            require "./controllers/homeController.php";
            // echo "Promotions";
        break;
        case $me.'/admin' :
            if($_SERVER["REMOTE_ADDR"]=="127.0.0.1"){

                require "./controllers/AdminController.php";

            }else{
                http_response_code(404);
                include "404.php";
            }
            
            // echo "Promotions";
        break;
        case $me.'/draws':
            // echo "Promotions";
            require "./controllers/homeController.php";
        break;
    
        case $me.'/draws/test' :
            require "./controllers/homeController.php";
        break;
         
        case $me.'/draws/back-to-school-promo':
            require "controllers/homeController.php";
        break;
        
        case $me.'/draws/valentines-promotion':
            //Vodafone valentines-promotion
            require "controllers/homeController.php";
        break;
        case $me.'/draws/loadentries' :
            require "controllers/api/loadEntries.php";
        break;
        case $me.'/draws/load-test-entries' :
            require "controllers/api/loadTestEntries.php";
        break;
        case $me.'/draws/reset-session':
            // echo "Promotions";
            require "./controllers/unset-session.php";
        break;
        case $me.'/api/post' :
            require "controllers/api/apiPostController.php";
        break;

        case $me.'/api/get' :
            require "controllers/api/apiGetController.php";
        break;
        
    case $me.'/api/loadcsv' :
            require "controllers/api/loadcsv.php";
        break;
        case $me.'/api/downloadcsv' :
            require "controllers/api/loadcsv.php";
        break;

        case $me.'/api/promotions' :
            require "controllers/api/promotions.php";
        break;

    case $me.'/get' :
            require "views/contact.php";
        break;

        case $me.'/topup' :
            require "controllers/topupController.php";
        break;
        case $me.'/api/topup' :
            require "controllers/topupController.php";
        break;
       
        break;
        case $me.'/entries' :
            require "controllers/entriesController.php";
        break;

        case $me.'/api/entries' :
            require "controllers/entriesController.php";
        break;

    default:
        http_response_code(404);
        include "404.php";
        break;
    }
