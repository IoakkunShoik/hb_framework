<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



    spl_autoload_register(function($classname){
        require_once $_SERVER['DOCUMENT_ROOT'].'/'.str_replace('\\', '/', $classname).".php";
    });
    
    
    
    
?>
