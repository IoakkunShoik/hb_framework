<?php
    use vendor\DbHandler as DbHandler;

    function example()
    {
        $tmp = new DbHandler("example");
        $tmp->makeTable('id');
        $tmp->makeTable('text', 'name');
        $tmp->makeTable('text', 'lastname');
        $tmp->makeTable('time', 'time');
        $tmp->makeTable('finish');
    }