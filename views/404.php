<?php
if ($_SERVER['REQUEST_METHOD'] === "GET") {
  $title = "404 | Not Found";
  include("includes/head.php");
?>
  </head>

  <body>
    <div class="container">
      <section class="p-5">
        <?php
        if (isset($status)) {
        ?>
          <h2 class="text-danger text-center"><?= $status ?></h2>
        <?php
        } else {
        ?>
          <h2 class="text-center text-danger">404 | Not Found</h2>
        <?php
        }
        ?>
        <hr>
        <?php
        if (isset($details)) {
          echo "<p class='text-center'>$details<p>";
        } else {
        ?>
          <p class="text-center">Unkbown Location</p>
        <?php
        }
        ?>
        <p class="text-center"><a href="/promotions">Go Back</a></p>
      </section>
    </div>
    </bod>

    </html>
  <?php
}
exit();
