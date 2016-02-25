<?php

/*
* Title                   : Thumbnail Scroller (with PHP Admin)
* Version                 : 1.1
* File                    : config.php
* File Version            : 1.0
* Created / Last Modified : 30 May 2012
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Thumbnail Scroller Config.
*/
    
    if (!isset($DOPTS_load_scripts)){
        exit('<h2 style="color:#aaaaaa; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;">Warning! No direct script access allowed.</h2>');
    }
    
    define("DOPTS_ADMIN_USERNAME", ""); // Add admin username.
    define("DOPTS_ADMIN_PASSWORD", ""); // Add admin password.
    define("DOPTS_URL", ""); // Add URL to doptg folder (must end with /).
    define("DOPTS_ABSOLUTE_PATH", ""); // Add ABSOLUTE PATH to dopts folder (must end with /).

?>