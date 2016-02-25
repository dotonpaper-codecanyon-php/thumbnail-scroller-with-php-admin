<?php

/*
* Title                   : Thumbnail Scroller (with PHP Admin)
* Version                 : 1.1
* File                    : login.php
* File Version            : 1.0
* Created / Last Modified : 10 December 2012
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Admin Login.
*/

    session_start();
    
    if (isset($_POST['username']) && isset($_POST['password'])){
        $DOPTS_load_scripts = true;
        require_once('../../../config.php');

        if (DOPTS_ADMIN_USERNAME == $_POST['username'] && DOPTS_ADMIN_PASSWORD == $_POST['password']){
            $_SESSION['DOP_ThumbnailScroller_isLogin'] = true;
            echo 'success';
        }
        else{
            $_SESSION['DOP_ThumbnailScroller_isLogin'] = false;
            echo 'error';
        }
    }   
    else{
        exit('<h2 style="color:#aaaaaa; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;">Warning! No direct script access allowed.</h2>');        
    }

?>