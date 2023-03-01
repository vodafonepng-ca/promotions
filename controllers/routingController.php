<?php

 $req_uri=$_SERVER['REQUEST_URI'];

class Route {
    private $req_uri = $req_uri;
    private $resp;
    public function __config($req_uri,$resp){
        $this->req_uri = $req_uri;
        $this->resp = $resp;

    }

    public static function get($request, $view){
       
        $view_dir = "./views/";
        $route = preg_replace("/(^\/)|(\/$)/","",$request);
        $reqUri =  preg_replace("/(^\/)|(\/$)/","",$req);
        
        
    }


public static function post($request, $controller){
        if(!empty($_REQUEST['uri'])){
            $route = preg_replace("/(^\/)|(\/$)/","",$request);
            $reqUri =  preg_replace("/(^\/)|(\/$)/","",$_REQUEST['uri']);
        }else{

            $reqUri = "/";

        }

        if($reqUri == $request ){
            include($controller);
            exit();
        }
        
    }


}

