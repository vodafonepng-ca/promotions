<?php
$base_url="/promotions-v.2";
require_once 'router.php';
require_once './app/auth.php';
get($base_url, function(){
  logedinAuth("views/login.php");
  $title="Vodafone PNG Promotions";
  include('views/draws.php');
} );

get($base_url.'/admin', function(){

  include('controllers/adminController.php');
} );

get($base_url.'/draws', function(){
  logedinAuth("views/login.php");
  $title="Vodafone PNG Promotions / Draws";

      include('views/draws.php');

});
get($base_url.'/draws/$drawname','controllers/drawsController.php');
//views/draws.php
get($base_url.'/sessions/loadentries', function(){
  require "controllers/api/loadEntries.php";
});
get($base_url.'/session/reset-session', function(){

    require "./controllers/unset-session.php";

});
get($base_url.'/admin/promotions', function(){

           require "controllers/api/promotions.php";

});

///admin/users
get($base_url.'/admin/users', function(){

           require "controllers/api/loadusers.php";

});
get($base_url.'/admin/promos', function(){

           require "controllers/promotionsController.php";

});
get($base_url.'/admin/promos/$id', "controllers/promotionsController.php");


post($base_url.'/admin/logout', function(){

           require "controllers/api/adminLogout.php";

});
//admin/promo/uploadcover
post($base_url.'/admin/promo/uploadcover', function(){

           require "controllers/api/uploadCover.php";

});

get($base_url.'/promotions/loadactive', function(){

           require "controllers/api/activepromotions.php";

});

post($base_url.'/admin/getpromoInfo', function(){
            require "./controllers/api/promoInfo.php";
});

post($base_url.'/admin/getuserInfo', function(){
            require "./controllers/api/userInfo.php";
});

post($base_url.'/admin/delet-promo', function(){
           require "./controllers/api/deletePromo.php";
});
// /login

post($base_url.'/login', function(){

           require "./controllers/api/userlogin.php";
});
// /user/logout
post($base_url.'/user/logout', function(){

           require "./controllers/api/userlogOut.php";
});
post($base_url.'/admin/delete-user', function(){
           require "./controllers/api/deleteUser.php";
});
post($base_url.'/admin/create-promotion', function(){
            require "./controllers/api/createPromotions.php";
});

post($base_url.'/admin/update-promo', function(){
             require "./controllers/api/updatePromotions.php";
});

post($base_url.'/admin/update-user', function(){
      require "./controllers/api/update-user.php";
});

post($base_url.'/admin/create-user', function(){
            require "./controllers/api/createUsers.php";
});
post($base_url.'/admin/login', function(){
             require "./controllers/api/addminLogin.php";
});
post($base_url.'/api/loadcsv', function(){
             require "controllers/api/loadcsv.php";
});


  post($base_url.'/api/downloadcsv', function(){
       require "controllers/api/loadcsv.php";
  });


any('/404','views/404.php');
