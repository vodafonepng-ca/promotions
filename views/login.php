<?php
$title="User login";
include(__DIR__."./includes/head.php");
 ?>
 <style media="screen">
 .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}
 </style>
 <body  style="background: url(/promotions-v.2/public/images/vodafone-png.png); background-size:100%">
 <hr>
 <section class="vh-100">
   <div class="container-fluid h-custom">
       <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-4">
         <h1>User Login </h1>
         <form id="userLoginForm" action="" method="post">
           <div class="form-outline mb-4">
             <input name="username" type="text" id="username" class="form-control form-control-lg"
               placeholder="Enter Username" />
             <label class="form-label" for="form3Example3">Username</label>
           </div>
           <!-- Password input -->
           <div class="form-outline mb-3">

               <input name="password" type="password" id="password" class="form-control form-control-lg" placeholder="Enter Password">
             <label class="form-label" for="form3Example4">Password</label>
           </div>
           <div class="d-flex justify-content-between align-items-center">
             <!-- Checkbox -->
             <div class="form-check mb-0">
               <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
               <label class="form-check-label" for="form2Example3">
                 Remember me
               </label>
             </div>
           </div>
           <div class="text-center text-lg-start mt-4 pt-2">
             <button type="submit" class="btn btn-primary btn-lg" id="login-btn"
               style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
           </div>
         </form>
       </div>
     </div>
   </div>
 </section>
 <script>
 $(document).ready(()=>{

$("#userLoginForm").on("submit",function(e){
  e.preventDefault()

let username=$("#username").val(),password=$("#password").val()
if(username===""||password===""){
  alert("Please fill in all the Details");
}else{
  $.ajax({
    type:"POST",
    url:"/promotions-v.2/login",
    data:{username,password},
    dataType:false,
    contentTye:false,
    cacheData:false,
    beforeSend:()=>{
    },
    success:(res)=>{
      let resdata=JSON.parse(res)
      if(resdata.response=="success"){
        $("#login-btn").html("Login Succeeded")
        setTimeout(()=>{
          window.location.replace("")
        },500)
      }else{
        $("#login-btn").html('Login ')
        alert(resdata.message)
      }
    },
    error:(err)=>{
      alert(err.message)
    }
  })
}

})

})

 </script>
</body>
</html>
