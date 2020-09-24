<?php
namespace vendor;
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


class DbHandler
{
    public $db;
    public $table;
    public $col_count;

    function __construct($table)
    {
        $settings    = json_decode(  file_get_contents('dbsetup.json')  );
        
        $dsn  = $settings->{'db_serv'} .
                ':host='   . $settings->{'db_host'} . 
                ';dbname=' . $settings->{'db_name'};

        $this->db        = new \PDO($dsn, $settings->{"db_user"}, $settings->{"db_pass"});
        $this->table     = $table;

        $this->col_count = $this->db->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='$this->table'")->fetch()[0]-1;

    }

    function TableGet($search = NULL)
    {
        $query  = $this->db->prepare("SELECT * FROM $this->table $search");
        $query->execute(array(5));
        return $query->fetchAll();
    }

    function PushIntoTable($push, $allow_empty = false)
    {   
        $push_values="NULL, ".implode(', ', $push);
        if(empty($push[$this->col_count-1]) && $allow_empty == false) throw new \Exception ("MISSING VALUES");
        $add = $this->db->prepare("INSERT INTO $this->table VALUES ($push_values)");
        if(!$add->execute()){
            throw new \Exception("ERROR WRITING");
        }
    }
    
}

