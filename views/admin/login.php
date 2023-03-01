<?php
include("./views/includes/head.php");
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
 <body  style="background: url(./public/images/vodafone-png.png); background-size:100%">
 <hr>
 <section class="vh-100">
   <div class="container-fluid h-custom">
       <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-4">
         <h1>Admin Login</h1>
         <form id="loginForm">
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
             <button type="submit" class="btn btn-secondary btn-lg" id="login-btn"
               style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>

           </div>
         </form>
       </div>
     </div>
   </div>
 </section>
 <script type="text/javascript">

   $("#loginForm").on("submit",function(e){
     e.preventDefault()
      const uname=$("#username").val(),passwd=$("#password").val()

      if(uname===""||passwd===""){
        alert("Form fields not  completed");
      }else{
        $.ajax({
          type:"POST",
          url:"/promotions-v.2/admin/login",
          data:{uname,passwd},
          dataType:false,
          cacheData:false,
          beforeSend:()=>{
            $("#login-btn").html('<img src="./public/images/spinner30pxclear.gif" class="img-responsive img-fluid"/>')
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
            $("#login-btn").html("Login")
            alert(err.message)
          }
        })
      }
   })
 </script>
</body>
