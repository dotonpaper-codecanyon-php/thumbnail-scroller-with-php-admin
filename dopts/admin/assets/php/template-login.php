<?php

/*
* Title                   : Thumbnail Scroller (with PHP Admin)
* Version                 : 1.1
* File                    : template-login.php
* File Version            : 1.0
* Created / Last Modified : 10 December 2012
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Login template.
*/
    
    if (!isset($DOPTS_load_scripts)){
        exit('<h2 style="color:#aaaaaa; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;">Warning! No direct script access allowed.</h2>');
    }
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo DOPTS_TITLE; ?></title>

        <link rel="stylesheet" type="text/css" href="../libraries/gui/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="assets/gui/css/login-style.css" />

        <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
        <script type="text/JavaScript" src="assets/js/login.js"></script>
    </head>
    <body>

        <div id="DOPTS-wrapper">
            <div id="DOPTS_Login">
                <h1><?php echo DOPTS_TITLE; ?></h1>
                <form method="post" action="" onsubmit="return login()">
                    <label for="username"><?php echo DOPTS_LOGIN_USERNAME; ?></label>
                    <input type="text" name="username" id="username" value="" />
                    <label for="password"><?php echo DOPTS_LOGIN_PASSWORD; ?></label>
                    <input type="password" name="password" id="password" value="" />
                    <input type="submit" name="submit" id="submit" value="<?php echo DOPTS_LOGIN_SUBMIT; ?>" />
                    <br class="DOPTS-clear" />
                </form>
            </div>
            <div id="DOPTS_Info">
                <div class="info_icon">
                    <img src="assets/gui/images/login-info-icon.png" alt="" class="info" />
                    <img src="assets/gui/images/login-loader.gif" alt="" class="loader" />
                </div>
                <div class="info_message">
                    <span class="info"><?php echo DOPTS_LOGIN_INFO; ?></span>
                    <span class="success"><?php echo DOPTS_LOGIN_SUCCESS; ?></span>
                    <span class="error"><?php echo DOPTS_LOGIN_ERROR; ?></span>
                    <span class="processing"><?php echo DOPTS_LOGIN_PROCESSING; ?></span>
                </div>
            </div>
        </div>

    </body>
</html>