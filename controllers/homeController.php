<?php
if($_SERVER["REQUEST_METHOD"]=="GET"){ 
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
   case '/':
      //code
         include("./views/home.php");
   break;
   case '/draws':
         include("./views/home.php");
   break;

   case '/draws/back-to-school-promo':
      // code...
         include("./views/backToSchoolPromo.php");
      break;
   case '/draws/test':
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