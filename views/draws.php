<?php

if (isset($drawname)) {
  $title = $rows["promotion_name"];
  include("includes/head.php");
  if (isset($_SESSION["file_loaded"]) && $_SESSION["file_loaded"] === true) {
?>
    </head>

    <body id="app">
      <div class="modal modal-open" id="modal-1">
        <div class="modal-content modal-dialog">
          <div class="modal-header">
            <button class="close" id="modal-1-close">&times;</button>
          </div>
          <div class="modal-body" id="modal-1-body">
          </div>
        </div>
      </div>
      <main class="container-fluid">
        <div class="header" id="header">
          <!-- <div id="varnote" class="container">
                          <h1 class="text-grey"> <?= $rows["promotion_name"] ?> </h1>

                          <div class="copyright">Vodafone PNG &copy; <span id="year"></span></div>
                      </div> -->
          <div id="main-nav">
            <div class="d-flex justify-content-center">
              <button type="button" class="button  btn btn-outline-dark btn-lg text-muted" id="Back"><i class="bi bi-back"></i> Back</button>
              <button type="button" class="button btn btn-outline-danger  btn-lg" id="reset">Reset</button>
              <button type="button" class="button  btn btn-outline-secondary btn-lg" id="save-and-update">Save &amp; Update</button>
              <button type="button" class="button  btn btn-outline-primary btn-lg" id="nameList">Entries</button>
              <button type="button" class="button  btn btn-primary btn-lg" id="loadentries">Load Entries</button>
              <button type="button" class="button  btn btn-primary btn-lg" id="upload"><i class="bi bi-upload"></i>Upload Files</button>
              <button type="button" class="button  btn btn-outline-info btn-lg" id="shw-results">Show results</button>
              <button type="button" class="button  btn btn-outline-success btn-lg" id="go-btn">GO <i class="bi bi-play-fill"></i></button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 offset-2">
            <div id="dropdown">
              <h3 style="text-align:center;margin-top:3px;"><span id="entries" class="text-primary"></span></h3>
              <p style="text-align:center;margin-top:3px;" id="headline"> </p>
              <form action="/" id="fileLoadingForm" enctype="multipart/form-data">
                <input type="hidden" name="upfile" value="1">
                <input type="file" id="dataFile" name="upfile" accept=".csv,.xlsx" />
              </form>
              <div class="container">
                <div id="names" class="container"><textarea name="namesbox" id="namesbox"></textarea></div>
              </div>
              <div id="values">

              </div>
            </div>
          </div>
      </main>
      <nav class="fixed-bottom">
        <div class="float-left">
          <div class="container">

          </div>

        </div>
        <div class="float-right">
          <a href="#" class="btn btn-outline-secondary text-muted" id="requestfullscreen" title="Enter fullscreen mode"> <i class="bi bi-arrows-angle-expand"></i></a>
          <a href="#" class="btn btn-outline-dark text-white" id="exitfullscreen" title="Exit fullscreen"> <i class="bi bi-arrows-angle-contract"></i></a>
        </div>
      </nav>
      <script src="/promotions/public/js/main.js"></script>
      <script>
        $(document).ready(function() {

          setTimeout(() => {
            loadEntries()
          }, 1000)
        })
      </script>
      <script>
        $(function() {
          // check native support
          // $('#support').text($.fullscreen.isNativelySupported() ? 'supports' : 'doesn\'t support');
          $('#exitfullscreen').hide()
          $('#requestfullscreen').show()
          // open in fullscreen
          $('#requestfullscreen').click(function() {
            $('#app').fullscreen();
            $('#requestfullscreen').hide();
            // $('#requestfullscreen').addBack('exitfullscreen')
            $("#namesbox").css({
              "color": '#FFF'
            })
            return false;
          });

          // exit fullscreen
          $('#exitfullscreen').click(function() {
            $.fullscreen.exit();
            $('#requestfullscreen').show();
            $("#namesbox").css({
              "color": '#000'
            })
            return false;
          });

          // document's event
          $(document).bind('fscreenchange', function(e, state, elem) {
            // if we currently in fullscreen mode
            if ($.fullscreen.isFullScreen()) {
              $("#app").css({
                "background": "url(/promotions/public/images/light3.jpg)"
              })
              $('#requestfullscreen').hide();
              $('#exitfullscreen').show();
            } else {
              $('#requestfullscreen').show();
              $('#exitfullscreen').hide();
            }

            // $('#state').text($.fullscreen.isFullScreen() ? '' : 'not');
          });
        });
      </script>
    </body>

    </html>
  <?php
  } else { ?>
    </head>

    <body style="background: url(/promotions/public/images/uploads/<?= $rows["coverImage"]; ?>); background-size:100%">
      <div class="modal modal-open" id="modal-1">
        <div class="modal-content modal-dialog">
          <div class="modal-header">
            <button class="close" id="modal-1-close">&times;</button>
          </div>
          <div class="modal-body" id="modal-1-body">
          </div>
        </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light bg-clear">
        <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bi bi-person"></i> <?= $_SESSION['user'] ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                  <a class="dropdown-item" href="#" onClick="logOut()">Logout</a>
                </div>
              </li>
            </ul>
          </div>
      </nav>
      <main class="container-fluid">
        <div class="header" id="header">
          <div id="varnote" class="container">
            <br>
            <br>
            <!-- <h2 class="text-muted"> <?= $rows["promotion_name"] ?> Draw</h2> -->
            <!-- <div class="copyright">Vodafone PNG &copy; <span id="year"></span></div> -->
          </div>
          <br>
          <br>
          <div id="main-nav">
            <div class="d-flex justify-content-center">
              <button type="button" class="button  btn btn-outline-dark btn-lg text-muted" id="Back"><i class="bi bi-back"></i> Back</button>
              <button type="button" class="button btn btn-outline-danger  btn-lg" id="reset">Reset</button>
              <!-- <button type="button" class="button  btn btn-outline-secondary btn-lg" id="save-and-update">Save &amp; Update</button> -->
              <button type="button" class="button  btn btn-outline-primary btn-lg" id="nameList">Entries</button>
              <button type="button" class="button  btn btn-outline-primary btn-lg" id="loadentries"><i class="bi bi-load"></i> Load Entries</button>
              <button type="button" class="button  btn btn-outline-primary btn-lg" id="upload"><i class="bi bi-upload"></i> Upload Entries</button>
              <button type="button" class="button  btn btn-outline-info btn-lg" id="shw-results">Show results</button>
              <button type="button" class="button  btn btn-outline-success btn-lg" id="go-btn">GO <i class="bi bi-play-circle"></i></button>
              <!-- <button type="button" class="button  btn btn-outline-success btn-lg" id="requestfullscreen"> <i class="bi bi-arrows-fullscreen"></i></button> -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div id="dropdown">
              <h3 style="text-align:center;margin-top:3px;"><span id="entries" class="text-primary"></span></h3>
              <p style="text-align:center;margin-top:3px;" id="headline"> </p>
              <form action="" id="fileLoadingForm" enctype="multipart/form-data">
                <input type="hidden" name="upfile" value="1">
                <input type="file" id="dataFile" name="upfile" accept=".csv,.xlsx" />
              </form>
              <div class="container">
                <div id="names" class="container"><textarea name="namesbox" id="namesbox"></textarea></div>
              </div>
              <div id="values">
              </div>
            </div>
          </div>
      </main>
      <nav class="fixed-bottom">
        <div class="float-left">
          <div class="container">
            <p class="text-muted">Vodafone PNG &copy; <?= date("Y") ?></p>
          </div>

        </div>

      </nav>
      <script>
        let date = new Date()
        let year = date.getFullYear();
        $("#year").html(year)
        var text;
        var drawCount = 0;
        let arr = new Array(),
          arrRandCopy = new Array(),
          rsults = new Array();
        var removed;
        const dataFile = document.getElementById("dataFile");
        const dropdown = document.getElementById("dropdown");
        const values = document.getElementById("values");
        const namesbox = $("#namesbox");

        $("#loadentries").on("click", () => {
          loadEntries()
        })

        $("#Back").on("click", () => {
          window.location.replace("/promotions/");
        })
        $("#upload").on("click", () => {

          $("#dataFile").click()

        })
        $("#dataFile").on("change", () => {

          $("#fileLoadingForm").submit();

        })

        $("#fileLoadingForm").on("submit", function(e) {
          // Prevent the defaul form submision action
          e.preventDefault();
          $(dropdown).fadeIn("slow");
          /*Asyncrouosuly submit the form data to the server*/
          $.ajax({
            type: 'POST',
            url: '/promotions/api/loadcsv',
            data: new FormData(this),
            dataType: false,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: () => {
              $("#entries").html("<img src='/promotions/public/images/bars.svg'/>")
              $("#entries").append("<p>Uploading File...<p>")
            },
            success: (response) => {

              console.log(response)
              let resData = JSON.parse(response);
              if (resData.status === "error") {
                $("#entries").html("")
                alert(resData.message)
              } else {
                $("#entries").html("File Uploaded")
                window.location.replace("")
              }
            },
            error: (err) => {
              alert(err.message)
            }
          });
        })

        function loadEntries() {
          arr.length = 0;
          try {
            $.ajax({
              type: 'GET',
              url: '/promotions/sessions/loadentries',
              beforeSend: () => {
                $("#entries").html("<img src='/promotions/public/images/bars.svg'/>")
                $("#entries").append("<p>Loading Data...<p>")
              },
              success: (response) => {
                let resData = JSON.parse(response);
                if (resData.status === "error") {
                  $("#entries").html("")
                  setTimeout(() => {
                    alert(resData.message)
                  }, 1000)

                } else {
                  $("#entries").html("")
                  $("#app").css({
                    "background": "url(/promotions/public/images/light3.jpg)"
                  })

                  $("#app").css({
                    "background-size": '100%'
                  })
                  $("#app").css({
                    "background-repeat": 'no-repeat'
                  })
                  setTimeout(() => {
                    const resnums = resData.message;
                    for (let i = 0; i < resnums.length; i++) {
                      arr.push(resnums[i])
                    }

                    resData = "";
                    $("#app").css({
                      "background": "url(/promotions/public/images/light3.jpg)"
                    })
                    let nums = arr[0];

                    for (let i = 1; i < arr.length; i++) {
                      let number = arr[i];
                      nums = nums + "\n" + number;
                    }

                    $(namesbox).val(nums)

                  }, 500)

                  setTimeout(() => {
                    $("#entries").html(`${arr.length} Entries  Loaded`)
                    $("#entries").show()
                    $(dropdown).fadeIn("slow")
                    $(namesbox).fadeIn("slow")
                    $(namesbox).removeAttr("disabled")
                    $('#headline').slideUp();
                    $("#nav-buttons").removeClass("even-2");
                    $("#nav-buttons").addClass("even-4");
                    $("#go-btn").fadeIn("slow")
                    $("#reset").fadeIn("slow")
                    $("#nameList").show()
                    $("#upload").removeClass('btn-primary')
                    $("#upload").addClass('btn-outline-primary')
                    $("#loadentries").hide()
                    $("#save-and-update").show()
                    $("#varnote").slideUp("fast");
                    $("#main-nav").css({
                      "margin-top": "20px"
                    });
                  }, 1000)
                }
              },
            })
          } catch (ERR) {
            alert(ERR.message)
          }
        }

        function logOut() {
          let logout = true
          $.ajax({
            type: "POST",
            url: "/promotions/user/logout",
            data: {
              logout,
            },
            dataType: false,
            contentType: false,
            cacheData: false,
            beforeSend: () => {

            },
            success: (res) => {
              let resdata = JSON.parse(res);
              if (resdata.respose === 'success') {
                window.location.replace("")
              } else {
                alert(resdata.message)
              }
            },
            error: (err) => {
              alert(err.message)
            }
          })
        }
      </script>
    </body>

    </html>
  <?php
  }
} else {
  // include("includes/head.php");
  ?>
  <html>

  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="icon" type="/image/x-icon" href="/promotions/public/images/vf-icon.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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

      .promo-lin-main {
        
        margin: 10px;
      }

      .promo-link {
        width: 90px;
        height: 50px;
        border: 1px solid rgba(0,0,0,0.2);
        box-shadow: 1px 1px 4px 2px rgba(0,0,0,0.3);

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

  <body class="background-radial-gradient ">
    <nav class="navbar navbar-expand-lg navbar-light bg-clear ">
      <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-person"></i> <?= $_SESSION['user'] ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                <a class="dropdown-item" href="#" onClick="logOut()">Logout</a>
              </div>
            </li>
          </ul>
        </div>
    </nav>
    <main class="container-fluid">
      <div class="header" id="header">
        <div id="varnote" class="container">
          <img src="/promotions/public/images/logo-footer.png" class="img-resposive img-fluid">
          <h1 class="text-white text-center"> Promotion Draws </h1>
          <!-- <div class="copyright">Vodafone PNG &copy; <span id="year"></span></div> -->
          <hr>
        </div>
        <div id="main-nav" class="row d-flex justify-content-center">
        </div>
      </div>
      <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
      <!-- <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div> -->
      <div id="radius-shape-3" class="position-absolute shadow-5-strong rounded-circle"></div>
    </main>
    <nav class="fixed-bottom">
      <div class="float-left">
        <div class="container">
          <p class="text-muted">Vodafone PNG &copy; <?= date("Y") ?></p>
        </div>
      </div>
    </nav>
    <script src="/promotions/public/js/jquery-latest.min.js"></script>
    <script type="text/javascript">
      $(document).ready(() => {
        loadPromotions()
      })

      function loadPromotions() {
        $.ajax({
          type: "GET",
          url: "/promotions/promotions/loadactive",
          beforeSend: () => {
            $("#main-nav").html("<p class='text-center text-muted'><img src='/public/images/load.gif'/></p>")
          },
          success: (res) => {
            let data = JSON.parse(res);
            if (data.status === "error") {
              $("#main-nav").html("<p class='text-center text-muted'>No active promotions</p>")
            } else {
              promodata = data.message
              console.log(promodata )
              const nav = document.createElement("div")
              $(nav).addClass("d-flex justify-content-center");
              promodata.forEach((element) => {
                
                $(nav).append(`<div class='promo-lin-main col-md-2'><div class="bg-dark btn promo-link " onClick='gotoPromopage(${element.id})' style='background:url()'><img src='/promotions/public/images/uploads/${element. coverImage}' class='img-fluid rounded'/></div><p class="text-white text-center">${element.promotion_name}</p></div>`)
              })
              $("#main-nav").html(nav)
            }
          },
          error: (err) => {
            alert(err.message)
          }
        })
      }

      function gotoPromopage(link) {
        window.location.replace(`/promotions/draws/${link}`)
      }

      function logOut() {
        let logout = true
        $.ajax({
          type: "POST",
          url: "/promotions/user/logout",
          data: {
            logout,
          },
          dataType: false,
          contentType: false,
          cacheData: false,
          beforeSend: () => {

          },
          success: (res) => {
            let resdata = JSON.parse(res);
            if (resdata.respose === 'success') {
              window.location.replace("")
            } else {
              alert(resdata.message)
            }
          },
          error: (err) => {
            alert(err.message)
          }
        })
      }
    </script>
  </body>

  </html>
<?php
}
