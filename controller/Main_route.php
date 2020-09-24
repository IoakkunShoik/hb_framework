<?php

    namespace controller;
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    class Main_route extends \vendor\Controller
    {
        public function main_route(){
            $append_string = $this->micro_block('example', 'expl_vidget', ['foo' => 'app']);
            $this->render('example', ['Name'=>'Василий', 'append'=>$append_string]);
        }
    }