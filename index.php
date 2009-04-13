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
    
    session_start(); 
    
    function draw_todo_item($id, $level, $short)
    {
        global $cfg;
        ?> 
        <tr id="cell">
            <td class="deletebottom deleteright" width=40 bgcolor=<?php echo $cfg['colours']['level_' . $level]; ?>>&nbsp;</td>
            <td class="deletebottom" width=430>
                <a class="todo" href="index.php?long=<?php echo $id; ?>"><?php echo $short; ?></a></td>
            <td class="infocell deletebottom deleteleft">
                <a href="javascript:void(null)" onClick="javascript:window.open('edit.php?id=<?php echo $id; ?>','','height=270,width=450,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizeable=no')" class="todo">edit</a>
            </td>
            <td class="infocell deletebottom deleteleft">
                <a class="red" href="delete.php?id=<?php echo $id; ?>">delete</a>
            </td>
        </tr><?php
    }
    
    function draw_long_item($id, $level, $short, $long, $created)
    {
        global $cfg;
        ?>
        <tr id="cell">
            <td class="deleteright" width="40" bgcolor=<?php echo $cfg['colours']['level_' . $level]; ?> nowrap>&nbsp;</td>
            <td width="380" nowrap>
            <b>Long description for: </b><?php echo $short; ?><br>
            <b>Date added: </b><?php echo date('M d Y', $created); ?>
            <p><?php echo $long; ?></p>
            </td>
            <td width="50" class="infocell deleteleft" nowrap>
                <a href="javascript:void(null)" onClick="javascript:window.open('edit.php?id=<?php echo $id; ?>','','height=270,width=450,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizeable=no')" class="todo">edit</a>
            </td>
            <td width="50" class="infocell deleteleft">
                <a class="red" href="delete.php?id=<?php echo $id; ?>">delete</a>
            </td>
        </tr>
        <tr><td colspan="3" height="5">&nbsp;</td></tr><?php
    }

    function footer()
    {
        global $cfg;
        ?>
        </table>
        </td></tr></table>
        </table>
        <p class="footer"><a href="http://www.poweradmin.org/rubberduck" class="todo">Powered by Rubberduck TODO List <?php echo $cfg['version']; ?><br>By Roeland Nieuwenhuis and Nicholas Penree</a></p>
        </body>
        </html>
        <?php
    }
    if(isset($_GET['logout']))
    {
        session_unset();
        session_destroy();
    }
?>

<!doctype html public "-//W3C//DTD HTML 4.0 //EN">
<html>
<head>
    <title>Rubberduck :: <?php echo $cfg['todo_title']; ?></title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>

<br><p class="header"><?php echo $cfg['todo_title']; ?></p> <!-- FIXME -->
<table cellspacing="0" cellpadding="0" align="center">
<tr>
    <td height="300" width="100" valign="top">
        <table width="100" height="250" cellpadding="2" cellspacing="0">
        <tr id="cell">
            <td class="leftmenu">
                <p>
                    <a href="javascript:void(null)" onClick="javascript:window.open('add.php','','height=270,width=450,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizeable=no')" class="todo">Add item</a>
                </p>
            </td>
        </tr>
        <tr>
            <td height="20" align="center" valign="bottom">
            <p>
                <a href="<?php echo basename(__FILE__);?>?logout=true" class="todo">Logout</a>
            </p>
            </td>
        </tr>
        </table>
    </td>
        
    <td width="8">&nbsp;<!-- spacing between 'NAV' and todo items --></td>
    <td valign="top">
    <table width="520" border="0" cellpadding="2" cellspacing="0" align="center">
<?php
    if(active_errors())
    {
        print_errors();
        footer();
        die();
    }
    else
    {
        $todo_array = $GLOBALS['db']->get_todo_items();
        if(isset($_GET['long']))
        {
            $id = $_GET['long'];
            if (isset($todo_array[$id]) && in_array($todo_array[$id], $todo_array)) 
            {
                draw_long_item($id, $todo_array[$id]['level'], $todo_array[$id]['short'], $todo_array[$id]['long'], $todo_array[$id]['created']);
                unset($todo_array[$id]);
            } 
            else 
            {
                echo '<div align="center"><b>Error:</b> No TODO item with an id of '.$id.' exists. <a href="javascript:history.go(-1)" class="todo">Go Back</a>.</div><br>';
            }
        }
        elseif(count($todo_array) == 0)
        {
            ?>Nothing on the TODO list yet.<?php
        } 
            foreach($todo_array as $todo_id => $todo_item)
            {
                draw_todo_item($todo_item['id'], $todo_item['level'], $todo_item['short']);
            }
            if(count($todo_array) > 0)
            {
                ?>
                <tr>
                    <td colspan="4" class="topborder">&nbsp;</td>                  
                </tr><?php 
            } 
    }
    footer();
?>



