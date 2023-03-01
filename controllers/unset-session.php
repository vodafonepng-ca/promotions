<?php

session_start();

if (isset($_SESSION["file_loaded"])&&isset($_SESSION["file_name"])) {
    if(file_exists($_SESSION["file_name"])){
        unlink($_SESSION["file_name"]);
        $_SESSION["file_loaded"]=false;
        $_SESSION["file_name"]="";
    }
    
    session_destroy();
}
?>