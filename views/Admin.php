<!DOCTYPE html>
<html>
  <head>
  <title> ADMIN| VFPNG Promotions</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
  <body >
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Admin</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Promotions
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" id="running-promo" href="#running-promotions">Running Promotions</a>
          <a class="dropdown-item" id="upcomming-promotions" href="#upcomming-promotions">Upcomming Promotions</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" id="new-promotions" href="#new-promotions">New Promotions</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    
  </div>
</nav>
    <div class="container">
        <div class="card">
            <div class="card-header">
            <h1 class="text-muted text-uppercase">Admin Pannel</h1>
            </div>
            <div class="card-body" id="admin-pannel">
            </div>
        </div>
    </div>
    <script src="/promotions/js/jquery-latest.min.js"></script>
    <script>
        $(document).ready(()=>{
            $.ajax({
                type:"GET",
                url:"/promotions/api/promotions",
                beforeSend:()=>{
                    $("#admin-pannel").html("<p class='text-center text-muted'>Loading Information....</p>")
                },
                success:(res)=>{
                    let data=JSON.parse(res);
                    if(data.status==="error"){
                        $("#admin-pannel").html("<p class='text-center text-muted'>No  Data Vailabe</p>") 
                    }else{
                        $("#admin-pannel").html(res)
                    }
                            
                },
                error:(err)=>{
                    alert(err.message)
                }
            
            })  
        })
        $("#new-promotions").on("click",()=>{

            let myForm=document.createElement('form')
            $(myForm).attr("id","promoregform")

            let formMainDiv="<div class='row'></div>"
            let formElements='<div class="col-md-4"><div class="form-group"><label>Promotions Name</label><input tyep="text" id="promoname" name="promoname"><div><div>'
            $(formMainDiv).append(formElements)

            $(myForm).append(formMainDiv)
            $("#admin-pannel").html(myForm)
        })
    </script>
</body>
</html>