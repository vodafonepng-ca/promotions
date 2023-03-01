<?php
include("includes/head.php");
?>
</head>
<body>
  <div class="container">
    <section>

        <h2 class="text-warning text-center"><?=$status?></h2>
        <?php
        if(isset($details)){
          echo "<p class='text-center'>$details<p>";
        }
        ?>

    </section>
  </div>
</bod>
</html>
