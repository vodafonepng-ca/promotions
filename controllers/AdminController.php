
<?php
$reqtype=$_SERVER["REQUEST_METHOD"];


switch ($reqtype) {
    case 'GET':
        include "./views/Admin.php";
        break;
    case 'POST':
        
        break;
    default:
        # code...
        break;
}


?>
