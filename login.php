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

    function login_user($username, $password)
    {
        global $cfg;
        return ($username == $cfg['todo_user'] && $password == $cfg['todo_pass']);
    }

    session_start();
    
    if(isset($_POST['login_sub']))
    {
        if(parse_post_data())
        {
            if(login_user($_POST['username'] ,$_POST['password']))
            {
                $_SESSION['loggedin'] = true;
                header('Location: ' . $_GET['caller']);
            }
            else
	    {
		echo 'Wrong user / pass';
	    }
        }
    }

    if(!isset($_SESSION['loggedin']))
    {
        show_form();
    }
    
    
    function show_form($extra='')
    {
        ?>
        <html>
            <head>
                <title>Rubberduck :: Login</title>
                <link href="styles.css" rel="stylesheet" type="text/css">
            </head>

            <body>

            <form action="<?php echo basename(__FILE__)?>?caller=<?php echo $_GET['caller']?>" method="POST">
            <table width="100%" cellspacing="4" cellpadding="0">
                <tr>
                    <td align="left" height="40" valign="top"><p style="font-weight: bold;">You are not logged in, please login.</p><?=$extra?></td>
                    <td align="right" height="40" valign="top"><a href="javascript:void(null)" onClick="window.close()" class="todo">Close</a></td>
                </tr>
            </table>
            <table cellspacing="4">
            <tr>
                <td>Username</td>
                <td>
                    <input type="text" length=255 size=39 name="username">
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" length=255 size=39 name="password">
                </td>
            </tr>

            <tr>
                <td colspan="2" height="50" valign="middle" align="right">
                    <input type="submit" name="login_sub" value="Login">
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
