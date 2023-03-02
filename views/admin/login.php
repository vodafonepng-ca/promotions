<?php
$title = "Admin login";

//  include(__DIR__."./includes/head.php");
?>


<html>

<head>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link rel="icon" type="/promotions/public/image/x-icon" href="/promotions/public/images/vf-icon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Lato:wght@300;700&display=swap');

    body {
      margin: 0;
      font-family: 'Lato', sans-serif;
    }

    .background-radial-gradient {
      background-color: hsl(353, 77%, 19%);
      background-image: radial-gradient(650px circle at 0% 0%,
          hsl(356, 61%, 27%) 15%,
          hsl(356, 61%, 30%) 35%,
          hsl(356, 61%, 20%) 75%,
          hsl(356, 61%, 19%) 80%,
          transparent 100%),
        radial-gradient(1250px circle at 100% 100%,
          hsl(356, 61%, 45%) 15%,
          hsl(356, 61%, 30%) 35%,
          hsl(356, 61%, 20%) 75%,
          hsl(357, 61%, 19%) 80%,
          transparent 100%);
      background-size: 100%;
      background-repeat: no-repeat;
    }

    #radius-shape-1 {
      height: 210px;
      width: 210px;
      top: -90px;
      left: -130px;
      background: radial-gradient(#870312, #28010d);

      overflow: hidden;
      box-shadow: 1px 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    #radius-shape-3 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      height: 110px;
      width: 110px;
      bottom:100px;
      left: -130px;

      background: radial-gradient(#cd041c, #28010d);
      overflow: hidden;
      box-shadow: 1px 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .bg-glass {
      background-color: hsla(0, 0%, 100%, 0.5) !important;
      backdrop-filter: saturate(200%) blur(25px);
    }

    .main {
      width: 100%;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -300px;
      right: -90px;
      width: 200px;
      height: 200px;
      background: radial-gradient(#cd041c, #28010d);
      overflow: hidden;
      box-shadow: 1px 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    #radius-shape-4 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -90px;
      left: -90px;
      width: 150px;
      height: 150px;
      background: radial-gradient(#870312, #28010d);

      overflow: hidden;
      box-shadow: 1px 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    @media(max-width:1200px) {
      #radius-shape-2 {

        bottom: -60px;
        right: 2px;
        width: 200px;
        height: 200px;

        overflow: hidden;
      }

      #radius-shape-3 {

        height: 110px;
        width: 110px;
        bottom: -90px;
        left: -5px;


      }

      .shrink-hide {
        display: none;
      }
    }
  </style>

</head>

</html>

<body style="background: url(/promotions/public/images/vodafone-png.png); background-size:100%">
  <hr>
  <section class="vh-100 p-5">
    <div class="container-fluid h-custom">
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-4">
      
         <div class="card bg-glass">
            <div class="card-body">
            <h1>Admin Login</h1>
        <form id="loginForm">
          <div class="form-outline mb-4">
            <input name="username" type="text" id="username" class="form-control form-control-lg" placeholder="Enter Username" />
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
            <button type="submit" class="btn btn-danger btn-lg" id="login-btn" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
          </div>
        </form>
            </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  
  <script src="/promotions/public/js/jquery-latest.min.js"></script>
  <script type="text/javascript">
    $("#loginForm").on("submit", function(e) {
      e.preventDefault()
      const uname = $("#username").val(),
        passwd = $("#password").val()
      if (uname === "" || passwd === "") {
        alert("Form fields not  completed");
      } else {
        $.ajax({
          type: "POST",
          url: "/promotions/admin/login",
          data: {
            uname,
            passwd
          },
          dataType: false,
          cacheData: false,
          beforeSend: () => {
            $("#login-btn").html('<img src="./public/images/spinner30pxclear.gif" class="img-responsive img-fluid"/>')
          },
          success: (res) => {
            let resdata = JSON.parse(res)
            if (resdata.response == "success") {
              $("#login-btn").html("Login Succeeded")

              setTimeout(() => {
                window.location.replace("")
              }, 500)
            } else {
              $("#login-btn").html('Login ')
              alert(resdata.message)

            }
          },
          error: (err) => {
            $("#login-btn").html("Login")
            alert(err.message)
          }
        })
      }
    })
  </script>
</body>