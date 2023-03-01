<!DOCTYPE html>
<html>
  <head>
  <title>VFPNG  Promotions Draws Test</title>
    <meta charset="UTF-8">
    <?php include("head.php")?>
  </head >
  <body style="background: url(/promotions/images/light3.jpg);">
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
              <div id="varnote" class="container">
                  <img src="/promotions/images/logo-footer.png">
                  <h1> Test Draw   </h1>
                  <div class="copyright">Vodafone PNG &copy; <span id="year"></span></div>
              </div>
              <div id="main-nav">
                    <div class="d-flex justify-content-center">
                    <button type="button" class="button  btn btn-outline-dark btn-lg" id="Back">Back</button>
                        <button type="button" class="button btn btn-outline-danger  btn-lg" id="reset">Reset</button>
                        <button type="button" class="button  btn btn-outline-secondary btn-lg" id="save-and-update">Save &amp; Update</button>
                        <button type="button" class="button  btn btn-outline-info btn-lg" id="upload">Load Entries</button>
                        <button type="button" class="button  btn btn-outline-info btn-lg" id="shw-results">Show results</button>
                        <button type="button" class="button  btn btn-outline-success btn-lg" id="go-btn">GO &#8594;</button>
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
      <footer class="footer fixed-bottom">
        <div class="container-fluid">
        <div class="copyright text-right">Vodafone PNG &copy; <span id="year">2023</span></div>
      
        </div>
     </footer>
      <script src="/promotions/js/test-draws.js"></script>
      <script >
            $("#Back").on("click",()=>{
                window.location.replace("/promotions/");
            })          
      </script>
  </body>
</html>
