<?php

namespace model\migrations;

class Migrate
{
    function __construct()
    {
        $migrations = scandir($_SERVER['DOCUMENT_ROOT'].'/model/migrations');
        print_r($migrations);
        foreach($migrations as $migration){
           if(strpos($migration, '_table')){
               require_once $migration;
               str_replace("_table.php", '', $migration)();
            }
        }
    }
}