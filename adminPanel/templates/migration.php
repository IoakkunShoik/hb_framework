<?php
    use vendor\DbHandler as DbHandler;

    function @migrationName()
    {
        $table = new DbHandler("@migrationName");
            #$table->makeTable(string column_type, string column_name, int column_size);
            #                  #    id           #  NULL            #   NULL
            #                  #    varchar      #  required        #   required
            #                  #    text         #  required        #   NULL
            #                  #    time         #  required        #   NULL
            #                  #    datetime     #  required        #   NULL
            #                  #    date         #  required        #   NULL
        ### ADD STRUCTURE ###
        $table->makeTable('id');
        
        
        ### END STRUCTURE ###
        $table->makeTable('finish') 

    }