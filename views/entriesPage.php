
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/vf-icon.png">
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/foundation.min.css" />
    <link rel="stylesheet" href="./css/cosmo.css" />
    <link rel="stylesheet" href="./css/main.css" />
    <script src="js/jquery-latest.min.js"></script>
    <title>Topup Page</title>
</head>
<body style="background: #e78e8e url(./images/light3.jpg);">
<main class="container-fluid">
    <h1>Thi is the top up page</h1>
<form action="/entries" method="post" id="entriesform">

<input type="text" name="msisdn" placeholder="phone number">

<input type="submit" value="Request your Promo Entries">
</form>
</main>
<script>
    $(document).ready(()=>{
        $("#entriesform").on("submit",function(e){
            e.preventDefault()
            $.ajax({
                type: 'POST',
                url:"/api/entries",
                data: new FormData(this),
                dataType: false,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:()=>{
                },
                success:(res)=>{
                    alert(res)
                },
                error:(err)=>{
                    alert(err.message)
                }

            })
        })
    })
</script>
</body>
</html>