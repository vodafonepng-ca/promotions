<?php

if(isset($drawname)){
  $title=$rows["promotion_name"];
  include("includes/head.php");
  if(isset($_SESSION["file_loaded"])&&$_SESSION["file_loaded"]===true){
    ?>
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
                          <h1 class="text-grey"> <?=$rows["promotion_name"]?> </h1>

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
                              <h3 style="text-align:center;margin-top:3px;"><span
                                  id="entries" class="text-primary"></span></h3>
                              <p style="text-align:center;margin-top:3px;" id="headline"> </p>
                              <form action="/" id="fileLoadingForm" enctype="multipart/form-data">
                                <input type="hidden" name="upfile" value="1">
                                <input type="file" id="dataFile" name="upfile" accept=".csv,.xlsx"/>
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
                <a href="#"  class="btn btn-outline-dark text-white" id="exitfullscreen" title="Exit fullscreen"> <i class="bi bi-arrows-angle-contract"></i></a>
                </div>
              </nav>
              <script src="/promotions-v.2/public/js/main.js"></script>
              <script>
                $(document).ready(function(){

                    setTimeout(()=>{
                        loadEntries()
                    },1000)
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
                                $("#namesbox").css({"color":'#FFF'})
                    return false;
                  });

                  // exit fullscreen
                  $('#exitfullscreen').click(function() {
                    $.fullscreen.exit();
                                $('#requestfullscreen').show();
                                $("#namesbox").css({"color":'#000'})
                    return false;
                  });

                  // document's event
                  $(document).bind('fscreenchange', function(e, state, elem) {
                    // if we currently in fullscreen mode
                    if ($.fullscreen.isFullScreen()) {
                      $("#app").css({"background":"url(./public/images/light3.jpg)"})
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

}else{?>
      <body  style="background: url(/promotions-v.2/public/images/uploads/<?=$rows["coverImage"];?>); background-size:100%">
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
                  <i class="bi bi-person"></i> <?=$_SESSION['user']?>
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
                      <h1 class="text-muted"> <?=$rows["promotion_name"]?> Draw</h1>
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
                          <h3 style="text-align:center;margin-top:3px;"><span
                              id="entries" class="text-primary"></span></h3>
                          <p style="text-align:center;margin-top:3px;" id="headline"> </p>
                          <form action="" id="fileLoadingForm" enctype="multipart/form-data">
                            <input type="hidden" name="upfile" value="1">
                            <input type="file" id="dataFile" name="upfile" accept=".csv,.xlsx"/>
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
                <p class="text-muted">Vodafone PNG &copy; <?=date("Y")?></p>
              </div>

            </div>

          </nav>
          <script>
            let date = new Date()
            let year = date.getFullYear();
            $("#year").html(year)
            var text;
            var drawCount = 0;
            let arr = new Array(), arrRandCopy = new Array(), rsults = new Array();
            var removed;
            const dataFile = document.getElementById("dataFile");
            const dropdown = document.getElementById("dropdown");
            const values = document.getElementById("values");
            const namesbox = $("#namesbox");
          
    $("#loadentries").on("click", () => {
        loadEntries()
    })

    $("#Back").on("click",()=>{
            window.location.replace("/promotions-v.2/");
        })
    $("#upload").on("click", () => {

        $("#dataFile").click()

    })
    $("#dataFile").on("change", () => {

        $("#fileLoadingForm").submit();

    })

    $("#fileLoadingForm").on("submit", function (e) {
      // Prevent the defaul form submision action
      e.preventDefault();
        $(dropdown).fadeIn("slow");
    /*Asyncrouosuly submit the form data to the server*/
        $.ajax({
            type: 'POST',
            url: '/promotions-v.2/api/loadcsv',
            data: new FormData(this),
            dataType: false,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: () => {
                $("#entries").html("<img src='/promotions-v.2/public/images/bars.svg'/>")
                $("#entries").append("<p>Uploading File...<p>")
            },
            success: (response) => {

                console.log(response)
                let resData=JSON.parse(response);
              if(resData.status==="error"){
                $("#entries").html("")
                alert(resData.message)
              }else {
                $("#entries").html("File Uploaded")
                window.location.replace("")
              }
            },
            error:(err)=>{
              alert(err.message)
            }
        });
    })

    function loadEntries(){
        arr.length=0;
        try{
            $.ajax({
            type: 'GET',
            url: '/promotions-v.2/sessions/loadentries',
            beforeSend:()=>{
                $("#entries").html("<img src='/promotions-v.2/public/images/bars.svg'/>")
                $("#entries").append("<p>Loading Data...<p>")
            },
            success: (response) => {
                let resData=JSON.parse(response);
              if(resData.status==="error"){
                $("#entries").html("")
              setTimeout(()=>{
                    alert(resData.message)
              },1000)

              }else {
                $("#entries").html("")
                $("#app").css({"background":"url(/promotions-v.2/public//images/light3.jpg)"})

                    $("#app").css({"background-size": '100%'})
                    $("#app").css({"background-repeat": 'no-repeat'})
                setTimeout(()=>{
                        const resnums=resData.message;
                        for(let i=0; i<resnums.length; i++){
                            arr.push(resnums[i])
                        }

                        resData="";
                        $("#app").css({"background":"url(/promotions-v.2/public//images/light3.jpg)"})
                        let nums = arr[0];

                        for (let i = 1; i < arr.length; i++) {
                            let number = arr[i];
                            nums = nums + "\n" + number;
                        }

                        $(namesbox).val(nums)

                },500)

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
                    $("#main-nav").css({ "margin-top": "20px" });
                },1000)
              }
            },
        })
        }catch(ERR){
        alert(ERR.message)
        }
    }

    function logOut(){
      let logout=true
      $.ajax({
        type:"POST",
        url:"/promotions-v.2/user/logout",
        data:{logout,},
        dataType:false,
        contentType:false,
        cacheData:false,
        beforeSend:()=>{

        },
        success:(res)=>{
          let resdata=JSON.parse(res);
          if(resdata.respose==='success'){
            window.location.replace("")
          }else{
            alert(resdata.message)
          }
        },
        error:(err)=>{
          alert(err.message)
        }
      })
    }
        </script>
      </body>
    </html>
    <?php
}
}else{
  include("includes/head.php");
  ?>
        <body style="background: url(/promotions-v.2/public/images/vodafone-png.png); background-size:100%">
          <nav class="navbar navbar-expand-lg navbar-light bg-clear ">
            <div class="container">

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bi bi-person"></i> <?=$_SESSION['user']?>
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
                          <img src="/promotions-v.2/public/images/logo-footer.png">
                          <h1 class="text-white"> Promotion Draws </h1>
                          <!-- <div class="copyright">Vodafone PNG &copy; <span id="year"></span></div> -->
                      </div>
                      <div id="main-nav">
                      </div>
                  </div>
              </main>
              <nav class="fixed-bottom">
                <div class="float-left">
                  <div class="container">
                    <p class="text-muted">Vodafone PNG &copy; <?=date("Y")?></p>
                  </div>
                </div>
              </nav>
              <script type="text/javascript">
              $(document).ready(()=>{
                loadPromotions()
              })
              function loadPromotions(){
                  $.ajax({
                      type:"GET",
                      url:"/promotions-v.2/promotions/loadactive",
                      beforeSend:()=>{
                          $("#main-nav").html("<p class='text-center text-muted'><img src='/public/images/load.gif'/></p>")
                      },
                      success:(res)=>{
                          let data=JSON.parse(res);
                          if(data.status==="error"){
                              $("#main-nav").html("<p class='text-center text-muted'>No active promotions</p>")
                          }else{
                              promodata=data.message
                              const nav=document.createElement("div")
                              $(nav).addClass("d-flex justify-content-center");
                              promodata.forEach((element)=>{
                                console.log(element.promotion_link)
                                $(nav).append(`<button class="btn btn-success btn-lg" onClick='gotoPromopage(${element.id})'>${element.promotion_name}</button>`)
                              })
                              $("#main-nav").html(nav)
                          }
                      },
                      error:(err)=>{
                          alert(err.message)
                      }
                  })
                }

                function gotoPromopage(link){
                  window.location.replace(`/promotions-v.2/draws/${link}`)
                }
                function logOut(){
        let logout=true
        $.ajax({
          type:"POST",
          url:"/promotions-v.2/user/logout",
          data:{logout,},
          dataType:false,
          contentType:false,
          cacheData:false,
          beforeSend:()=>{

          },
          success:(res)=>{
            let resdata=JSON.parse(res);
            if(resdata.respose==='success'){
              window.location.replace("")
            }else{
              alert(resdata.message)
            }
          },
          error:(err)=>{
            alert(err.message)
          }
        })
      }
              </script>
          </body>
        </html>
  <?php
}
