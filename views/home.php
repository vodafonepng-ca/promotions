<?php
include("includes/head.php");
?>
<body style="background: url(./public/images/light3.jpg);">
      <main class="container-fluid">
          <div class="header" id="header">
              <div id="varnote" class="container">
                  <img src="/public/images/logo-footer.png">
                  <h1 class="text-white"> Vodafone PNG Promotion Draws </h1>
                  <div class="copyright">Vodafone PNG &copy; <span id="year"></span></div>
              </div>
              <div id="main-nav">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="button  btn btn-outline-light btn-lg text-muted" id="test-promo">Test Draws</button>
                        <button type="button" class="button  btn btn-outline-primary btn-lg" id="b-2-school-promo">Back to School Promotions</button>
                    </div>
              </div>
          </div>
      </main>
      <!-- <script src="/js/main.js"></script> -->
      <script type="text/javascript">

        $(document).ready(()=>{
          $("#test-promo").on("click",()=>{
            window.location.replace("/draws/test")
          })
          $("#b-2-school-promo").on("click",()=>{
              window.location.replace("/draws/back-to-school-promo")
          })
        })
      </script>
  </body>
</html>
