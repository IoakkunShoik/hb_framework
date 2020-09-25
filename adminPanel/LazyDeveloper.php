<?php

namespace adminPanel;
session_start();
spl_autoload_register(function($classname){
    require_once $_SERVER['DOCUMENT_ROOT'].'/'.str_replace('\\', '/', $classname).".php";
});

class LazyDeveloper{
    private const PASSWORD = "123";
    function __construct($command){
        
        if($_SESSION['LAZY']!=$this::PASSWORD){
            $_SESSION['LAZY']=$_POST['LAZY'];
            if($_POST['LAZY']==$this::PASSWORD){
                
            }
            echo ' 
                <form action="" method="POST">
                    <input name="LAZY" type="password" placeholder="password">
                    <input type="submit" value="войти">
                </form>
            ';
            return -1;
        }
        
        switch($command){
            default:

                break;
        }

    }
}

    new LazyDeveloper('hello');