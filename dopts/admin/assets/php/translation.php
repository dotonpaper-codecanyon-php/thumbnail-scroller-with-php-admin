<?php

/*
* Title                   : Thumbnail Scroller (with PHP Admin)
* Version                 : 1.1
* File                    : translation.php
* File Version            : 1.0
* Created / Last Modified : 10 December 2012
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Admin translation.
*/
    
    if (!isset($DOPTS_load_scripts)){
        exit('<h2 style="color:#aaaaaa; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;">Warning! No direct script access allowed.</h2>');
    }

    define('DOPTS_TITLE', "Thumbnail Scroller");
    
    // Sign In
    define('DOPTS_LOGIN_USERNAME', 'Username');
    define('DOPTS_LOGIN_PASSWORD', 'Password');
    define('DOPTS_LOGIN_SUBMIT', 'Sign In');
    
    define('DOPTS_LOGIN_INFO', 'Enter your user and password to login.');
    define('DOPTS_LOGIN_SUCCESS', 'Success! Your user and password are valid.');
    define('DOPTS_LOGIN_ERROR', 'Error! Your user or password are invalid.');
    define('DOPTS_LOGIN_PROCESSING', 'Processing ...');
    
    // Sign Out
    define('DOPTS_LOGOUT_SUBMIT', 'Sign Out');
    
    // Loading ...
    define('DOPTS_LOAD', "Load data ...");
    define('DOPTS_SCROLLERS_LOADED', "Scrollers list loaded.");
    define('DOPTS_IMAGES_LOADED', "Images list loaded.");
    define('DOPTS_NO_SCROLLERS', "No scrollers.");
    define('DOPTS_NO_IMAGES', "No thumbnails.");
    define('DOPTS_SCROLLER_LOADED', "Scroller data loaded.");
    define('DOPTS_IMAGE_LOADED', "Image loaded.");

    // Save ...
    define('DOPTS_SAVE', "Save data ...");
    define('DOPTS_SELECT_FILE', "Select File");

    // Help
    define('DOPTS_SCROLLERS_HELP', "Click on the 'plus' icon to add a scroller. Click on a scroller item to open the editing area. Click on the 'pencil' icon to edit scrollers default settings.");
    define('DOPTS_SCROLLERS_EDIT_INFO_HELP', "Click 'Submit Button' to save changes.");
    define('DOPTS_SCROLLER_EDIT_HELP', "Click on the 'plus' icon to add images. Click on an image to open the editing area. You can drag images to sort them. Click on the 'pencil' icon to edit scroller settings.");
    define('DOPTS_SCROLLER_EDIT_INFO_HELP', "Click 'Submit Button' to save changes. Images are saved automaticaly. Click 'Delete Button' to delete the scroller. Click 'Use Default Settings' to use the default settings; the current settings will be deleted.");
    define('DOPTS_ADD_IMAGES_HELP', "You have 3 upload types (AJAX, Uploadify, FTP). At least one should work.");
    define('DOPTS_ADD_IMAGES_HELP_WP', "You can use the default WordPress Uploader. To add an image to the scroller select it from WordPress and press Insert into Post.");
    define('DOPTS_ADD_IMAGES_HELP_AJAX', "Just a simple AJAX upload. Just select an image and the upload will start automatically.");
    define('DOPTS_ADD_IMAGES_HELP_UPLOADIFY', "You can use this option if you want to upload a single or multiple images to your scroller. Just select the images and the upload will start automatically. Uploadify will not display the progress bar and image processing will go slower if you have a firewall enabled.");
    define('DOPTS_ADD_IMAGES_HELP_FTP', "Copy all the images in ftp-uploads in Thumbnail Scroller plugin folder. Press Add Images to add the content of the folder to your scroller. This will take some time depending on the number and size of the images. On some servers the images' names that contain other characters different from alphanumeric ones will not be uploaded. Change the names for them to work.");
    define('DOPTS_IMAGE_EDIT_HELP', "Drag the mouse over the big image to select a new thumbnail. Click 'Submit Button' to save the thumbnail, title, media, lightbox media, link, link target or enable/disable the image. Click 'Delete Button' to delete the image.");

    // Form
    define('DOPTS_SUBMIT', "Submit");
    define('DOPTS_DELETE', "Delete");
    define('DOPTS_DEFAULT', "Use Default Settings");

    // Add Scroller
    define('DOPTS_ADD_SCROLLER_NAME', "New Scroller");
    define('DOPTS_ADD_SCROLLER_SUBMIT', "Add Scroller");
    define('DOPTS_ADD_SCROLLER_SUBMITED', "Adding scroller ...");
    define('DOPTS_ADD_SCROLLER_SUCCESS', "You have succesfully added a new scroller.");

    // Edit Scrollers
    define('DOPTS_EDIT_SCROLLERS_SUBMIT', "Edit Scrollers Default Settings");
    define('DOPTS_EDIT_SCROLLERS_SUCCESS', "You have succesfully edited the default settings.");

    // Edit Scroller
    define('DOPTS_EDIT_SCROLLER_SUBMIT', "Edit Scroller");
    define('DOPTS_EDIT_SCROLLER_SUCCESS', "You have succesfully edited the scroller.");
    define('DOPTS_EDIT_SCROLLER_USE_DEFAULT_CONFIRMATION', "Are you sure you want to use the default settings. Current settings are going to be deleted?");
    
    // Generate Scroller Code
    define('DOPTS_EDIT_SCROLLER_CODE', "Generate HTML Code");
    define('DOPTS_EDIT_SCROLLER_CODE_HELP', "Select the files you want included, generate the code and copy it into your page.");
    define('DOPTS_EDIT_SCROLLER_CODE_INCLUDE_JQUERY', "Include jQuery file (uncheck if already used)."); 
    define('DOPTS_EDIT_SCROLLER_CODE_INCLUDE_JQUERY_UI', "Include jQuery UI file (uncheck if already used).");
    define('DOPTS_EDIT_SCROLLER_CODE_INCLUDE_SCROLLER', "Include Scroller files (uncheck if already used).");
    define('DOPTG_EDIT_SCROLLER_CODE_SCROLLER_EMBED', "Embed the code on other websites (check it if you what to use the scroller on another domain than the one you have the admin area).");
    define('DOPTS_EDIT_SCROLLER_CODE_COPY', "Copy the code below into your page.");
    define('DOPTS_EDIT_SCROLLER_CODE_LINK', "A link to your scroller (preview).");

    // Delete Scroller
    define('DOPTS_DELETE_SCROLLER_CONFIRMATION', "Are you sure you want to delete this scroller?");
    define('DOPTS_DELETE_SCROLLER_SUBMIT', "Delete Scroller");
    define('DOPTS_DELETE_SCROLLER_SUBMITED', "Deleting scroller ...");
    define('DOPTS_DELETE_SCROLLER_SUCCESS', "You have succesfully deleted the scroller.");

    // Add Image
    define('DOPTS_ADD_IMAGE_SUBMIT', "Add Images");
    define('DOPTS_ADD_IMAGE_WP_UPLOAD', "Default WordPress file upload");
    define('DOPTS_ADD_IMAGE_SIMPLE_UPLOAD', "Simple AJAX file upload");
    define('DOPTS_ADD_IMAGE_MULTIPLE_UPLOAD', "Multiple files upload (Uploadify jQuery Plugin)");
    define('DOPTS_ADD_IMAGE_FTP_UPLOAD', "FTP file upload");
    define('DOPTS_ADD_IMAGE_SUBMITED', "Adding images ...");
    define('DOPTS_ADD_IMAGE_SUCCESS', "You have succesfully added a new image.");
    define('DOPTS_SELECT_IMAGES', "Select Images");
    define('DOPTS_SELECT_FTP_IMAGES', "Add Images");

    // Sort Image
    define('DOPTS_SORT_IMAGES_SUBMITED', "Sorting images ...");
    define('DOPTS_SORT_IMAGES_SUCCESS', "You have succesfully sorted the images.");

    // Edit Image
    define('DOPTS_EDIT_IMAGE_SUBMIT', "Edit Image");
    define('DOPTS_EDIT_IMAGE_SUCCESS', "You have succesfully edited the image.");
    define('DOPTS_EDIT_IMAGE_CROP_THUMBNAIL', "Crop Thumbnail");
    define('DOPTS_EDIT_IMAGE_CURRENT_THUMBNAIL', "Current Thumbnail");
    define('DOPTS_EDIT_IMAGE_TITLE', "Title");
    define('DOPTS_EDIT_IMAGE_CAPTION', "Caption");
    define('DOPTS_EDIT_IMAGE_MEDIA', "Media: Add HTML, Flash, ...<br />IMPORTANT: Make sure that all the code is in one html tag. Iframe embedding code will work :).");
    define('DOPTS_EDIT_IMAGE_LIGHTBOX_MEDIA', "Lightbox Media: Add HTML, Flash, ... in the lightbox.<br />IMPORTANT: Make sure that all the code is in one html tag. Iframe embedding code will work :).");
    define('DOPTS_EDIT_IMAGE_LINK', "Link ... if you add <strong>none</strong> the thumbnail will have no event");
    define('DOPTS_EDIT_IMAGE_LINK_TARGET', "Link Target");
    define('DOPTS_EDIT_IMAGE_ENABLED', "Enabled");

    // Delete Image
    define('DOPTS_DELETE_IMAGE_CONFIRMATION', "Are you sure you want to delete this image?");
    define('DOPTS_DELETE_IMAGE_SUBMIT', "Delete Image");
    define('DOPTS_DELETE_IMAGE_SUBMITED', "Deleting image ...");
    define('DOPTS_DELETE_IMAGE_SUCCESS', "You have succesfully deleted the image.");

    // TinyMCE
    define('DOPTS_TINYMCE_ADD', 'Add Thumbnail Scroller');
    
    // Settings
    define('DOPTS_GENERAL_STYLES_SETTINGS', "General Styles & Settings");
    define('DOPTS_SCROLLER_NAME', "Name");
    define('DOPTS_WIDTH', "Width");
    define('DOPTS_HEIGHT', "Height");
    define('DOPTS_BG_COLOR', "Background Color");
    define('DOPTS_BG_ALPHA', "Background Alpha");
    define('DOPTS_BG_BORDER_SIZE', "Background Border Size");
    define('DOPTS_BG_BORDER_COLOR', "Background Border Color");
    define('DOPTS_IMAGES_ORDER', "Thumbnails Order");
    define('DOPTS_RESPONSIVE_ENABLED', "Responsive Enabled");   
    
    define('DOPTS_THUMBNAILS_STYLES_SETTINGS', "Thumbnails Styles & Settings");
    define('DOPTS_THUMBNAILS_POSITION', "Thumbnails Position");
    define('DOPTS_THUMBNAILS_BG_COLOR', "Thumbnails Background Color");
    define('DOPTS_THUMBNAILS_BG_ALPHA', "Thumbnails Background Alpha");
    define('DOPTS_THUMBNAILS_BORDER_SIZE', "Thumbnails Background Border Size");
    define('DOPTS_THUMBNAILS_BORDER_COLOR', "Thumbnails Background Border Color");
    define('DOPTS_THUMBNAILS_SPACING', "Thumbnails Spacing");
    define('DOPTS_THUMBNAILS_MARGIN_TOP', "Thumbnails Margin Top");
    define('DOPTS_THUMBNAILS_MARGIN_RIGHT', "Thumbnails Margin Right");
    define('DOPTS_THUMBNAILS_MARGIN_BOTTOM', "Thumbnails Margin Bottom");
    define('DOPTS_THUMBNAILS_MARGIN_LEFT', "Thumbnails Margin Left"); 
    define('DOPTS_THUMBNAILS_PADDING_TOP', "Thumbnails Padding Top");
    define('DOPTS_THUMBNAILS_PADDING_RIGHT', "Thumbnails Padding Right");
    define('DOPTS_THUMBNAILS_PADDING_BOTTOM', "Thumbnails Padding Bottom");
    define('DOPTS_THUMBNAILS_PADDING_LEFT', "Thumbnails Padding Left");    
    define('DOPTS_THUMBNAILS_INFO', "Info Thumbnails Display");
            
    define('DOPTS_THUMBNAILS_NAVIGATION_STYLES_SETTINGS', "Thumbnails Navigation Styles & Settings");
    define('DOPTS_THUMBNAILS_NAVIGATION_EASING', "Thumbnails Navigation Easing");
    define('DOPTS_THUMBNAILS_NAVIGATION_LOOP', "Enable Thumbnails Loop");
    
    define('DOPTS_THUMBNAILS_NAVIGATION_MOUSE_ENABLED', "Enable Thumbnails Mouse Navigation");
    
    define('DOPTS_THUMBNAILS_NAVIGATION_SCROLL_ENABLED', "Enable Thumbnails Scroll Navigation");            
    define('DOPTS_THUMBNAILS_NAVIGATION_SCROLL_POSITION', "Thumbnails Scroll Position");          
    define('DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SIZE', "Thumbnails Scroll Size");                   
    define('DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SCRUB_COLOR', "Thumbnails Scroll Scrub Color");            
    define('DOPTS_THUMBNAILS_NAVIGATION_SCROLL_BAR_COLOR', "EThumbnails Scroll Bar Color");          
                
    define('DOPTS_THUMBNAILS_NAVIGATION_ARROWS_ENABLED', "Enable Thumbnails Arrows Navigation");
    define('DOPTS_THUMBNAILS_NAVIGATION_ARROWS_NO_ITEMS_SLIDE', "Thumbnails Navigation Arrows Number Items Slide");
    define('DOPTS_THUMBNAILS_NAVIGATION_ARROWS_SPEED', "Thumbnails Navigation Arrows Speed");
    define('DOPTS_THUMBNAILS_NAVIGATION_PREV', "Thumbnails Navigation Previous Button Image");
    define('DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_SUBMITED', "Uploading previous button image ...");
    define('DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_SUCCESS', "Previous button image uploaded.");
    define('DOPTS_THUMBNAILS_NAVIGATION_PREV_HOVER', "Thumbnails Navigation Previous Button Hover Image");
    define('DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_HOVER_SUBMITED', "Uploading previous button hover image ...");
    define('DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_HOVER_SUCCESS', "Previous button hover image uploaded.");
    define('DOPTS_THUMBNAILS_NAVIGATION_PREV_DISABLED', "Thumbnails Navigation Previous Button Disabled Image");
    define('DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_DISABLED_SUBMITED', "Uploading previous button disabled image ...");
    define('DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_DISABLED_SUCCESS', "Previous button disabled image uploaded.");
    define('DOPTS_THUMBNAILS_NAVIGATION_NEXT', "Thumbnails Navigation Next Button Image");
    define('DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_SUBMITED', "Uploading next button image ...");
    define('DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_SUCCESS', "Next button image uploaded.");
    define('DOPTS_THUMBNAILS_NAVIGATION_NEXT_HOVER', "Thumbnails Navigation Next Button Hover Image");
    define('DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_HOVER_SUBMITED', "Uploading next button hover image ...");
    define('DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_HOVER_SUCCESS', "Next button hover image uploaded.");
    define('DOPTS_THUMBNAILS_NAVIGATION_NEXT_DISABLED', "Thumbnails Navigation Next Button Disabled Image");
    define('DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_DISABLED_SUBMITED', "Uploading next button disabled image ...");
    define('DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_DISABLED_SUCCESS', "Next button disabled image uploaded.");
    
    define('DOPTS_THUMBNAIL_STYLES_SETTINGS', "Styles & Settings for a Thumbnail");
    define('DOPTS_THUMBNAIL_LOADER', "Thumbnail Loader");
    define('DOPTS_ADD_THUMBNAIL_LOADER_SUBMITED', "Adding thumbnail loader...");
    define('DOPTS_ADD_THUMBNAIL_LOADER_SUCCESS', "Thumbnail loader added.");
    define('DOPTS_THUMBNAIL_WIDTH', "Thumbnail Width");
    define('DOPTS_THUMBNAIL_HEIGHT', "Thumbnail Height");
    define('DOPTS_THUMBNAIL_ALPHA', "Thumbnail Alpha");
    define('DOPTS_THUMBNAIL_ALPHA_HOVER', "Thumbnail Alpha Hover");
    define('DOPTS_THUMBNAIL_BG_COLOR', "Thumbnail Background Color");
    define('DOPTS_THUMBNAIL_BG_COLOR_HOVER', "Thumbnail Background Color Hover");
    define('DOPTS_THUMBNAIL_BORDER_SIZE', "Thumbnail Border Size");
    define('DOPTS_THUMBNAIL_BORDER_COLOR', "Thumbnail Border Color");
    define('DOPTS_THUMBNAIL_BORDER_COLOR_HOVER', "Thumbnail Border Color Hover");
    define('DOPTS_THUMBNAIL_PADDING_TOP', "Thumbnail Padding Top");
    define('DOPTS_THUMBNAIL_PADDING_RIGHT', "Thumbnail Padding Right");
    define('DOPTS_THUMBNAIL_PADDING_BOTTOM', "Thumbnail Padding Bottom");
    define('DOPTS_THUMBNAIL_PADDING_LEFT', "Thumbnail Padding Left");
    
    define('DOPTS_LIGHTBOX_STYLES_SETTINGS', "Lightbox Styles & Settings");
    define('DOPTS_LIGHTBOX_ENABLED', "Lightbox Enabled");
    define('DOPTS_LIGHTBOX_DISPLAY_TIME', "Lightbox Display Time");
    define('DOPTS_LIGHTBOX_WINDOW_COLOR', "Lightbox Window Color");
    define('DOPTS_LIGHTBOX_WINDOW_ALPHA', "Lightbox Window Alpha");
    define('DOPTS_LIGHTBOX_LOADER', "Lightbox Loader");
    define('DOPTS_ADD_LIGHTBOX_LOADER_SUBMITED', "Adding lightbox loader...");
    define('DOPTS_ADD_LIGHTBOX_LOADER_SUCCESS', "Lightbox loader added.");
    define('DOPTS_LIGHTBOX_BACKGROUND_COLOR', "Lightbox Background Color");
    define('DOPTS_LIGHTBOX_BACKGROUND_ALPHA', "Lightbox Background Alpha");    
    define('DOPTS_LIGHTBOX_BORDER_SIZE', "Lightbox Border Size");
    define('DOPTS_LIGHTBOX_BORDER_COLOR', "Lightbox Border Color");    
    define('DOPTS_LIGHTBOX_CAPTION_TEXT_COLOR', "Lightbox Caption Text Color");
    define('DOPTS_LIGHTBOX_MARGIN_TOP', "Lightbox Margin Top");
    define('DOPTS_LIGHTBOX_MARGIN_RIGHT', "Lightbox Margin Right");
    define('DOPTS_LIGHTBOX_MARGIN_BOTTOM', "Lightbox Margin Bottom");
    define('DOPTS_LIGHTBOX_MARGIN_LEFT', "Lightbox Margin Left");
    define('DOPTS_LIGHTBOX_PADDING_TOP', "Lightbox Padding Top");
    define('DOPTS_LIGHTBOX_PADDING_RIGHT', "Lightbox Padding Right");
    define('DOPTS_LIGHTBOX_PADDING_BOTTOM', "Lightbox Padding Bottom");
    define('DOPTS_LIGHTBOX_PADDING_LEFT', "Lightbox Padding Left");
    
    define('DOPTS_LIGHTBOX_NAVIGATION_STYLES_SETTINGS', "Lightbox Navigation Styles & Settings");
    define('DOPTS_LIGHTBOX_NAVIGATION_PREV', "Lightbox Navigation Previous Button Image");
    define('DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_SUBMITED', "Uploading previous button image ...");
    define('DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_SUCCESS', "Previous button image uploaded.");
    define('DOPTS_LIGHTBOX_NAVIGATION_PREV_HOVER', "Lightbox Navigation Previous Button Hover Image");
    define('DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_HOVER_SUBMITED', "Uploading previous button hover image ...");
    define('DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_HOVER_SUCCESS', "Previous button hover image uploaded.");
    define('DOPTS_LIGHTBOX_NAVIGATION_NEXT', "Lightbox Navigation Next Button Image");
    define('DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_SUBMITED', "Uploading next button image ...");
    define('DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_SUCCESS', "Next button image uploaded.");
    define('DOPTS_LIGHTBOX_NAVIGATION_NEXT_HOVER', "Lightbox Navigation Next Button Hover Image");
    define('DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_HOVER_SUBMITED', "Uploading next button hover image ...");
    define('DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_HOVER_SUCCESS', "Next button hover image uploaded.");
    define('DOPTS_LIGHTBOX_NAVIGATION_CLOSE', "Lightbox Navigation Close Button Image");
    define('DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_SUBMITED', "Uploading close button image ...");
    define('DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_SUCCESS', "Close button image uploaded.");
    define('DOPTS_LIGHTBOX_NAVIGATION_CLOSE_HOVER', "Lightbox Navigation Close Button Hover Image");
    define('DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_HOVER_SUBMITED', "Uploading close button hover image ...");
    define('DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_HOVER_SUCCESS', "Close button hover image uploaded.");
    define('DOPTS_LIGHTBOX_NAVIGATION_INFO_BG_COLOR', "Lightbox Navigation Info Background Color");
    define('DOPTS_LIGHTBOX_NAVIGATION_INFO_TEXT_COLOR', "Lightbox Navigation Info Text Color");
    define('DOPTS_LIGHTBOX_NAVIGATION_DISPLAY_TIME', "Lightbox Navigation Display Time");
    define('DOPTS_LIGHTBOX_NAVIGATION_TOUCH_DEVICE_SWIPE_ENABLED', "Swipe Lightbox Navigation Enabled");
    
    define('DOPTS_TOOLTIP_STYLES_SETTINGS', "Tooltip Styles & Settings");
    define('DOPTS_TOOLTIP_BG_COLOR', "Tooltip Background Color");
    define('DOPTS_TOOLTIP_STROKE_COLOR', "Tooltip Stroke Color");
    define('DOPTS_TOOLTIP_TEXT_COLOR', "Tooltip Text Color");
    
    define('DOPTS_LABEL_STYLES_SETTINGS', "Label Styles & Settings");
    define('DOPTS_LABEL_POSITION', "Label Position");
    define('DOPTS_LABEL_ALWAYS_VISIBLE', "Label Always Visible");
    define('DOPTS_LABEL_BG_COLOR', "Label Background Color");
    define('DOPTS_LABEL_BG_ALPHA', "Label Background Alpha");
    define('DOPTS_LABEL_TEXT_COLOR', "Label Text Color");    
    
    define('DOPTS_SLIDESHOW_SETTINGS', "Slideshow Settings");
    define('DOPTS_SLIDESHOW_ENABLED', "Slideshow Enabled");
    define('DOPTS_SLIDESHOW_TIME', "Slideshow Time");
    define('DOPTS_SLIDESHOW_LOOP', "Slideshow Loop");
    
    define('DOPTS_GO_TOP', "go top");

    define('DOPTS_SCROLLER_NAME_INFO', "Change scroller name.");
    define('DOPTS_WIDTH_INFO', "Width (value in pixels). Default value: 900. Set the width of the scroller.");
    define('DOPTS_HEIGHT_INFO', "Height (value in pixels). Default value: 128. Set the height of the scroller.");
    define('DOPTS_BG_COLOR_INFO', "Background Color (color hex code). Default value: ffffff. Set scroller background color.");
    define('DOPTS_BG_ALPHA_INFO', "Background Alpha (value from 0 to 100). Default value: 100. Set scroller alpha.");
    define('DOPTS_BG_BORDER_SIZE_INFO', "Background Border Size (value in pixels). Default value: 1. Set the size of the scroller border.");
    define('DOPTS_BG_BORDER_COLOR_INFO', "Background Border Color (color hex code). Default value: e0e0e0. Set the color of the scroller border.");
    define('DOPTS_IMAGES_ORDER_INFO', "Thumbnails Order (normal, random). Default value: normal. Set thumbnails order.");
    define('DOPTS_RESPONSIVE_ENABLED_INFO', "Responsive Enabled (true, false). Default value: true. Enable responsive layout.");
    
    define('DOPTS_THUMBNAILS_POSITION_INFO', "Thumbnails Position (horizontal, vertical). Default value: horizontal. Set the position of the thumbnails.");
    define('DOPTS_THUMBNAILS_BG_COLOR_INFO', "Thumbnails Background Color (color hex code). Default value: ffffff. Set the color for the thumbnails background.");
    define('DOPTS_THUMBNAILS_BG_ALPHA_INFO', "Thumbnails Background Alpha (value from 0 to 100). Default value: 0. Set the transparancy for the thumbnails background.");
    define('DOPTS_THUMBNAILS_BORDER_SIZE_INFO', "Thumbnails Background Border Size (value in pixels). Default value: 0. Set the size of the thumbnails border.");
    define('DOPTS_THUMBNAILS_BORDER_COLOR_INFO', "Thumbnails Background Border Color (color hex code). Default value: e0e0e0. Set the color of the thumbnails border.");    
    define('DOPTS_THUMBNAILS_SPACING_INFO', "Thumbnails Spacing (value in pixels). Default value: 10. Set the space between thumbnails.");
    define('DOPTS_THUMBNAILS_MARGIN_TOP_INFO', "Thumbnails Margin Top (value in pixels). Default value: 10. Set the top margin for the thumbnails.");
    define('DOPTS_THUMBNAILS_MARGIN_RIGHT_INFO', "Thumbnails Margin Right (value in pixels). Default value: 0. Set the right margin for the thumbnails.");
    define('DOPTS_THUMBNAILS_MARGIN_BOTTOM_INFO', "Thumbnails Margin Bottom (value in pixels). Default value: 10. Set the bottom margin for the thumbnails.");
    define('DOPTS_THUMBNAILS_MARGIN_LEFT_INFO', "Thumbnails Margin Left (value in pixels). Default value: 0. Set the left margin for the thumbnails.");
    define('DOPTS_THUMBNAILS_PADDING_TOP_INFO', "Thumbnails Padding Top (value in pixels). Default value: 0. Set the top padding for the thumbnails.");
    define('DOPTS_THUMBNAILS_PADDING_RIGHT_INFO', "Thumbnails Padding Right (value in pixels). Default value: 0. Set the right padding for the thumbnails.");
    define('DOPTS_THUMBNAILS_PADDING_BOTTOM_INFO', "Thumbnails Padding Bottom (value in pixels). Default value: 0. Set the bottom padding for the thumbnails.");
    define('DOPTS_THUMBNAILS_PADDING_LEFT_INFO', "Thumbnails Padding Left (value in pixels). Default value: 0. Set the left padding for the thumbnails.");
    define('DOPTS_THUMBNAILS_INFO_INFO', "Info Thumbnails Display (none, tooltip, label). Default value: label. Display a small info text on the thumbnails, a tooltip or a label.");
    
    define('DOPTS_THUMBNAILS_NAVIGATION_EASING_INFO', "Thumbnails Navigation Easing (linear, swing, easeInQuad, easeOutQuad, easeInOutQuad, easeInCubic, easeOutCubic, easeInOutCubic, easeInQuart, easeOutQuart, easeInOutQuart, easeInQuint, easeOutQuint, easeInOutQuint, easeInSine, easeOutSine, easeInOutSine, easeInExpo, easeOutExpo, easeInOutExpo, easeInCirc, easeOutCirc, easeInOutCirc, easeInElastic, easeOutElastic, easeInOutElastic, easeInBack, easeOutBack, easeInOutBack, easeInBounce, easeOutBounce, easeInOutBounce). Default value: linear. Set thumbnails navigation easing.");
    define('DOPTS_THUMBNAILS_NAVIGATION_LOOP_INFO', "Enable Thumbnails Loop (true, false). Default value: false. Enable thumbnails loop ... scroll will be disabled.");
    
    define('DOPTS_THUMBNAILS_NAVIGATION_MOUSE_ENABLED_INFO', "Enable Thumbnails Mouse Navigation (true, false). Default value: false. Enable thumbnails mouse navigation.");
    
    define('DOPTS_THUMBNAILS_NAVIGATION_SCROLL_ENABLED_INFO', "Enable Thumbnails Scroll Navigation (true, false). Default value: false. Enable thumbnails scroll navigation.");
    define('DOPTS_THUMBNAILS_NAVIGATION_SCROLL_POSITION_INFO', "Thumbnails Scroll Position (bottom/right, top/left). Default value: bottom/right. Set thumbnails scroll position.");  
    define('DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SIZE_INFO', "Thumbnails Scroll Size (value in pixels). Default value: 5. Set the scroll size color.");  
    define('DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SCRUB_COLOR_INFO', "Thumbnails Scroll Scrub Color (color hex code). Default value: 808080. Set the scroll scrub color.");
    define('DOPTS_THUMBNAILS_NAVIGATION_SCROLL_BAR_COLOR_INFO', "Thumbnails Scroll Bar Color (color hex code). Default value: e0e0e0. Set the scroll bar color.");
                                            
    define('DOPTS_THUMBNAILS_NAVIGATION_ARROWS_ENABLED_INFO', "Enable Thumbnails Arrows Navigation (true, false). Default value: true. Enable thumbnails arrows navigation.");
    define('DOPTS_THUMBNAILS_NAVIGATION_ARROWS_NO_ITEMS_SLIDE_INFO', "Thumbnails Navigation Arrows Number Items Slide (number of thumbnails). Default value: 1. The number of thumbnails that will slide when you click the arrows.");
    define('DOPTS_THUMBNAILS_NAVIGATION_ARROWS_SPEED_INFO', "Thumbnails Navigation Arrows Speed (time in miliseconds). Default value: 600. The time the thumbnails will slide after you click the arrows.");
    define('DOPTS_THUMBNAILS_NAVIGATION_PREV_INFO', "Thumbnails Navigation Previous Button Image (path to image). Upload the image for thumbnails navigation's previous button.");
    define('DOPTS_THUMBNAILS_NAVIGATION_PREV_HOVER_INFO', "Thumbnails Navigation Previous Button Hover Image (path to image). Upload the image for thumbnails navigation's previous hover button.");
    define('DOPTS_THUMBNAILS_NAVIGATION_PREV_DISABLED_INFO', "Thumbnails Navigation Previous Button Disabled Image (path to image). Upload the image for thumbnails navigation's previous disabled button.");
    define('DOPTS_THUMBNAILS_NAVIGATION_NEXT_INFO', "Thumbnails Navigation Next Button Image (path to image). Upload the image for thumbnails navigation's next button.");
    define('DOPTS_THUMBNAILS_NAVIGATION_NEXT_HOVER_INFO', "Thumbnails Navigation Next Button Hover Image (path to image). Upload the image for thumbnails navigation's next hover button.");
    define('DOPTS_THUMBNAILS_NAVIGATION_NEXT_DISABLED_INFO', "Thumbnails Navigation Next Button Disabled Image (path to image). Upload the image for thumbnails navigation's next disabled button.");
                                                
    define('DOPTS_THUMBNAIL_LOADER_INFO', "Thumbnail Loader (path to image). Set the loader for the thumbnails.");
    define('DOPTS_THUMBNAIL_WIDTH_INFO', "Thumbnail Width (the size in pixels). Default value: 100. Set the width of a thumbnail.");
    define('DOPTS_THUMBNAIL_HEIGHT_INFO', "Thumbnail Height (the size in pixels). Default value: 100. Set the height of a thumbnail.");
    define('DOPTS_THUMBNAIL_ALPHA_INFO', "Thumbnail Alpha (value from 0 to 100). Default value: 100. Set the transparancy of a thumbnail.");
    define('DOPTS_THUMBNAIL_ALPHA_HOVER_INFO', "Thumbnail Alpha Hover (value from 0 to 100). Default value: 100. Set the transparancy of a thumbnail when hover.");
    define('DOPTS_THUMBNAIL_BG_COLOR_INFO', "Thumbnail Background Color (color hex code). Default value: f1f1f1. Set the color of a thumbnail's background.");
    define('DOPTS_THUMBNAIL_BG_COLOR_HOVER_INFO', "Thumbnail Background Color Hover (color hex code). Default value: f1f1f1. Set the color of a thumbnail's background when hover.");
    define('DOPTS_THUMBNAIL_BORDER_SIZE_INFO', "Thumbnail Border Size (value in pixels). Default value: 1. Set the size of a thumbnail's border.");
    define('DOPTS_THUMBNAIL_BORDER_COLOR_INFO', "Thumbnail Border Color (color hex code). Default value: d0d0d0. Set the color of a thumbnail's border.");
    define('DOPTS_THUMBNAIL_BORDER_COLOR_HOVER_INFO', "Thumbnail Border Color Hover (color hex code). Default value: 303030. Set the color of a thumbnail's border when hover.");
    define('DOPTS_THUMBNAIL_PADDING_TOP_INFO', "Thumbnail Padding Top (value in pixels). Default value: 2. Set top padding value of a thumbnail.");
    define('DOPTS_THUMBNAIL_PADDING_RIGHT_INFO', "Thumbnail Padding Right (value in pixels). Default value: 2. Set right padding value of a thumbnail.");
    define('DOPTS_THUMBNAIL_PADDING_BOTTOM_INFO', "Thumbnail Padding Bottom (value in pixels). Default value: 2. Set bottom padding value of a thumbnail.");
    define('DOPTS_THUMBNAIL_PADDING_LEFT_INFO', "Thumbnail Padding Left (value in pixels). Default value: 2. Set left padding value of a thumbnail.");

    define('DOPTS_LIGHTBOX_ENABLED_INFO', "Enable Lightbox (true, false). Default value: true. Enable the lightbox.");
    define('DOPTS_LIGHTBOX_DISPLAY_TIME_INFO', "Lightbox Display Time (time in miliseconds). Default value: 600. The time the lightbox will be displayed.");
    define('DOPTS_LIGHTBOX_WINDOW_COLOR_INFO', "Lightbox Window Color (color hex code). Default value: ffffff. Set the color for the lightbox window.");
    define('DOPTS_LIGHTBOX_WINDOW_ALPHA_INFO', "Lightbox Window Alpha (value from 0 to 100). Default value: 80. Set the transparancy for the lightbox window.");
    define('DOPTS_LIGHTBOX_LOADER_INFO', "Lightbox Loader (path to image). Set the loader for the lightbox image.");
    define('DOPTS_LIGHTBOX_BACKGROUND_COLOR_INFO', "Lightbox Background Color (color hex code). Default value: ffffff. Set the color for the lightbox background.");
    define('DOPTS_LIGHTBOX_BACKGROUND_ALPHA_INFO', "Lightbox Background Alpha (value from 0 to 100). Default value: 100. Set the transparancy for the lightbox background.");
    define('DOPTS_LIGHTBOX_BORDER_SIZE_INFO', "Lightbox Border Size (value in pixels). Default value: 1. Set the size of a lightbox's border.");
    define('DOPTS_LIGHTBOX_BORDER_COLOR_INFO', "Lightbox Border Color (color hex code). Default value: e0e0e0. Set the color of a lightbox's border.");
    define('DOPTS_LIGHTBOX_CAPTION_TEXT_COLOR_INFO', "Lightbox Caption Text Color (color hex code). Default value: 999999. Set the color for the lightbox caption.");
    define('DOPTS_LIGHTBOX_MARGIN_TOP_INFO', "Lightbox Margin Top (value in pixels). Default value: 30. Set top margin value for the lightbox.");
    define('DOPTS_LIGHTBOX_MARGIN_RIGHT_INFO', "Lightbox Margin Right (value in pixels). Default value: 30. Set right margin value for the lightbox.");
    define('DOPTS_LIGHTBOX_MARGIN_BOTTOM_INFO', "Lightbox Margin Bottom (value in pixels). Default value: 30. Set bottom margin value for the lightbox.");
    define('DOPTS_LIGHTBOX_MARGIN_LEFT_INFO', "Lightbox Margin Left (value in pixels). Default value: 30. Set top left value for the lightbox.");
    define('DOPTS_LIGHTBOX_PADDING_TOP_INFO', "Lightbox Padding Top (value in pixels). Default value: 10. Set top padding value for the lightbox.");
    define('DOPTS_LIGHTBOX_PADDING_RIGHT_INFO', "Lightbox Padding Right (value in pixels). Default value: 10. Set right padding value for the lightbox.");
    define('DOPTS_LIGHTBOX_PADDING_BOTTOM_INFO', "Lightbox Padding Bottom (value in pixels). Default value: 10. Set bottom padding value for the lightbox.");
    define('DOPTS_LIGHTBOX_PADDING_LEFT_INFO', "Lightbox Padding Left (value in pixels). Default value: 10. Set left padding value for the lightbox.");
                                                
    define('DOPTS_LIGHTBOX_NAVIGATION_PREV_INFO', "Lightbox Navigation Previous Button Image (path to image). Upload the image for lightbox navigation's previous button.");
    define('DOPTS_LIGHTBOX_NAVIGATION_PREV_HOVER_INFO', "Lightbox Navigation Previous Button Hover Image (path to image). Upload the image for lightbox navigation's previous hover button.");
    define('DOPTS_LIGHTBOX_NAVIGATION_NEXT_INFO', "Lightbox Navigation Next Button Image (path to image). Upload the image for lightbox navigation's next button.");
    define('DOPTS_LIGHTBOX_NAVIGATION_NEXT_HOVER_INFO', "Lightbox Navigation Next Button Hover Image (path to image). Upload the image for lightbox navigation's next hover button.");
    define('DOPTS_LIGHTBOX_NAVIGATION_CLOSE_INFO', "Lightbox Navigation Close Button Image (path to image). Upload the image for lightbox navigation's close button.");
    define('DOPTS_LIGHTBOX_NAVIGATION_CLOSE_HOVER_INFO', "Lightbox Navigation Close Button Hover Image (path to image). Upload the image for lightbox navigation's close hover button.");
    define('DOPTS_LIGHTBOX_NAVIGATION_INFO_BG_COLOR_INFO', "Lightbox Navigation Info Background Color (color hex code). Default value: ffffff. Set the color for the lightbox info background.");
    define('DOPTS_LIGHTBOX_NAVIGATION_INFO_TEXT_COLOR_INFO', "Lightbox Navigation Info Text Color (color hex code). Default value: c0c0c0. Set the color for the lightbox info text.");
    define('DOPTS_LIGHTBOX_NAVIGATION_DISPLAY_TIME_INFO', "Lightbox Navigation Display Time (time in miliseconds). Default value: 600. The time the lightbox navigation will be displayed.");
    define('DOPTS_LIGHTBOX_NAVIGATION_TOUCH_DEVICE_SWIPE_ENABLED_INFO', "Swipe Lightbox Navigation Enabled (true, false). Default value: true. Enable swipe lightbox navigation on touch devices.");
    
    define('DOPTS_TOOLTIP_BG_COLOR_INFO', "Tooltip Background Color (color hex code). Default value: ffffff. Set tooltip background color.");
    define('DOPTS_TOOLTIP_STROKE_COLOR_INFO', "Tooltip Stroke Color (color hex code). Default value: 000000. Set tooltip stroke color.");
    define('DOPTS_TOOLTIP_TEXT_COLOR_INFO', "Tooltip Text Color (color hex code). Default value: 000000. Set tooltip text color");

    define('DOPTS_LABEL_POSITION_INFO', "Label Position (bottom, top). Default value: bottom. Set label position.");
    define('DOPTS_LABEL_ALWAYS_VISIBLE_INFO', "Label Always Visible (true, false). Default value: false. On true the label is always visible, on false it will be visible only on hover.");
    define('DOPTS_LABEL_BG_COLOR_INFO', "Label Background Color (color hex code). Default value: 000000. Set label background color.");
    define('DOPTS_LABEL_BG_ALPHA_INFO', "Label Background Alpha (value from 0 to 100). Default value: 80. Set label background transparancy.");
    define('DOPTS_LABEL_TEXT_COLOR_INFO', "Label Text Color (color hex code). Default value: ffffff. Set label text color.");
    
    define('DOPTS_SLIDESHOW_ENABLED_INFO', "Slideshow Enabled (true, false). Default value: false. Enable or disable the slideshow.");
    define('DOPTS_SLIDESHOW_TIME_INFO', "Slideshow Time (time in miliseconds). Default: 5000. How much time a thumbnail stays until it passes to the next one.");
    define('DOPTS_SLIDESHOW_LOOP_INFO', "Slideshow Loop (true, false). Default: false. Set it to true if you don't want the slideshow to stop when it reaches the last thumbnail.");
    
    // Help
    define('DOPTS_TITLE_HELP', 'Help');
    
    $DOPTS_help_info = array(
        array(
            'question' => 'How do I install the scroller?',
            'answer' => '<iframe width="640" height="360" src="http://www.youtube.com/embed/BBWfbZmN5No?hl=en_US&emp;vq=hd1080" frameborder="0" allowfullscreen></iframe>'
        ),
        array(
            'question' => 'How do I create a scroller and add images to it?',
            'answer' => '<iframe width="640" height="360" src="http://www.youtube.com/embed/ifyfIuZs9zk?hl=en_US&emp;vq=hd1080" frameborder="0" allowfullscreen></iframe>'
        ),
        array(
            'question' => 'How do I create a new thumbnail?',
            'answer' => '<iframe width="640" height="360" src="http://www.youtube.com/embed/vr-gYhw3N1g?hl=en_US&emp;vq=hd1080" frameborder="0" allowfullscreen></iframe>'
        ),
        array(            
            'question' => 'How do I add media to a scroller item? Embed videos (YouTube, Vimeo, ...), add HTML code, ...',
            'answer' => '<iframe width="640" height="360" src="http://www.youtube.com/embed/q7-U3e82q4M?hl=en_US&emp;vq=hd1080" frameborder="0" allowfullscreen></iframe>'
        ),
        array(
            'question' => 'How do I change scroller settings? (Some examples)',
            'answer' => '<iframe width="640" height="360" src="http://www.youtube.com/embed/RJCPVz8zTfA?hl=en_US&emp;vq=hd1080" frameborder="0" allowfullscreen></iframe>'
        ),
        array(
            'question' => 'How can I integrate this admin into my own CMS?',
            'answer' => 'You change the session condition in <strong>dopts/admin/index.php</strong>.'
        ),
        array(
            'question' => 'Why I can\'t upload images to my scroller?',
            'answer' => 'Make sure that folders <strong>dopts/uploads/</strong> with <strong>all subfolders</strong> inside it & <strong>dopts/data/</strong> have the permissions set to <strong>777</strong>. If the folder has the right permissions try another upload method from the ones provided (AJAX, Uploadify, FTP).'
        ),
        array(
            'question' => 'Why don\'t the images appear after upload is complete?',
            'answer' => 'Make sure that you have the GD Library enabled in PHP.'
        ),
        array(
            'question' => 'Why I receive an IO Error when I upload images using Uploadify?',
            'answer' => 'The IO Error is a Flash error caused when the upload connection gets cut short. Usually happens with slow internet connections.'
        ),
        array(
            'question' => 'Why doesn\'t the scroller show in my website?',
            'answer' => '1. If the scroller doesn\'t show it might be because there is a problem with the JavaScript in your website. If you can\'t identify the problem contact me with a link. I will identify the problem for you, but I will not fix the problems that aren\'t caused by this plugin.<br /><br />
                         2. Another reason might be that you load more than one jQuery file into your theme. The proper way to load jQuery into your theme or plugin is:<br />
                         &nbsp;&nbsp;&nbsp;&nbsp;<font style="font-size:11px; font-weight:bold;"> if (!wp_script_is(\'jquery\', \'queue\')){<br />
                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;wp_enqueue_script(\'jquery\');<br />
                         &nbsp;&nbsp;&nbsp;&nbsp;} </font>'
        ),
        array(
            'question' => 'How do I change the language?',
            'answer' => 'You can change the translation in the file <strong>dopts/admin/assets/php/translation.php</strong>.'
        ),
        array(
            'question' => 'Known issues',
            'answer' => '1. On <strong>localhost</strong> servers, depending on the configuration admin might be slow, you will not be able to upload pictures, ...<br />
                         2. Uploadify will not display the progress bar and image processing will go slower if you have a firewall enabled.<br />
                         3. On some servers the images names that contain other characters different from alphanumeric ones will not be uploaded. Change the names for them to work.<br />
                         4. The Back End section has some display issues in IE 7 (please update to a new version).'
        ),
        array(
            'question' => 'What I can do when nothing works?',
            'answer' => '<a href="mailto:support@dotonpaper.zendesk.com">Contact our Support Team :)</a><br />
                         <br />
                         Before we can offer support we will need to <strong>confirm your purchase</strong>. The reason for this is because we receive a lot of support requests from people that get the items from other sites and is a great way to sort the tickets and offer faster support to the actual buyers.<br />
                         <br />
                         There are 2 ways to do this:<br>
                         1. Send us a Private Message from our <a href="http://bit.ly/TJUoXX" target="_blank">Profile Page</a> ... the right-bottom form. If you don’t see it you need to Sign In into your Envato Account.<br>
                         2. Send your Envato Username &amp; Item Purchase Code that came with the Licence Certificate when you bought the item to our <a href="mailto:support@dotonpaper.zendesk.com">Support Team</a>. You can get it from CodeCanyon -&gt; Sign In into your Account -&gt; Downloads -&gt; Licence Certificate on the purchased item.<br />
                         <br />
                         <strong>Please add in your message</strong> a link were you use the item, admin and/or FTP log in info, or any other stuff that might be relevant.<br />
                         <br />
                         We will try to answer your questions in less than 48 hours. If you don’t receive an answer in 48 hours please view our <a href="http://bit.ly/TJUoXX" target="_blank">Profile Page</a> for a reason.'
        )
    )

?>