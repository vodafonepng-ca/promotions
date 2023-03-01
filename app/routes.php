<?php

require_once __DIR__.'/router.php';
require_once __DIR__.'/app/auth.php';
get('/', function(){
  logedinAuth("views/login.php");
  $title="Vodafone PNG Promotions";
  include('views/draws.php');
} );

get('/admin', function(){

  include('controllers/adminController.php');
} );

get('/draws', function(){
  logedinAuth("views/login.php");
  $title="Vodafone PNG Promotions / Draws";

      include('views/draws.php');

});
get('/draws/$drawname','controllers/drawsController.php');
//views/draws.php
get('/sessions/loadentries', function(){
  require "controllers/api/loadEntries.php";
});
get('/session/reset-session', function(){

    require "./controllers/unset-session.php";

});
get('/admin/promotions', function(){

           require "controllers/api/promotions.php";

});

///admin/users
get('/admin/users', function(){

           require "controllers/api/loadusers.php";

});


post('/admin/logout', function(){

           require "controllers/api/adminLogout.php";

});

get('/promotions/loadactive', function(){

           require "controllers/api/activepromotions.php";

});

post('/admin/getpromoInfo', function(){
            require "./controllers/api/promoInfo.php";
});

post('/admin/getuserInfo', function(){
            require "./controllers/api/userInfo.php";
});

post('/admin/delet-promo', function(){
           require "./controllers/api/deletePromo.php";
});
// /login

post('/login', function(){

           require "./controllers/api/userlogin.php";
});
// /user/logout
post('/user/logout', function(){

           require "./controllers/api/userlogOut.php";
});
post('/admin/delete-user', function(){
           require "./controllers/api/deleteUser.php";
});
post('/admin/create-promotion', function(){
            require "./controllers/api/createPromotions.php";
});

post('/admin/update-promo', function(){
             require "./controllers/api/updatePromotions.php";
});

post('/admin/update-user', function(){
      require "./controllers/api/update-user.php";
});

post('/admin/create-user', function(){
            require "./controllers/api/createUsers.php";
});
post('/admin/login', function(){
             require "./controllers/api/addminLogin.php";
});
post('/api/loadcsv', function(){
             require "controllers/api/loadcsv.php";
});


  post('/api/downloadcsv', function(){
       require "controllers/api/loadcsv.php";
  });


any('/404','views/404.php');
