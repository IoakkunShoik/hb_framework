<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    spl_autoload_register(function($classname){
        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/'.str_replace('\\', '/', $classname).".php")){
            require_once $_SERVER['DOCUMENT_ROOT'].'/'.str_replace('\\', '/', $classname).".php";
        } else {
            //echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=/main">';
        }
    });
    
    if(!isset($_GET['page']) || $_GET['page']==""){
        $call = 'controller\\Main_route';
    }else{
        
        $call = 'controller\\'.ucfirst($_GET['page']).'_route';
    }
    new $call();
