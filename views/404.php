<?php
if($_SERVER['REQUEST_METHOD']==="GET"){
  include("includes/head.php");
  ?>
  </head>
  <body>
    <div class="container">
      <section>
<?php
if(isset($status)){
  ?>
  <h2 class="text-danger text-center"><?=$status?></h2>
  <?php
}
?>
          

          <?php
          if(isset($details)){
            echo "<p class='text-center'>$details<p>";
          }
          ?>
      </section>
    </div>
  </bod>
  </html>
  <?php
}
echo "404";
exit();
