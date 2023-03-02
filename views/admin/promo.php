<?php

if($rowsCount>0){
  $title="Admin | ".$rows[0]['promotion_name'];
  
?>
<!DOCTYPE html>
<html>
  <head>
  <title><?=$title?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="/public/image/x-icon" href="/promotions-v.2/images/vf-icon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="/promotions/public/css/cosmo.css" />
  <link rel="stylesheet" href="/promotions/public/css/main.css" />
</head>
<body>
  <?php include("nav.php")?>
  <br>
  <br>
  <hr>
  <div class="container-fluid" style="height:500px; overflow-y:scroll">
    <?php //echo json_encode($rows[0]) ?>
      <h1><?php echo $rows[0]['promotion_name'];?></h1>
      <p class=' text-left'><i class="bi bi-calendar text-primary"></i> <span class="text-muted"> <?php echo$rows[0]['promotion_start_date']  ?>  to <?php echo$rows[0]['promotion_end_date']  ?></span>  <span class="float-right <?php echo $rows[0]['status']==='Active'?'text-success':'';?>"><?php echo$rows[0]['status']  ?><span></p>
      <hr>
      <p><?php echo $rows[0]['promotions_descript'];?></p>
      <div class="card">
        <div class="card-body">
          <?php if($rows[0]['coverImage']!==null&&file_exists("./public/images/uploads/".$rows[0]['coverImage'])){
            ?>
            <img src="/promotions/public/images/uploads/<?php echo $rows[0]['coverImage']?>" class="img-responsive img-fluid"/>
            <?php
          } else{
            ?>
            <div class=""id="preview">
              <p class="text-center">No Cover Photo</p>
            </div>
            <hr>
            <form  method="post" enctype="multipart/form-data" id="uploadCover" action="">
              <input type="file" id="attacheCover" name="coverphoto"/>
              <!-- <input type="file" accept='image/*' name="coverphoto" id="attacheCover" style="visibility:none"> -->
              <input type="hidden" value="<?=$rows[0]['id']?>"  name="promoid">
              <button type="button"class="btn btn-secondary" id="upfile"><i class="bi bi-camera"></i></button>
              <button type="submit"class="btn btn-primary" >Upload Cover</button>
            </form>
            <?php
          }?>
        </div>
      </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  <script>
    $("#uploadCover").submit(function(e){
    e.preventDefault();
      $.ajax({
        type:'POST',
        url:"/promotions/admin/promo/uploadcover",
        data:new FormData($(this)[0]),
        contentType:false,
        dataType:false,
        processData: false,
        cacheData:false,
        beforeSend:()=>{
        },
        success:(res)=>{

        },
        error:(err)=>{
        }
      })
  })
    $("#upfile").on("click",()=>{
      $("#attacheCover").click();
    })
    $("#attacheCover").on("change",function(e){
      $("#preview").html("")
      $("#preview").html("<img class='img-responsive img-fluid' src=''/>")
      var $input = $(this);
      var reader = new FileReader();
      reader.onload = function(){

            $("#preview img").attr("src", reader.result);

      }
      reader.readAsDataURL($input[0].files[0]);
    })
  </script>
  <script src="/promotions/public/js/admin.js"></script>
</body>
</html>
<?php
}else{
  echo "Promotion not Avaialable";
}


 ?>
