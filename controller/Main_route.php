<?php

    namespace controller;

    class Main_route extends \vendor\Controller
    {
        public function main_route(){
            $append_string = $this->micro_block('example', 'expl_vidget', ['vidget_value' => 'app']);
            $this->render('example', ['Name'=>'Василий', 'append'=>$append_string]);
        }
    }