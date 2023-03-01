
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include("head.php")?>
    <title>Topup Page</title>
</head>
<body>
<main class="container-fluid">
    <h1>Thi is the top up page</h1>
<form action="/api/topup" method="post" id="topupform">

<input type="text" name="msisdn" placeholder="phone number">
<input type="number" name="topupamt" placeholder="Top up Amount">
<input type="submit" value="Top Up Now">
</form>
</main>
<script>
    $(document).ready(()=>{
       $("#topupform").on("submit",function(e){
        e.preventDefault()

        //Try block to catch any errors  and preven default exeptions
        try{
            //make a XMLHttp request to the api/topup endpoint
            $.ajax({
                type: 'POST',
                url:"/api/topup",
                data: new FormData(this),
                dataType: false,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:()=>{},

                //get the resposnes  from the server
                success:(re)=>{
                    // parse json format resposnse string inot object format
                        let res=JSON.parse(re)
                    if(res.response==="success"){
                        $("#topupform")[0].reset()
                            alert(res.response_message)
                    }else{
                            alert(res.response_message) 
                    }
                },
                error:(err)=>{
                        alert(err.name)
                }
        })
        }catch(err){
            console.log(err.message)
            console.log(err.name)
        }
     }) 
})
</script>
</body>
</html>