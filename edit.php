<?php

    /**
     * 
     *      RUBBERDUCK! Quack.
     *
     *      This software was written by Roeland Nieuwenhuis for the PowerAdmin project
     *      All the stuff belonging to this project is under GPL, oh and if you rip stuff
     *      Please leave my name somewhere, I just love fame!
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
        header('Location: login.php?caller=edit.php');
    }
    elseif(isset($_POST['edit_sub']))
    {
        $ret = parse_post_data();
        if($ret === true)
        {
            $GLOBALS['db']->edit_todo_item($_POST['level_nr'],$_POST['short'], $_POST['long'], $_POST['edit_id']);
            ?>
            <SCRIPT LANGUAGE="JavaScript">opener.location.href = opener.location.href; self.close();</SCRIPT>
            <?php
        } else { ?>
        <html>
        <head>
            <link href="styles.css" rel="stylesheet" type="text/css">
        </head>
        <body>
            <?php echo $ret; ?>
            <br><br>
            <a href="javascript:history.go(-1)" class="todo">Go Back</a>
        </body>
        </html>
        <?php
        }
    }
    else
    {
        ?>
        <html>
        <head>
            <title>Rubberduck :: Editing TODO Item</title>
            <link href="styles.css" rel="stylesheet" type="text/css">
        </head>

        <body>
        
        <form action="<?php echo basename(__FILE__); ?>" method="POST">
        <table width="100%" cellspacing="4" cellpadding="0">
            <tr>
            <td align="left" height="40" valign="top"><b>Editing TODO Item</b></td>
            <td align="right" height="40" valign="top"><a href="javascript:void(null)" onClick="window.close()" class="todo">Close</a></td>
            </tr>
        </table>
        <table cellspacing="4">
        <tr>
            <td>Priority</td>
            <td>
                <select name="level_nr">
                <?php $lvl = $GLOBALS['db']->get_todo_part($_REQUEST['id'], 'level'); ?>
                    <option value="1" <?php if ($lvl == '1') echo 'selected'; ?>>Very Low</option>
                    <option value="2" <?php if ($lvl == '2') echo 'selected'; ?>>Low</option>
                    <option value="3" <?php if ($lvl == '3') echo 'selected'; ?>>Medium</option>
                    <option value="4" <?php if ($lvl == '4') echo 'selected'; ?>>High</option>
                    <option value="5" <?php if ($lvl == '5') echo 'selected'; ?>>Very High</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Short description</td>
            <td>
                <input type="text" length=255 size=39 name="short" value="<?php echo $GLOBALS['db']->get_todo_part($_REQUEST['id'], 'short'); ?>">
            </td>
        </tr>
        <tr>
            <td>Long description</td>
            <td>
                <textarea cols="29" rows="4" name="long"><?php echo $GLOBALS['db']->get_todo_part($_REQUEST['id'], 'long'); ?></textarea>
            </td>
        </tr>

        <tr>
            <td colspan="2" height="50" valign="middle" align="right">
                <input type="hidden" name="edit_id" value="<?php echo $_REQUEST['id']; ?>">
                <input type="submit" name="edit_sub" value="Edit TODO List">
            </td>
        </tr>
        </table>

        </form>
        </p>
        </body>
        </html>
        <?php
    }
?>
