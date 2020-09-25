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
        echo file_get_contents('LazyDevPanel.html');
        switch($_GET['command']){
            
            case 'makeMigration':
                $template = file_get_contents('templates/migration.php');
                $template = str_replace('@migrationName', $_GET['name'], $template);
                if(!file_exists($_SERVER["DOCUMENT_ROOT"].'/model/migrations/'.$_GET["name"].'_table.php')){
                    $migrationFile = fopen($_SERVER["DOCUMENT_ROOT"].'/model/migrations/'.$_GET["name"].'_table.php', 'w');
                    fwrite($migrationFile, $template);
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=/adminPanel/LazyDeveloper.php">';
                }else{
                    throw new \Exception('File exists');
                }
                break;
            case 'migrate':
                new \model\migrations\Migrate();
                break;

            case 'makeController':
                $template = file_get_contents('templates/controller.php');
                $template = str_replace('@namecontroller', ucfirst($_GET['name']), $template);
                if(!file_exists($_SERVER["DOCUMENT_ROOT"].'/controller/'.ucfirst($_GET["name"]).'_route.php')){
                    $controllerFile = fopen($_SERVER["DOCUMENT_ROOT"].'/controller/'.ucfirst($_GET["name"]).'_route.php', 'w');
                    fwrite($controllerFile, $template);
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=/adminPanel/LazyDeveloper.php">';
                }else{
                    throw new \Exception('File exists');
                }
                break;
        }

    }
}

    new LazyDeveloper('hello');