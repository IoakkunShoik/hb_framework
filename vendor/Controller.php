<?php
namespace vendor;

class Controller
{
    function __construct(){
        if(isset($_GET['page'])){
            $call = 'main_route';
        }else{
            $call = $_GET['page'].'_route';
        }
        $this->$call();
    }
    protected function render($view=NULL, $values=NULL){
        $view = file_get_contents("view/$view/page.html");
        foreach($values as $value){
            $key = array_search($value, $values);
            $view = str_replace("$$$$key$$$", $value, $view);
        }
        echo $view;
    }


    protected function micro_block($view, $vidget, $values){
        $view = file_get_contents("view/$view/blocks/$vidget.html");
        foreach($values as $value){
            $key = array_search($value, $values);
            $view = str_replace("$$$$key$$$", $value, $view);
        }
        return $view;
    }
}