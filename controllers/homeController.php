<?php
if($_SERVER["REQUEST_METHOD"]=="GET"){ 
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
   case $me.'/':
      //code
         include("./views/home.php");
   break;
   case $me.'/draws':
         include("./views/home.php");
   break;

   case $me.'/draws/back-to-school-promo':
      // code...
         include("./views/backToSchoolPromo.php");
      break;
      // valentines-promotion

      case $me.'/draws/valentines-promotion':
         // code...
            include("./views/backToSchoolPromo.php");
         break;
   case $me.'/draws/test':
      // code...
         include("views/testDraws.php");
      break;
   default:
      // code...
      break;
}

}else{
   echo "Invalid ".$_SERVER["REQUEST_METHOD"]."Request";
}

?>