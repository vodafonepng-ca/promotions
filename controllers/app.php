<?php

function view($location){
        $target_file=__DIR__."./views/".$location.".php";
        if(file_exists($target_file)){

                include($target_file) ;
                
                exit();
        }else{
                echo "the Specified View does not exist";
        }
}
?>