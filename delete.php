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

    require_once('inc/common.inc.php');
    require_once('inc/database.inc.php');
    $GLOBALS['db'] = Database::getDB();
    
    if(active_errors())
    {
        print_errors();
        die();
    }

    session_start();
    
    if(!isset($_SESSION['loggedin']))
    {
        header('Location: login.php?caller=delete.php?id=' . $_GET['id']);
    }
    elseif(isset($_GET['id']))
    {
        $_GET = slash_input_data($_GET);
        $GLOBALS['db']->delete_todo_item($_GET['id']);
        header('Location: index.php');
    }
    

?>


