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
    private $migration = "CREATE TABLE `@DBNAME`.`@TABLENAME` (@REQUEST)";


    function __construct($table)
    {
        require_once $_SERVER['DOCUMENT_ROOT'].'/adminPanel/dbsetup.php';
        
        $dsn  = $db_setup['db_serv'] .
                ':host='   . $db_setup['db_host'] . 
                ';dbname=' . $db_setup['db_name'];

        $this->db        = new \PDO($dsn, $db_setup["db_user"], $db_setup["db_pass"]);
        $this->table     = $table;
        $this->migration = str_replace('@DBNAME', $db_setup['db_name'], $this->migration);
        $this->col_count = $this->db->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='$this->table'")->fetch()[0]-1;

    }


    function tableGet($search = NULL)
    {
        $query  = $this->db->prepare("SELECT * FROM $this->table");
        $query->execute();
        return $query->fetchAll();
    }


    function pushIntoTable($push, $allow_empty = false)
    {   
        $push_values = "NULL, ".implode(', ', $push);
        $push_values = str_replace('@current_time', "'".date('g:i:s')."'", $push_values);
        $push_values = str_replace('@current_datetime', "'".date('Y-m-d g:i:s')."'", $push_values);
        $push_values = str_replace('@current_datetime', "'".date('Y-m-d')."'", $push_values);


        if(empty($push[$this->col_count-1]) && $allow_empty == false) throw new \Exception ("MISSING VALUES");
        $add = $this->db->prepare("INSERT INTO $this->table VALUES ($push_values)");
        echo $push_values;
        if(!$add->execute()){
            throw new \Exception("ERROR WRITING");
        }
    }


    function makeTable($type, $name=NULL, $size=NULL)
    {
        $column = '';

        if($name == NULL && $type != 'id' && $type != 'finish')throw new \Exception("Enter the NAME");
        if($size == NULL && $type == 'varchar')throw new \Exception("Enter the SIZE");

        $this->migration = str_replace('@TABLENAME', $this->table, $this->migration);

        switch($type){
            case 'id': 
                $this->migration = str_replace('@REQUEST', "`id` INT NOT NULL AUTO_INCREMENT, @REQUEST", $this->migration);
                break;
            case 'varchar': 
                $this->migration = str_replace('@REQUEST', "`$name` VARCHAR($size) NOT NULL, @REQUEST", $this->migration);
                break;
            case 'text':
                $this->migration = str_replace('@REQUEST', "`$name` TEXT NOT NULL, @REQUEST", $this->migration);
                break;
            case 'date':
                $this->migration = str_replace('@REQUEST', "`$name` DATE NOT NULL, @REQUEST", $this->migration);
                break;
            case 'time':
                $this->migration = str_replace('@REQUEST', "`$name` TIME NOT NULL, @REQUEST", $this->migration);
                break;
            case 'datetime':
                $this->migration = str_replace('@REQUEST', "`$name` DATETIME NOT NULL, @REQUEST", $this->migration);
                break;
            case 'finish':
                $this->migration = str_replace('@REQUEST', "PRIMARY KEY (`id`)", $this->migration);
                $query = $this->db->prepare($this->migration);
                $query->execute();
                break;
            default: throw new \Exception('TYPE must be entered');
            break;
        }
        echo $this->migration."<hr>";
    }
    

}

