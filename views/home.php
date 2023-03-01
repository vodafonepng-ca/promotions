<!DOCTYPE html>
<html>
  <head>
  <title> VFPNG | Promotion Draws</title>
    <meta charset="UTF-8">
    <?php include("head.php")?>
  </head>
  <body style="background: url(/promotions/images/light3.jpg);">
      <main class="container-fluid">
          <div class="header" id="header">
              <div id="varnote" class="container">
                  <img src="/promotions/images/logo-footer.png">
                  <h1> Vodafone PNG Promotion Draws </h1>
                  
              </div>
              <div id="main-nav">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="button  btn btn-outline-secondary btn-lg" id="test-promo">Test Draws</button>
                        <button type="button" class="button  btn btn-outline-primary btn-lg" id="valentines-promo">Velntine's Promotions</button>
                    </div>
              </div>
          </div>
      </main>
      <footer class="footer fixed-bottom">
        <div class="container-fluid">
        <div class="copyright text-right">Vodafone PNG &copy; <span id="year">2023</span></div>
      
        </div>
     </footer>
      
      <!-- <script src="/js/main.js"></script> -->
      <script type="text/javascript">
        
        $(document).ready(()=>{
          $("#test-promo").on("click",()=>{
            window.location.replace("/promotions/draws/test")
          })
          $("#valentines-promo").on("click",()=>{
              window.location.replace("/promotions/draws/valentines-promotion")
          })
        })
      </script>
  </body>
</html>
