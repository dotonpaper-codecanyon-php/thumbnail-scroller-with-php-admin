<?php

/*
* Title                   : Thumbnail Scroller (with PHP Admin)
* Version                 : 1.1
* File                    : paths.php
* File Version            : 1.0
* Created / Last Modified : 30 May 2012
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Thumbnail Scroller Paths.
*/

?>

<html>
    <head>
        <title>Thumbnail Scroller Paths</title>
        <style type="text/css">
            body{
                font-family: Arial, Helvetica, sans-serif; 
                margin: 0; 
                padding: 30px;
            }
                        
            .title{
                display: inline-block;
                font-size: 14px;
                font-weight: bold; 
                width: 120px;
            }
            
            .data{
                font-size: 14px;
                color: #999999;
            }
        </style>
    </head>
    <body>
<?php

    
    $path_pieces = explode('dopts', curPageURL());
    echo '<span class="title">URL: </span><span class="data">'.$path_pieces[0].'</span><br />';
    
    
    $path_pieces = explode('dopts', realpath(''));
    echo  '<span class="title">Absolute Path: </span><span class="data">'.$path_pieces[0].'</span>';
    
    function curPageURL(){
        $pageURL = 'http';

        if ($_SERVER["HTTPS"] == "on"){
            $pageURL .= "s";
        }
        $pageURL .= "://";

        if ($_SERVER["SERVER_PORT"] != "80"){
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } 
        else{
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }


?>
    </body>
</html>    
    