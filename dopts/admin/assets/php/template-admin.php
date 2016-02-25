<?php

/*
* Title                   : Thumbnail Scroller (with PHP Admin)
* Version                 : 1.1
* File                    : template-admin.php
* File Version            : 1.0
* Created / Last Modified : 10 December 2012
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Admin template.
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
        <link rel="stylesheet" type="text/css" href="../libraries/gui/css/uploadify.css" />
        <link rel="stylesheet" type="text/css" href="../libraries/gui/css/jquery.Jcrop.css" />
        <link rel="stylesheet" type="text/css" href="../libraries/gui/css/colorpicker.css" />
        <link rel="stylesheet" type="text/css" href="assets/gui/css/style.css" />

        <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
        <script type="text/JavaScript" src="../libraries/js/swfobject.js"></script>
        <script type="text/JavaScript" src="../libraries/js/jquery.uploadify.min.js"></script>
        <script type="text/JavaScript" src="../libraries/js/jquery.Jcrop.min.js"></script>
        <script type="text/JavaScript" src="../libraries/js/colorpicker.js"></script>
        <script type="text/JavaScript" src="../libraries/js/jquery.dop.ImageLoader.min.js"></script>
        <script type="text/JavaScript" src="assets/js/admin.js"></script>  
                        
        <script type="text/JavaScript">
            var DOPTS_curr_page = "Scrollers List",
            DOPTS_URL = "<?php echo DOPTS_URL?>",
            DOPTS_ABSOLUTE_PATH = "<?php echo DOPTS_ABSOLUTE_PATH?>",

            DOPTS_TITLE = "<?php echo DOPTS_TITLE?>",
            DOPTS_SIGN_OUT = "<?php echo DOPTS_TITLE?>",
    
            // Loading ...
            DOPTS_LOAD = "<?php echo DOPTS_LOAD?>",
            DOPTS_SCROLLERS_LOADED = "<?php echo DOPTS_SCROLLERS_LOADED?>",
            DOPTS_IMAGES_LOADED = "<?php echo DOPTS_IMAGES_LOADED?>",
            DOPTS_NO_SCROLLERS = "<?php echo DOPTS_NO_SCROLLERS?>",
            DOPTS_NO_IMAGES = "<?php echo DOPTS_NO_IMAGES?>",
            DOPTS_SCROLLER_LOADED = "<?php echo DOPTS_SCROLLER_LOADED?>",
            DOPTS_IMAGE_LOADED = "<?php echo DOPTS_IMAGE_LOADED?>",

            // Save ...
            DOPTS_SAVE = "<?php echo DOPTS_SAVE?>",
            DOPTS_SELECT_FILE = "<?php echo DOPTS_SELECT_FILE?>",

            // Help
            DOPTS_SCROLLERS_HELP = "<?php echo DOPTS_SCROLLERS_HELP?>",
            DOPTS_SCROLLERS_EDIT_INFO_HELP = "<?php echo DOPTS_SCROLLERS_EDIT_INFO_HELP?>",
            DOPTS_SCROLLER_EDIT_HELP = "<?php echo DOPTS_SCROLLER_EDIT_HELP?>",
            DOPTS_SCROLLER_EDIT_INFO_HELP = "<?php echo DOPTS_SCROLLER_EDIT_INFO_HELP?>",
            DOPTS_ADD_IMAGES_HELP = "<?php echo DOPTS_ADD_IMAGES_HELP?>",
            DOPTS_ADD_IMAGES_HELP_WP = "<?php echo DOPTS_ADD_IMAGES_HELP_WP?>",
            DOPTS_ADD_IMAGES_HELP_AJAX = "<?php echo DOPTS_ADD_IMAGES_HELP_AJAX?>",
            DOPTS_ADD_IMAGES_HELP_UPLOADIFY = "<?php echo DOPTS_ADD_IMAGES_HELP_UPLOADIFY?>",
            DOPTS_ADD_IMAGES_HELP_FTP = "<?php echo DOPTS_ADD_IMAGES_HELP_FTP?>",
            DOPTS_IMAGE_EDIT_HELP = "<?php echo DOPTS_IMAGE_EDIT_HELP?>",

            // Form
            DOPTS_SUBMIT = "<?php echo DOPTS_SUBMIT?>",
            DOPTS_DELETE = "<?php echo DOPTS_DELETE?>",
            DOPTS_DEFAULT = "<?php echo DOPTS_DEFAULT?>",

            // Add Scroller
            DOPTS_ADD_SCROLLER_NAME = "<?php echo DOPTS_ADD_SCROLLER_NAME?>",
            DOPTS_ADD_SCROLLER_SUBMIT = "<?php echo DOPTS_ADD_SCROLLER_SUBMIT?>",
            DOPTS_ADD_SCROLLER_SUBMITED = "<?php echo DOPTS_ADD_SCROLLER_SUBMITED?>",
            DOPTS_ADD_SCROLLER_SUCCESS = "<?php echo DOPTS_ADD_SCROLLER_SUCCESS?>",

            // Edit Scrollers
            DOPTS_EDIT_SCROLLERS_SUBMIT = "<?php echo DOPTS_EDIT_SCROLLERS_SUBMIT?>",
            DOPTS_EDIT_SCROLLERS_SUCCESS = "<?php echo DOPTS_EDIT_SCROLLERS_SUCCESS?>",

            // Edit Scroller
            DOPTS_EDIT_SCROLLER_SUBMIT = "<?php echo DOPTS_EDIT_SCROLLER_SUBMIT?>",
            DOPTS_EDIT_SCROLLER_SUCCESS = "<?php echo DOPTS_EDIT_SCROLLER_SUCCESS?>",
            DOPTS_EDIT_SCROLLER_USE_DEFAULT_CONFIRMATION = "<?php echo DOPTS_EDIT_SCROLLER_USE_DEFAULT_CONFIRMATION?>",    
            
            // Generate Scroller Code
            DOPTS_EDIT_SCROLLER_CODE = "<?php echo DOPTS_EDIT_SCROLLER_CODE?>",
            DOPTS_EDIT_SCROLLER_CODE_HELP = "<?php echo DOPTS_EDIT_SCROLLER_CODE_HELP?>",
            DOPTS_EDIT_SCROLLER_CODE_INCLUDE_JQUERY = "<?php echo DOPTS_EDIT_SCROLLER_CODE_INCLUDE_JQUERY?>",
            DOPTS_EDIT_SCROLLER_CODE_INCLUDE_JQUERY_UI = "<?php echo DOPTS_EDIT_SCROLLER_CODE_INCLUDE_JQUERY_UI?>",
            DOPTS_EDIT_SCROLLER_CODE_INCLUDE_SCROLLER = "<?php echo DOPTS_EDIT_SCROLLER_CODE_INCLUDE_SCROLLER?>",
            DOPTG_EDIT_SCROLLER_CODE_SCROLLER_EMBED = "<?php echo DOPTG_EDIT_SCROLLER_CODE_SCROLLER_EMBED?>",
            DOPTS_EDIT_SCROLLER_CODE_COPY = "<?php echo DOPTS_EDIT_SCROLLER_CODE_COPY?>",
            DOPTS_EDIT_SCROLLER_CODE_LINK = "<?php echo DOPTS_EDIT_SCROLLER_CODE_LINK?>",

            // Delete Scroller
            DOPTS_DELETE_SCROLLER_CONFIRMATION = "<?php echo DOPTS_DELETE_SCROLLER_CONFIRMATION?>",
            DOPTS_DELETE_SCROLLER_SUBMIT = "<?php echo DOPTS_DELETE_SCROLLER_SUBMIT?>",
            DOPTS_DELETE_SCROLLER_SUBMITED = "<?php echo DOPTS_DELETE_SCROLLER_SUBMITED?>",
            DOPTS_DELETE_SCROLLER_SUCCESS = "<?php echo DOPTS_DELETE_SCROLLER_SUCCESS?>",

            // Add Image
            DOPTS_ADD_IMAGE_SUBMIT = "<?php echo DOPTS_ADD_IMAGE_SUBMIT?>",
            DOPTS_ADD_IMAGE_WP_UPLOAD = "<?php echo DOPTS_ADD_IMAGE_WP_UPLOAD?>",
            DOPTS_ADD_IMAGE_SIMPLE_UPLOAD = "<?php echo DOPTS_ADD_IMAGE_SIMPLE_UPLOAD?>",
            DOPTS_ADD_IMAGE_MULTIPLE_UPLOAD = "<?php echo DOPTS_ADD_IMAGE_MULTIPLE_UPLOAD?>",
            DOPTS_ADD_IMAGE_FTP_UPLOAD = "<?php echo DOPTS_ADD_IMAGE_FTP_UPLOAD?>",
            DOPTS_ADD_IMAGE_SUBMITED = "<?php echo DOPTS_ADD_IMAGE_SUBMITED?>",
            DOPTS_ADD_IMAGE_SUCCESS = "<?php echo DOPTS_ADD_IMAGE_SUCCESS?>",
            DOPTS_SELECT_IMAGES = "<?php echo DOPTS_SELECT_IMAGES?>",
            DOPTS_SELECT_FTP_IMAGES = "<?php echo DOPTS_SELECT_FTP_IMAGES?>",

            // Sort Image
            DOPTS_SORT_IMAGES_SUBMITED = "<?php echo DOPTS_SORT_IMAGES_SUBMITED?>",
            DOPTS_SORT_IMAGES_SUCCESS = "<?php echo DOPTS_SORT_IMAGES_SUCCESS?>",

            // Edit Image
            DOPTS_EDIT_IMAGE_SUBMIT = "<?php echo DOPTS_EDIT_IMAGE_SUBMIT?>",
            DOPTS_EDIT_IMAGE_SUCCESS = "<?php echo DOPTS_EDIT_IMAGE_SUCCESS?>",
            DOPTS_EDIT_IMAGE_CROP_THUMBNAIL = "<?php echo DOPTS_EDIT_IMAGE_CROP_THUMBNAIL?>",
            DOPTS_EDIT_IMAGE_CURRENT_THUMBNAIL = "<?php echo DOPTS_EDIT_IMAGE_CURRENT_THUMBNAIL?>",
            DOPTS_EDIT_IMAGE_TITLE = "<?php echo DOPTS_EDIT_IMAGE_TITLE?>",
            DOPTS_EDIT_IMAGE_CAPTION = "<?php echo DOPTS_EDIT_IMAGE_CAPTION?>",
            DOPTS_EDIT_IMAGE_MEDIA = "<?php echo DOPTS_EDIT_IMAGE_MEDIA?>",
            DOPTS_EDIT_IMAGE_LIGHTBOX_MEDIA = "<?php echo DOPTS_EDIT_IMAGE_LIGHTBOX_MEDIA?>",
            DOPTS_EDIT_IMAGE_LINK = "<?php echo DOPTS_EDIT_IMAGE_LINK?>",
            DOPTS_EDIT_IMAGE_LINK_TARGET = "<?php echo DOPTS_EDIT_IMAGE_LINK_TARGET?>",
            DOPTS_EDIT_IMAGE_ENABLED = "<?php echo DOPTS_EDIT_IMAGE_ENABLED?>",

            // Delete Image
            DOPTS_DELETE_IMAGE_CONFIRMATION = "<?php echo DOPTS_DELETE_IMAGE_CONFIRMATION?>",
            DOPTS_DELETE_IMAGE_SUBMIT = "<?php echo DOPTS_DELETE_IMAGE_SUBMIT?>",
            DOPTS_DELETE_IMAGE_SUBMITED = "<?php echo DOPTS_DELETE_IMAGE_SUBMITED?>",
            DOPTS_DELETE_IMAGE_SUCCESS = "<?php echo DOPTS_DELETE_IMAGE_SUCCESS?>",

            // TinyMCE
             DOPTS_TINYMCE_ADD = "<?php echo DOPTS_TINYMCE_ADD?>",

            // Settings
            DOPTS_GENERAL_STYLES_SETTINGS = "<?php echo DOPTS_GENERAL_STYLES_SETTINGS?>",
            DOPTS_SCROLLER_NAME = "<?php echo DOPTS_SCROLLER_NAME?>",
            DOPTS_WIDTH = "<?php echo DOPTS_WIDTH?>",
            DOPTS_HEIGHT = "<?php echo DOPTS_HEIGHT?>",
            DOPTS_BG_COLOR = "<?php echo DOPTS_BG_COLOR?>",
            DOPTS_BG_ALPHA = "<?php echo DOPTS_BG_ALPHA?>",
            DOPTS_BG_BORDER_SIZE = "<?php echo DOPTS_BG_BORDER_SIZE?>",
            DOPTS_BG_BORDER_COLOR = "<?php echo DOPTS_BG_BORDER_COLOR?>",
            DOPTS_IMAGES_ORDER = "<?php echo DOPTS_IMAGES_ORDER?>",
            DOPTS_RESPONSIVE_ENABLED = "<?php echo DOPTS_RESPONSIVE_ENABLED?>",

            DOPTS_THUMBNAILS_STYLES_SETTINGS = "<?php echo DOPTS_THUMBNAILS_STYLES_SETTINGS?>",
            DOPTS_THUMBNAILS_POSITION = "<?php echo DOPTS_THUMBNAILS_POSITION?>",
            DOPTS_THUMBNAILS_BG_COLOR = "<?php echo DOPTS_THUMBNAILS_BG_COLOR?>",
            DOPTS_THUMBNAILS_BG_ALPHA = "<?php echo DOPTS_THUMBNAILS_BG_ALPHA?>",
            DOPTS_THUMBNAILS_BORDER_SIZE = "<?php echo DOPTS_THUMBNAILS_BORDER_SIZE?>",
            DOPTS_THUMBNAILS_BORDER_COLOR = "<?php echo DOPTS_THUMBNAILS_BORDER_COLOR?>",
            DOPTS_THUMBNAILS_SPACING = "<?php echo DOPTS_THUMBNAILS_SPACING?>",
            DOPTS_THUMBNAILS_MARGIN_TOP = "<?php echo DOPTS_THUMBNAILS_MARGIN_TOP?>",
            DOPTS_THUMBNAILS_MARGIN_RIGHT = "<?php echo DOPTS_THUMBNAILS_MARGIN_RIGHT?>",
            DOPTS_THUMBNAILS_MARGIN_BOTTOM = "<?php echo DOPTS_THUMBNAILS_MARGIN_BOTTOM?>",
            DOPTS_THUMBNAILS_MARGIN_LEFT = "<?php echo DOPTS_THUMBNAILS_MARGIN_LEFT?>",
            DOPTS_THUMBNAILS_PADDING_TOP = "<?php echo DOPTS_THUMBNAILS_PADDING_TOP?>",
            DOPTS_THUMBNAILS_PADDING_RIGHT = "<?php echo DOPTS_THUMBNAILS_PADDING_RIGHT?>",
            DOPTS_THUMBNAILS_PADDING_BOTTOM = "<?php echo DOPTS_THUMBNAILS_PADDING_BOTTOM?>",
            DOPTS_THUMBNAILS_PADDING_LEFT = "<?php echo DOPTS_THUMBNAILS_PADDING_LEFT?>",
            DOPTS_THUMBNAILS_INFO = "<?php echo DOPTS_THUMBNAILS_INFO?>",

            DOPTS_THUMBNAILS_NAVIGATION_STYLES_SETTINGS = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_STYLES_SETTINGS?>",
            DOPTS_THUMBNAILS_NAVIGATION_EASING = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_EASING?>",
            DOPTS_THUMBNAILS_NAVIGATION_LOOP = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_LOOP?>",
            DOPTS_THUMBNAILS_NAVIGATION_MOUSE_ENABLED = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_MOUSE_ENABLED?>",

            DOPTS_THUMBNAILS_NAVIGATION_SCROLL_ENABLED = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_SCROLL_ENABLED?>",  
            DOPTS_THUMBNAILS_NAVIGATION_SCROLL_POSITION = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_SCROLL_POSITION?>",
            DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SIZE = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SIZE?>",
            DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SCRUB_COLOR = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SCRUB_COLOR?>",
            DOPTS_THUMBNAILS_NAVIGATION_SCROLL_BAR_COLOR = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_SCROLL_BAR_COLOR?>",

            DOPTS_THUMBNAILS_NAVIGATION_ARROWS_ENABLED = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_ARROWS_ENABLED?>",
            DOPTS_THUMBNAILS_NAVIGATION_ARROWS_NO_ITEMS_SLIDE = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_ARROWS_NO_ITEMS_SLIDE?>",
            DOPTS_THUMBNAILS_NAVIGATION_ARROWS_SPEED = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_ARROWS_SPEED?>",
            DOPTS_THUMBNAILS_NAVIGATION_PREV = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_PREV?>",
            DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_SUBMITED = "<?php echo DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_SUBMITED?>",
            DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_SUCCESS = "<?php echo DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_SUCCESS?>",
            DOPTS_THUMBNAILS_NAVIGATION_PREV_HOVER = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_PREV_HOVER?>",
            DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_HOVER_SUBMITED = "<?php echo DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_HOVER_SUBMITED?>",
            DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_HOVER_SUCCESS = "<?php echo DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_HOVER_SUCCESS?>",
            DOPTS_THUMBNAILS_NAVIGATION_PREV_DISABLED = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_PREV_DISABLED?>",
            DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_DISABLED_SUBMITED = "<?php echo DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_DISABLED_SUBMITED?>",
            DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_DISABLED_SUCCESS = "<?php echo DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_DISABLED_SUCCESS?>",
            DOPTS_THUMBNAILS_NAVIGATION_NEXT = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_NEXT?>",
            DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_SUBMITED = "<?php echo DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_SUBMITED?>",
            DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_SUCCESS = "<?php echo DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_SUCCESS?>",
            DOPTS_THUMBNAILS_NAVIGATION_NEXT_HOVER = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_NEXT_HOVER?>",
            DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_HOVER_SUBMITED = "<?php echo DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_HOVER_SUBMITED?>",
            DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_HOVER_SUCCESS = "<?php echo DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_HOVER_SUCCESS?>",
            DOPTS_THUMBNAILS_NAVIGATION_NEXT_DISABLED = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_NEXT_DISABLED?>",
            DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_DISABLED_SUBMITED = "<?php echo DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_DISABLED_SUBMITED?>",
            DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_DISABLED_SUCCESS = "<?php echo DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_DISABLED_SUCCESS?>",

            DOPTS_THUMBNAIL_STYLES_SETTINGS = "<?php echo DOPTS_THUMBNAIL_STYLES_SETTINGS?>",
            DOPTS_THUMBNAIL_LOADER = "<?php echo DOPTS_THUMBNAIL_LOADER?>",
            DOPTS_ADD_THUMBNAIL_LOADER_SUBMITED = "<?php echo DOPTS_ADD_THUMBNAIL_LOADER_SUBMITED?>",
            DOPTS_ADD_THUMBNAIL_LOADER_SUCCESS = "<?php echo DOPTS_ADD_THUMBNAIL_LOADER_SUCCESS?>",
            DOPTS_THUMBNAIL_WIDTH = "<?php echo DOPTS_THUMBNAIL_WIDTH?>",
            DOPTS_THUMBNAIL_HEIGHT = "<?php echo DOPTS_THUMBNAIL_HEIGHT?>",
            DOPTS_THUMBNAIL_ALPHA = "<?php echo DOPTS_THUMBNAIL_ALPHA?>",
            DOPTS_THUMBNAIL_ALPHA_HOVER = "<?php echo DOPTS_THUMBNAIL_ALPHA_HOVER?>",
            DOPTS_THUMBNAIL_BG_COLOR = "<?php echo DOPTS_THUMBNAIL_BG_COLOR?>",
            DOPTS_THUMBNAIL_BG_COLOR_HOVER = "<?php echo DOPTS_THUMBNAIL_BG_COLOR_HOVER?>",
            DOPTS_THUMBNAIL_BORDER_SIZE = "<?php echo DOPTS_THUMBNAIL_BORDER_SIZE?>",
            DOPTS_THUMBNAIL_BORDER_COLOR = "<?php echo DOPTS_THUMBNAIL_BORDER_COLOR?>",
            DOPTS_THUMBNAIL_BORDER_COLOR_HOVER = "<?php echo DOPTS_THUMBNAIL_BORDER_COLOR_HOVER?>",
            DOPTS_THUMBNAIL_PADDING_TOP = "<?php echo DOPTS_THUMBNAIL_PADDING_TOP?>",
            DOPTS_THUMBNAIL_PADDING_RIGHT = "<?php echo DOPTS_THUMBNAIL_PADDING_RIGHT?>",
            DOPTS_THUMBNAIL_PADDING_BOTTOM = "<?php echo DOPTS_THUMBNAIL_PADDING_BOTTOM?>",
            DOPTS_THUMBNAIL_PADDING_LEFT = "<?php echo DOPTS_THUMBNAIL_PADDING_LEFT?>",

            DOPTS_LIGHTBOX_STYLES_SETTINGS = "<?php echo DOPTS_LIGHTBOX_STYLES_SETTINGS?>",   
            DOPTS_LIGHTBOX_ENABLED = "<?php echo DOPTS_LIGHTBOX_ENABLED?>",   
            DOPTS_LIGHTBOX_DISPLAY_TIME = "<?php echo DOPTS_LIGHTBOX_DISPLAY_TIME?>",   
            DOPTS_LIGHTBOX_WINDOW_COLOR = "<?php echo DOPTS_LIGHTBOX_WINDOW_COLOR?>",   
            DOPTS_LIGHTBOX_WINDOW_ALPHA = "<?php echo DOPTS_LIGHTBOX_WINDOW_ALPHA?>",   
            DOPTS_LIGHTBOX_LOADER = "<?php echo DOPTS_LIGHTBOX_LOADER?>",   
            DOPTS_ADD_LIGHTBOX_LOADER_SUBMITED = "<?php echo DOPTS_ADD_LIGHTBOX_LOADER_SUBMITED?>",
            DOPTS_ADD_LIGHTBOX_LOADER_SUCCESS = "<?php echo DOPTS_ADD_LIGHTBOX_LOADER_SUCCESS?>",
            DOPTS_LIGHTBOX_BACKGROUND_COLOR = "<?php echo DOPTS_LIGHTBOX_BACKGROUND_COLOR?>",   
            DOPTS_LIGHTBOX_BACKGROUND_ALPHA = "<?php echo DOPTS_LIGHTBOX_BACKGROUND_ALPHA?>", 
            DOPTS_LIGHTBOX_BORDER_SIZE = "<?php echo DOPTS_LIGHTBOX_BORDER_SIZE?>", 
            DOPTS_LIGHTBOX_BORDER_COLOR = "<?php echo DOPTS_LIGHTBOX_BORDER_COLOR?>",     
            DOPTS_LIGHTBOX_CAPTION_TEXT_COLOR = "<?php echo DOPTS_LIGHTBOX_CAPTION_TEXT_COLOR?>",     
            DOPTS_LIGHTBOX_MARGIN_TOP = "<?php echo DOPTS_LIGHTBOX_MARGIN_TOP?>",   
            DOPTS_LIGHTBOX_MARGIN_RIGHT = "<?php echo DOPTS_LIGHTBOX_MARGIN_RIGHT?>",   
            DOPTS_LIGHTBOX_MARGIN_BOTTOM = "<?php echo DOPTS_LIGHTBOX_MARGIN_BOTTOM?>",   
            DOPTS_LIGHTBOX_MARGIN_LEFT = "<?php echo DOPTS_LIGHTBOX_MARGIN_LEFT?>",   
            DOPTS_LIGHTBOX_PADDING_TOP = "<?php echo DOPTS_LIGHTBOX_PADDING_TOP?>",   
            DOPTS_LIGHTBOX_PADDING_RIGHT = "<?php echo DOPTS_LIGHTBOX_PADDING_RIGHT?>",  
            DOPTS_LIGHTBOX_PADDING_BOTTOM = "<?php echo DOPTS_LIGHTBOX_PADDING_BOTTOM?>",  
            DOPTS_LIGHTBOX_PADDING_LEFT = "<?php echo DOPTS_LIGHTBOX_PADDING_LEFT?>",  

            DOPTS_LIGHTBOX_NAVIGATION_STYLES_SETTINGS = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_STYLES_SETTINGS?>",  
            DOPTS_LIGHTBOX_NAVIGATION_PREV = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_PREV?>",   
            DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_SUBMITED = "<?php echo DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_SUBMITED?>",
            DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_SUCCESS = "<?php echo DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_SUCCESS?>",
            DOPTS_LIGHTBOX_NAVIGATION_PREV_HOVER = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_PREV_HOVER?>",   
            DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_HOVER_SUBMITED = "<?php echo DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_HOVER_SUBMITED?>",
            DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_HOVER_SUCCESS = "<?php echo DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_HOVER_SUCCESS?>",
            DOPTS_LIGHTBOX_NAVIGATION_NEXT = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_NEXT?>",   
            DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_SUBMITED = "<?php echo DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_SUBMITED?>",
            DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_SUCCESS = "<?php echo DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_SUCCESS?>",
            DOPTS_LIGHTBOX_NAVIGATION_NEXT_HOVER = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_NEXT_HOVER?>",   
            DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_HOVER_SUBMITED = "<?php echo DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_HOVER_SUBMITED?>",
            DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_HOVER_SUCCESS = "<?php echo DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_HOVER_SUCCESS?>",
            DOPTS_LIGHTBOX_NAVIGATION_CLOSE = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_CLOSE?>",   
            DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_SUBMITED = "<?php echo DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_SUBMITED?>",
            DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_SUCCESS = "<?php echo DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_SUCCESS?>",
            DOPTS_LIGHTBOX_NAVIGATION_CLOSE_HOVER = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_CLOSE_HOVER?>",   
            DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_HOVER_SUBMITED = "<?php echo DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_HOVER_SUBMITED?>",
            DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_HOVER_SUCCESS = "<?php echo DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_HOVER_SUCCESS?>",
            DOPTS_LIGHTBOX_NAVIGATION_INFO_BG_COLOR = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_INFO_BG_COLOR?>",
            DOPTS_LIGHTBOX_NAVIGATION_INFO_TEXT_COLOR = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_INFO_TEXT_COLOR?>",
            DOPTS_LIGHTBOX_NAVIGATION_DISPLAY_TIME = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_DISPLAY_TIME?>",
            DOPTS_LIGHTBOX_NAVIGATION_TOUCH_DEVICE_SWIPE_ENABLED = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_TOUCH_DEVICE_SWIPE_ENABLED?>",

            DOPTS_TOOLTIP_STYLES_SETTINGS = "<?php echo DOPTS_TOOLTIP_STYLES_SETTINGS?>",
            DOPTS_TOOLTIP_BG_COLOR = "<?php echo DOPTS_TOOLTIP_BG_COLOR?>",
            DOPTS_TOOLTIP_STROKE_COLOR = "<?php echo DOPTS_TOOLTIP_STROKE_COLOR?>",
            DOPTS_TOOLTIP_TEXT_COLOR = "<?php echo DOPTS_TOOLTIP_TEXT_COLOR?>",

            DOPTS_LABEL_STYLES_SETTINGS = "<?php echo DOPTS_LABEL_STYLES_SETTINGS?>",
            DOPTS_LABEL_ALWAYS_VISIBLE = "<?php echo DOPTS_LABEL_ALWAYS_VISIBLE?>",
            DOPTS_LABEL_POSITION = "<?php echo DOPTS_LABEL_POSITION?>",
            DOPTS_LABEL_BG_COLOR = "<?php echo DOPTS_LABEL_BG_COLOR?>",
            DOPTS_LABEL_BG_ALPHA = "<?php echo DOPTS_LABEL_BG_ALPHA?>",
            DOPTS_LABEL_TEXT_COLOR = "<?php echo DOPTS_LABEL_TEXT_COLOR?>",

            DOPTS_SLIDESHOW_SETTINGS = "<?php echo DOPTS_SLIDESHOW_SETTINGS?>",
            DOPTS_SLIDESHOW_ENABLED = "<?php echo DOPTS_SLIDESHOW_ENABLED?>",
            DOPTS_SLIDESHOW_TIME = "<?php echo DOPTS_SLIDESHOW_TIME?>",
            DOPTS_SLIDESHOW_LOOP = "<?php echo DOPTS_SLIDESHOW_LOOP?>",

            DOPTS_GO_TOP = "<?php echo DOPTS_GO_TOP?>",

            DOPTS_SCROLLER_NAME_INFO = "<?php echo DOPTS_SCROLLER_NAME_INFO?>",
            DOPTS_WIDTH_INFO = "<?php echo DOPTS_WIDTH_INFO?>",
            DOPTS_HEIGHT_INFO = "<?php echo DOPTS_HEIGHT_INFO?>",
            DOPTS_BG_COLOR_INFO = "<?php echo DOPTS_BG_COLOR_INFO?>",
            DOPTS_BG_ALPHA_INFO = "<?php echo DOPTS_BG_ALPHA_INFO?>",
            DOPTS_BG_BORDER_SIZE_INFO = "<?php echo DOPTS_BG_BORDER_SIZE_INFO?>",
            DOPTS_BG_BORDER_COLOR_INFO = "<?php echo DOPTS_BG_BORDER_COLOR_INFO?>",
            DOPTS_IMAGES_ORDER_INFO = "<?php echo DOPTS_IMAGES_ORDER_INFO?>",
            DOPTS_RESPONSIVE_ENABLED_INFO = "<?php echo DOPTS_RESPONSIVE_ENABLED_INFO?>",

            DOPTS_THUMBNAILS_POSITION_INFO = "<?php echo DOPTS_THUMBNAILS_POSITION_INFO?>",
            DOPTS_THUMBNAILS_BG_COLOR_INFO = "<?php echo DOPTS_THUMBNAILS_BG_COLOR_INFO?>",
            DOPTS_THUMBNAILS_BG_ALPHA_INFO = "<?php echo DOPTS_THUMBNAILS_BG_ALPHA_INFO?>",
            DOPTS_THUMBNAILS_BORDER_SIZE_INFO = "<?php echo DOPTS_THUMBNAILS_BORDER_SIZE_INFO?>",
            DOPTS_THUMBNAILS_BORDER_COLOR_INFO = "<?php echo DOPTS_THUMBNAILS_BORDER_COLOR_INFO?>",
            DOPTS_THUMBNAILS_SPACING_INFO = "<?php echo DOPTS_THUMBNAILS_SPACING_INFO?>",
            DOPTS_THUMBNAILS_MARGIN_TOP_INFO = "<?php echo DOPTS_THUMBNAILS_MARGIN_TOP_INFO?>",
            DOPTS_THUMBNAILS_MARGIN_RIGHT_INFO = "<?php echo DOPTS_THUMBNAILS_MARGIN_RIGHT_INFO?>",
            DOPTS_THUMBNAILS_MARGIN_BOTTOM_INFO = "<?php echo DOPTS_THUMBNAILS_MARGIN_BOTTOM_INFO?>",
            DOPTS_THUMBNAILS_MARGIN_LEFT_INFO = "<?php echo DOPTS_THUMBNAILS_MARGIN_LEFT_INFO?>",
            DOPTS_THUMBNAILS_PADDING_TOP_INFO = "<?php echo DOPTS_THUMBNAILS_PADDING_TOP_INFO?>",
            DOPTS_THUMBNAILS_PADDING_RIGHT_INFO = "<?php echo DOPTS_THUMBNAILS_PADDING_RIGHT_INFO?>",
            DOPTS_THUMBNAILS_PADDING_BOTTOM_INFO = "<?php echo DOPTS_THUMBNAILS_PADDING_BOTTOM_INFO?>",
            DOPTS_THUMBNAILS_PADDING_LEFT_INFO = "<?php echo DOPTS_THUMBNAILS_PADDING_LEFT_INFO?>",
            DOPTS_THUMBNAILS_INFO_INFO = "<?php echo DOPTS_THUMBNAILS_INFO_INFO?>",

            DOPTS_THUMBNAILS_NAVIGATION_EASING_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_EASING_INFO?>",
            DOPTS_THUMBNAILS_NAVIGATION_LOOP_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_LOOP_INFO?>",

            DOPTS_THUMBNAILS_NAVIGATION_MOUSE_ENABLED_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_MOUSE_ENABLED_INFO?>",

            DOPTS_THUMBNAILS_NAVIGATION_SCROLL_ENABLED_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_SCROLL_ENABLED_INFO?>",  
            DOPTS_THUMBNAILS_NAVIGATION_SCROLL_POSITION_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_SCROLL_POSITION_INFO?>",
            DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SIZE_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SIZE_INFO?>",
            DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SCRUB_COLOR_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SCRUB_COLOR_INFO?>",
            DOPTS_THUMBNAILS_NAVIGATION_SCROLL_BAR_COLOR_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_SCROLL_BAR_COLOR_INFO?>",

            DOPTS_THUMBNAILS_NAVIGATION_ARROWS_ENABLED_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_ARROWS_ENABLED_INFO?>",
            DOPTS_THUMBNAILS_NAVIGATION_ARROWS_NO_ITEMS_SLIDE_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_ARROWS_NO_ITEMS_SLIDE_INFO?>",
            DOPTS_THUMBNAILS_NAVIGATION_ARROWS_SPEED_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_ARROWS_SPEED_INFO?>",
            DOPTS_THUMBNAILS_NAVIGATION_PREV_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_PREV_INFO?>",
            DOPTS_THUMBNAILS_NAVIGATION_PREV_HOVER_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_PREV_HOVER_INFO?>",
            DOPTS_THUMBNAILS_NAVIGATION_PREV_DISABLED_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_PREV_DISABLED_INFO?>",
            DOPTS_THUMBNAILS_NAVIGATION_NEXT_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_NEXT_INFO?>",
            DOPTS_THUMBNAILS_NAVIGATION_NEXT_HOVER_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_NEXT_HOVER_INFO?>",
            DOPTS_THUMBNAILS_NAVIGATION_NEXT_DISABLED_INFO = "<?php echo DOPTS_THUMBNAILS_NAVIGATION_NEXT_DISABLED_INFO?>",

            DOPTS_THUMBNAIL_LOADER_INFO = "<?php echo DOPTS_THUMBNAIL_LOADER_INFO?>",
            DOPTS_THUMBNAIL_WIDTH_INFO = "<?php echo DOPTS_THUMBNAIL_WIDTH_INFO?>",
            DOPTS_THUMBNAIL_HEIGHT_INFO = "<?php echo DOPTS_THUMBNAIL_HEIGHT_INFO?>",
            DOPTS_THUMBNAIL_ALPHA_INFO = "<?php echo DOPTS_THUMBNAIL_ALPHA_INFO?>",
            DOPTS_THUMBNAIL_ALPHA_HOVER_INFO = "<?php echo DOPTS_THUMBNAIL_ALPHA_HOVER_INFO?>",
            DOPTS_THUMBNAIL_BG_COLOR_INFO = "<?php echo DOPTS_THUMBNAIL_BG_COLOR_INFO?>",
            DOPTS_THUMBNAIL_BG_COLOR_HOVER_INFO = "<?php echo DOPTS_THUMBNAIL_BG_COLOR_HOVER_INFO?>",
            DOPTS_THUMBNAIL_BORDER_SIZE_INFO = "<?php echo DOPTS_THUMBNAIL_BORDER_SIZE_INFO?>",
            DOPTS_THUMBNAIL_BORDER_COLOR_INFO = "<?php echo DOPTS_THUMBNAIL_BORDER_COLOR_INFO?>",
            DOPTS_THUMBNAIL_BORDER_COLOR_HOVER_INFO = "<?php echo DOPTS_THUMBNAIL_BORDER_COLOR_HOVER_INFO?>",
            DOPTS_THUMBNAIL_PADDING_TOP_INFO = "<?php echo DOPTS_THUMBNAIL_PADDING_TOP_INFO?>",
            DOPTS_THUMBNAIL_PADDING_RIGHT_INFO = "<?php echo DOPTS_THUMBNAIL_PADDING_RIGHT_INFO?>",
            DOPTS_THUMBNAIL_PADDING_BOTTOM_INFO = "<?php echo DOPTS_THUMBNAIL_PADDING_BOTTOM_INFO?>",
            DOPTS_THUMBNAIL_PADDING_LEFT_INFO = "<?php echo DOPTS_THUMBNAIL_PADDING_LEFT_INFO?>",

            DOPTS_LIGHTBOX_ENABLED_INFO = "<?php echo DOPTS_LIGHTBOX_ENABLED_INFO?>",   
            DOPTS_LIGHTBOX_DISPLAY_TIME_INFO = "<?php echo DOPTS_LIGHTBOX_DISPLAY_TIME_INFO?>",   
            DOPTS_LIGHTBOX_WINDOW_COLOR_INFO = "<?php echo DOPTS_LIGHTBOX_WINDOW_COLOR_INFO?>",   
            DOPTS_LIGHTBOX_WINDOW_ALPHA_INFO = "<?php echo DOPTS_LIGHTBOX_WINDOW_ALPHA_INFO?>",   
            DOPTS_LIGHTBOX_LOADER_INFO = "<?php echo DOPTS_LIGHTBOX_LOADER_INFO?>",   
            DOPTS_LIGHTBOX_BACKGROUND_COLOR_INFO = "<?php echo DOPTS_LIGHTBOX_BACKGROUND_COLOR_INFO?>",   
            DOPTS_LIGHTBOX_BACKGROUND_ALPHA_INFO = "<?php echo DOPTS_LIGHTBOX_BACKGROUND_ALPHA_INFO?>",  
            DOPTS_LIGHTBOX_BORDER_SIZE_INFO = "<?php echo DOPTS_LIGHTBOX_BORDER_SIZE_INFO?>", 
            DOPTS_LIGHTBOX_BORDER_COLOR_INFO = "<?php echo DOPTS_LIGHTBOX_BORDER_COLOR_INFO?>",  
            DOPTS_LIGHTBOX_CAPTION_TEXT_COLOR_INFO = "<?php echo DOPTS_LIGHTBOX_CAPTION_TEXT_COLOR_INFO?>",
            DOPTS_LIGHTBOX_MARGIN_TOP_INFO = "<?php echo DOPTS_LIGHTBOX_MARGIN_TOP_INFO?>",   
            DOPTS_LIGHTBOX_MARGIN_RIGHT_INFO = "<?php echo DOPTS_LIGHTBOX_MARGIN_RIGHT_INFO?>",   
            DOPTS_LIGHTBOX_MARGIN_BOTTOM_INFO = "<?php echo DOPTS_LIGHTBOX_MARGIN_BOTTOM_INFO?>",   
            DOPTS_LIGHTBOX_MARGIN_LEFT_INFO = "<?php echo DOPTS_LIGHTBOX_MARGIN_LEFT_INFO?>",   
            DOPTS_LIGHTBOX_PADDING_TOP_INFO = "<?php echo DOPTS_LIGHTBOX_PADDING_TOP_INFO?>",   
            DOPTS_LIGHTBOX_PADDING_RIGHT_INFO = "<?php echo DOPTS_LIGHTBOX_PADDING_RIGHT_INFO?>",  
            DOPTS_LIGHTBOX_PADDING_BOTTOM_INFO = "<?php echo DOPTS_LIGHTBOX_PADDING_BOTTOM_INFO?>",  
            DOPTS_LIGHTBOX_PADDING_LEFT_INFO = "<?php echo DOPTS_LIGHTBOX_PADDING_LEFT_INFO?>",  

            DOPTS_LIGHTBOX_NAVIGATION_PREV_INFO = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_PREV_INFO?>",   
            DOPTS_LIGHTBOX_NAVIGATION_PREV_HOVER_INFO = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_PREV_HOVER_INFO?>",   
            DOPTS_LIGHTBOX_NAVIGATION_NEXT_INFO = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_NEXT_INFO?>",   
            DOPTS_LIGHTBOX_NAVIGATION_NEXT_HOVER_INFO = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_NEXT_HOVER_INFO?>",   
            DOPTS_LIGHTBOX_NAVIGATION_CLOSE_INFO = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_CLOSE_INFO?>",  
            DOPTS_LIGHTBOX_NAVIGATION_CLOSE_HOVER_INFO = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_CLOSE_HOVER_INFO?>",   
            DOPTS_LIGHTBOX_NAVIGATION_INFO_BG_COLOR_INFO = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_INFO_BG_COLOR_INFO?>",
            DOPTS_LIGHTBOX_NAVIGATION_INFO_TEXT_COLOR_INFO = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_INFO_TEXT_COLOR_INFO?>",
            DOPTS_LIGHTBOX_NAVIGATION_DISPLAY_TIME_INFO = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_DISPLAY_TIME_INFO?>",
            DOPTS_LIGHTBOX_NAVIGATION_TOUCH_DEVICE_SWIPE_ENABLED_INFO = "<?php echo DOPTS_LIGHTBOX_NAVIGATION_TOUCH_DEVICE_SWIPE_ENABLED_INFO?>",

            DOPTS_TOOLTIP_BG_COLOR_INFO = "<?php echo DOPTS_TOOLTIP_BG_COLOR_INFO?>",
            DOPTS_TOOLTIP_STROKE_COLOR_INFO = "<?php echo DOPTS_TOOLTIP_STROKE_COLOR_INFO?>",
            DOPTS_TOOLTIP_TEXT_COLOR_INFO = "<?php echo DOPTS_TOOLTIP_TEXT_COLOR_INFO?>",

            DOPTS_LABEL_POSITION_INFO = "<?php echo DOPTS_LABEL_POSITION_INFO?>",
            DOPTS_LABEL_ALWAYS_VISIBLE_INFO = "<?php echo DOPTS_LABEL_ALWAYS_VISIBLE_INFO?>",
            DOPTS_LABEL_BG_COLOR_INFO = "<?php echo DOPTS_LABEL_BG_COLOR_INFO?>",
            DOPTS_LABEL_BG_ALPHA_INFO = "<?php echo DOPTS_LABEL_BG_ALPHA_INFO?>",
            DOPTS_LABEL_TEXT_COLOR_INFO = "<?php echo DOPTS_LABEL_TEXT_COLOR_INFO?>",

            DOPTS_SLIDESHOW_ENABLED_INFO = "<?php echo DOPTS_SLIDESHOW_ENABLED_INFO?>",
            DOPTS_SLIDESHOW_TIME_INFO = "<?php echo DOPTS_SLIDESHOW_TIME_INFO?>",
            DOPTS_SLIDESHOW_LOOP_INFO = "<?php echo DOPTS_SLIDESHOW_LOOP_INFO?>",
            
            DOPTS_help_info = [<?php             
                for ($i=0; $i<count($DOPTS_help_info); $i++){
                    echo '{"question": "'.preg_replace('`[\r\n]`', "", addslashes($DOPTS_help_info[$i]['question'])).'", "answer": "'.preg_replace('`[\r\n]`', "", addslashes($DOPTS_help_info[$i]['answer'])).'"},';
                }
            ?>];
        </script>
    </head>
    <body>  
        <div class="DOPTS-admin">
            <div class="header">
                <h1><?php echo DOPTS_TITLE?></h1>
                <div id="DOPTS-admin-message"></div>
                <a href="?sign_out=true" id="DOPTS-menu"><?php echo DOPTS_LOGOUT_SUBMIT?></a>
                <a href="javascript:doptsInitHelp()" id="DOPTS-menu"><?php echo DOPTS_TITLE_HELP?></a>
                <input type="hidden" name="scroller_id" id="scroller_id" value="" />
                <br class="DOPTS-clear" />
            </div>
            <div class="main">
                <div class="column column1">
                    <div class="column-header">
                        <div class="add-button">
                            <a href="javascript:doptsAddScroller()" title="<?php echo DOPTS_ADD_SCROLLER_SUBMIT?>"></a>
                        </div>
                        <div class="edit-button">
                            <a href="javascript:doptsShowScrollersInfo()" title="<?php echo DOPTS_EDIT_SCROLLERS_SUBMIT?>"></a>
                        </div>
                        <a href="javascript:void()" class="header-help" title="<?php echo DOPTS_SCROLLERS_HELP?>"></a>
                    </div>
                    <div class="column-content-container">
                        <div class="column-content">
                            &nbsp;
                        </div>
                    </div>
                </div>
                <div class="column-separator"></div>
                <div class="column column2">
                    <div class="column-header"></div>
                    <div class="column-content-container">
                        <div class="column-content">
                            &nbsp;
                        </div>
                    </div>
                </div>
                <div class="column-separator"></div>
                <div class="column column3">
                    <div class="column-header"></div>
                    <div class="column-content-container">
                        <div class="column-content">
                            &nbsp;
                        </div>
                    </div>
                </div>
            </div>
            <br class="DOPTS-clear" />
        </div>
    </body>
</html>