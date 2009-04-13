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
    $cfg['version'] = '1.0.2';

    function parse_post_data()
    {
        if (!get_magic_quotes_gpc())
        {
            $_POST = slash_input_data($_POST);
        }
        foreach($_POST as $val)
        {
            if(empty($val))
            {
                return 'Empty field found, fill in all fields please';
            }
        }
        return true;
    }

    function slash_input_data(&$data)
    {
    	if (is_array($data))
    	{
    		foreach ($data as $k => $v)
    		{
    			$data[$k] = (is_array($v)) ? slash_input_data($v) : addslashes($v);
    		}
    	}
    	return $data;
    }

    function active_errors()
    {
        if(isset($GLOBALS['errors']) && count($GLOBALS['errors'] > 0))
        {
            return true;
        }
        return false;
    }
    // ERROR CLASS FIXME -- STACK
    function print_errors()
    {
        echo 'Some errors occured, here is a raw dump:<BR>';
        foreach($GLOBALS['errors'] as $err)
        {
            echo $err . '<BR>';
        }
    }
?>
