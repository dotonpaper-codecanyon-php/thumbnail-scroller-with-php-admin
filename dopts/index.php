<?php

    if (isset($_GET['scroller_id'])){
        $DOPTS_load_scripts = true;
    }
    include_once 'config.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Thumbnail Scroller (with PHP Admin)</title>
        
        <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo DOPTS_URL; ?>dopts/assets/gui/css/jquery.dop.ThumbnailScroller.css" />
        <script type="text/JavaScript" src="<?php echo DOPTS_URL; ?>dopts/assets/js/jquery.dop.ThumbnailScroller.js"></script>
        
        <script type="text/JavaScript">
            $(document).ready(function(){
                $('#DOPThumbnailScrollerContainer').DOPThumbnailScroller({'URL': '<?php echo DOPTS_URL; ?>', 'SettingsFilePath': '<?php echo DOPTS_URL; ?>dopts/data/settings<?php echo $_GET['scroller_id']; ?>.json', 'ContentFilePath': '<?php echo DOPTS_URL; ?>dopts/data/content<?php echo $_GET['scroller_id']; ?>.json'});                
            });
        </script>
        
	<script type="text/JavaScript">
<!--            
            function clickIE4(){ 
                if (event.button == 2){ 
                    return false; 
                } 
            } 
            
            function clickNS4(e){ 
                if (document.layers || document.getElementById && !document.all){ 
                    if (e.which==2||e.which==3){ 
                        return false; 
                    } 
                } 
            } 
            
            if (document.layers){
                document.captureEvents(Event.MOUSEDOWN); 
                document.onmousedown = clickNS4; 
            } 
            else if (document.all && !document.getElementById){ 
                document.onmousedown = clickIE4;
            } 
            
            document.oncontextmenu = new Function("return false") ;
//-->            
        </script>
    </head>
    <body style="margin:0; padding:0;">
        <div id="DOPThumbnailScrollerContainer"></div>
    </body>
</html>