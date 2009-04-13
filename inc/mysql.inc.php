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
    
    class mysql
    {
        var $_conn;
        function mysql(&$cfg)
        {
            $this->_conn = @mysql_connect($cfg['db_host'], $cfg['db_user'], $cfg['db_pass']);
            if(!$this->_conn || !@mysql_select_db($cfg['db_db'], $this->_conn))
            {
                $GLOBALS['errors'][] = 'Cant connect to database: ' . mysql_error();
            }
        }

        function get_todo_items()
        {
            $sql = 'SELECT * FROM `todolist` GROUP BY created ORDER by LEVEL DESC';
            $result = mysql_query($sql, $this->_conn);
            
            $todo_array = array();
            while($row = mysql_fetch_array($result))
            {
                $todo_array[$row['id']] = $row;
            }
            return $todo_array;
        }
        function add_todo_item($level_nr, $short, $long)
        {
            $sql = 'INSERT INTO `todolist`(`level`, `short`, `long`, `created`) VALUES("' . $level_nr . '","' . $short . '","' . nl2br($long) . '", UNIX_TIMESTAMP())';
            $result = mysql_query($sql, $this->_conn);
        }
        
        function edit_todo_item($level_nr, $short, $long, $edit_id)
        {
            $sql = "UPDATE `todolist` SET `todolist`.`level`='{$level_nr}', `todolist`.`short`='{$short}', `todolist`.`long`='{$long}' WHERE `todolist`.`id`=$edit_id";
            $result = mysql_query($sql, $this->_conn);
        }

        function get_todo_part($id, $part)
        {
            $sql = 'SELECT `todolist`.`'.$part.'` FROM `todolist` WHERE `todolist`.`id`='.$id;
            $result = mysql_query($sql, $this->_conn);
            //$row = mysql_fetch_row($result);
            return mysql_result($result,0);
        }
        function delete_todo_item($del_id)
        {
            $sql = 'DELETE FROM `todolist` WHERE `todolist`.`id`=' . $del_id;
            @mysql_query($sql, $this->_conn);
        }
    }
?>
