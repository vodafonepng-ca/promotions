<?php
$reqestmethod = $_SERVER["REQUEST_METHOD"];
switch ($reqestmethod) {
    case 'POST':
        $respose = array("status" => "", "message" => "");
        $respose["status"] = "error";
        $respose["message"] = "Unknown request Enpoint";
        echo json_encode($respose);
        break;
    case 'GET':
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>404 | Unknow Location</title>
            <style>
                body {
                    garin: 0;
                    background-color: black;
                    color: red;
                    font-family: Verdana, Arial, Helvetica, sans-serif;
                }

                .container {
                    width: 500px;
                    margin: auto;
                }

                .container h1 {
                    text-align: center;
                    font-size: 3rem;
                    font-weight: 200;
                }
            </style>
        </head>

        <body>
            <div class="container">
                <h1>Unknown Location</h1>
                <a href="/promotions/">Go Back</a>
            </div>
        </body>

        </html>

<?php

    default:
        # code...
        break;
}

?>