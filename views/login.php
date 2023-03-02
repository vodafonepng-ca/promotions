<?php
$title = "User login";

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
      bottom: -90px;
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
      bottom: -60px;
      right: -90px;
      width: 200px;
      height: 200px;
      background: radial-gradient(#fb233c, #6f1b20);
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

<body class="background-radial-gradient overflow-hidden">
  <!-- Section: Design Block -->
  <section class="p-5">
    <div class="container px-4  px-md-5 text-center text-lg-start my-5">
      <div class="row ">
        <div class="col-lg-6 shrink-hide" style="z-index: 10">
          <h1 class="my-3 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
            Vodafone PNG Limited <br />
            <span style="color: hsl(218, 81%, 75%)">Promotions Draw Portal</span>
          </h1>
          <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">

          </p>
          <div id="radius-shape-4" class="position-absolute rounded-circle shadow-5-strong"></div>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
          <div id="radius-shape-3" class="position-absolute shadow-5-strong rounded-circle"></div>
          <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">
              <form id="userLoginForm" action="" method="post">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row">

                  <!-- Email input -->
                  <div class="col-md-12">
                    <div class="form-outline mb-4">
                      <input name="username" type="text" id="username" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example3">Username</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-outline mb-4">
                      <input name="password" type="password" id="password" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example4">Password</label>
                    </div>
                  </div>

                  <!-- Password input -->

                  <!-- Checkbox -->

                  <!-- Submit button -->
                  <button type="submit" id="login-btn" class="btn btn-danger btn-block mb-4 btn-lg">
                    Sign in
                  </button>
                  <!-- Register buttons -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="/promotions/public/js/jquery-latest.min.js"></script>
  <script>
    $(document).ready(() => {

      $("#userLoginForm").on("submit", function(e) {
        e.preventDefault()
        let username = $("#username").val(),
          password = $("#password").val()
        if (username === "" || password === "") {
          alert("Please fill in all the Details");
        } else {
          $.ajax({
            type: "POST",
            url: "/promotions/login",
            data: {
              username,
              password
            },
            dataType: false,
            contentTye: false,
            cacheData: false,
            beforeSend: () => {},
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
              alert(err.message)
            }
          })
        }
      })
    })
  </script>
</body>

</html>