<?php
session_start();
if(isset($_SESSION["file_loaded"])&&$_SESSION["file_loaded"]===true){?>
<!DOCTYPE html>
<html>
  <head>
  <title>VFPNG | Valentine's Promotions Draw</title>
    <meta charset="UTF-8">
    <?php include("head.php")?>
  </head>
  <body id="app" >
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
          <div  id="header">
              <div id="varnote" class="container">
                  <h1 class="text-muted"> Valentine's Promotions Draw </h1>
                  <div class="copyright">Vodafone PNG &copy; <span id="year"></span></div>
              </div>
              <br>
              <br>
              <div id="main-nav">
                    <div class="d-flex justify-content-center">
                    <button type="button" class="button  btn btn-outline-dark btn-lg text-muted" id="Back"><i class="bi bi-back"></i> Back</button>
                        <button type="button" class="button btn btn-outline-danger  btn-lg" id="reset">Reset</button>
                        <button type="button" class="button  btn btn-outline-secondary btn-lg" id="save-and-update">Save &amp; Update</button>
                        <button type="button" class="button  btn btn-outline-primary btn-lg" id="nameList">Entries</button>
                        <button type="button" class="button  btn btn-primary btn-lg" id="loadentries">Load Entries</button>
                        <button type="button" class="button  btn btn-primary btn-lg" id="upload"><i class="bi bi-upload"></i>Upload Files</button>
                        <button type="button" class="button  btn btn-outline-info btn-lg" id="shw-results">Show results</button>
                        <button type="button" class="button  btn btn-outline-success btn-lg" id="go-btn">GO <i class="bi bi-play-circle"></i></button>
                    </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
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
      <footer class="fixed-bottom">
        <div class="float-right">
        <a href="#" class="btn btn-outline-secondary text-muted" id="requestfullscreen" title="Enter fullscreen mode"> <i class="bi bi-arrows-angle-expand"></i></a>
        <a href="#"  class="btn btn-outline-dark text-white" id="exitfullscreen" title="Exit fullscreen"> <i class="bi bi-arrows-angle-contract"></i></a>         
</div>
</footer>
      <script src="/promotions/js/main.js" type="text/javascript"></script>
      <script>
        $(document).ready(function(){
            $('#exitfullscreen').hide()
            $('#requestfullscreen').show()
            setTimeout(()=>{
                loadEntries()
            },1000)
        })
      </script>
  </body>
</html>
<?php
}else{?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>VFPNG | Valentine's Promotions Draw</title>
        <meta charset="UTF-8">
            <?php include("head.php")?>
     </head>
  <body id="app" >
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
          <div id="header">
              <div id="varnote">
                  <h1 class="text-white text-center"> Valentine's Promotion </h1>
                  
              </div>
              <br>
              <br>
              <br>
              <br>
              <div id="main-nav">
                    <div style="display:flex; flex-flow:column ;width:300px">
                    <button type="button" class="button  btn btn-outline-dark text-muted" id="Back"><i class="bi bi-back"></i> Back</button>
                        <button type="button" class="button btn btn-outline-danger" id="reset">Reset</button>
                        
                        <button type="button" class="button  btn btn-outline-primary" id="nameList">Entries</button>
                        <button type="button" class="button  btn btn-outline-primary " id="loadentries"><i class="bi bi-load"></i> Load Entries</button>
                        <button type="button" class="button  btn btn-outline-primary" id="upload"><i class="bi bi-upload"></i> Upload Entries</button>
                        <button type="button" class="button  btn btn-outline-info" id="shw-results">Show results</button>
                        <button type="button" class="button  btn btn-outline-success" id="go-btn">GO <i class="bi bi-play-circle"></i></button>
                    </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
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
      <!-- <footer class="fixed-bottom">
        <div class="float-right">
        <a href="#" class="btn btn-outline-secondary text-muted" id="requestfullscreen" title="Enter fullscreen mode"> <i class="bi bi-arrows-angle-expand"></i></a>
        <a href="#"  class="btn btn-outline-dark text-white" id="exitfullscreen" title="Exit fullscreen"> <i class="bi bi-arrows-angle-contract"></i></a>         
        </div>
</footer> -->
<!-- <script src="/promotions/js/main.js" type="text/javascript"></script> -->


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
      $(document).ready(()=>{
        $('#exitfullscreen').hide()
        $('#requestfullscreen').show()
        $("#app").css({"background":"url(/promotions/images/ValentinesPromo.jpg)"})
        $("#app").css({"background-size": '100%'})       
        $("#app").css({"background-repeat": 'no-repeat'})          
})
$("#loadentries").on("click", () => {
    loadEntries()
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
        url: '/promotions/api/loadcsv',
        data: new FormData(this),
        dataType: false,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: () => {
            $("#entries").html("<img src='/promotions/images/bars.svg'/>")
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
// loadentries
    //$("#dataFile").click()

    arr.length=0;
    try{
        $.ajax({
        type: 'GET',
        url: '/promotions/draws/loadentries',
        
        beforeSend:()=>{
            $("#entries").html("<img src='/promotions/images/bars.svg'/>")
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
            $("#app").css({"background":"url(/promotions/images/light3.jpg)"})
   
                $("#app").css({"background-size": '100%'})       
                $("#app").css({"background-repeat": 'no-repeat'})  
            setTimeout(()=>{
                   
                    /* Loop through the response data array and store each element into  main data array arr[]*/
                    const resnums=resData.message;
                    
                    for(let i=0; i<resnums.length; i++){
                        arr.push(resnums[i])
                    }
                  
                    resData="";
                    $("#app").css({"background":"url(/promotions/images/light3.jpg)"})
                    let nums = arr[0];
                    /*
                      Loop through the data array and set line breaks to each elements
                      starting from the second element of the array
                    */
                    for (let i = 1; i < arr.length; i++) {
                        let number = arr[i];
                        nums = nums + "\n" + number;
                    }

                    /*Set the Values of the Text box with  nums*/
                    // $(body).css({"background":""})
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

    </script>
  </body>
</html>
    
    <?php

}

?>



