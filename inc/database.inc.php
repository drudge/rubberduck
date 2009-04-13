<?php

    /**
     * 
     *      rubberduck! quack.
     *
     *      this software was written by roeland nieuwenhuis for the poweradmin project
     *      all the stuff belonging to this project is under gpl, oh and if you rip stuff
     *      please leave my name somewhere, i just love fame!
     *
     **/
    
    require_once('config.inc.php');
    class database
    {
        /* Singleton */
        var $_cfg;
        function database()
        {
            print_r($this->_cfg);
        }
        
        function getDB()
        {
            static $db;
            if(!isset($db))
            {
                global $cfg;
                require_once($cfg['db_type'].'.inc.php');
                $db = new $cfg['db_type']($cfg);
            }
            return $db;
        }
    }
?>
