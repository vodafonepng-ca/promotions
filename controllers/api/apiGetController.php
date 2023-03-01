<?php
    if($_SERVER["REQUEST_METHOD"]==="GET"){
        echo "Request from the API";
    }else{
        echo $_SERVER["REQUEST_METHOD"]." Request is not allowed";

    }
?>