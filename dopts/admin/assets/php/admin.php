<?php

/*
* Title                   : Thumbnail Scroller (with PHP Admin)
* Version                 : 1.1
* File                    : admin.php
* File Version            : 1.0
* Created / Last Modified : 10 December 2012
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Admin PHP Class.
*/
    
    if (isset($_POST['action'])){
        $DOPTS_load_scripts = true;
        
        require_once('../../../config.php');
        require_once('translation.php');
        
        if (!class_exists("DOPTSAdmin")){
            class DOPTSAdmin{
                function DOPTSAdmin(){// Constructor.
                }

                function init(){// Admin init.

                }

                function showGalleries(){// Show Galleries List.                    
                    $jsonData = file_get_contents('../../../data/scrollers.json');
                    $scrollers = json_decode($jsonData, TRUE);
                    $HTML = array();
                    $scrollersHTML = array();
                    $no = 0;
                    
                    for ($i=count($scrollers)-1; $i>=0; $i--){
                        if ($scrollers[$i]['status'] != 'deleted'){
                            $no++;
                            array_push($scrollersHTML, '<li class="item" id="DOPTS-ID-'.$scrollers[$i]['id'].'"><span class="id">ID '.$scrollers[$i]['id'].':</span> <span class="name">'.$this->shortGalleryName($scrollers[$i]['name'], 25).'</span></li>');
                        }
                    }                    
                    
                    if ($no == 0){
                        array_push($scrollersHTML, '<li class="no-data">'.DOPTS_NO_SCROLLERS.'</li>');
                    }
                    
                    array_push($HTML, '<ul>');
                    array_push($HTML, implode('', $scrollersHTML));
                    array_push($HTML, '</ul>');
                                        
                    echo implode('', $HTML);
                }

                function addGallery(){// Add Gallery.                    
                    $jsonData = file_get_contents('../../../data/scrollers.json');
                    $scrollers = json_decode($jsonData, TRUE);                    
                    $settings = array();
                    
                    array_push($scrollers, array("id" => count($scrollers)+1, "name" => DOPTS_ADD_SCROLLER_NAME, "status" => ""));
                    
                    $settings = array('Width' => 900,
                                      'Height' => 128,     
                                      'BgColor' => 'ffffff',
                                      'BgAlpha' => 100,
                                      'BgBorderSize' => 1,
                                      'BgBorderColor' => 'e0e0e0',
                                      'ThumbnailsOrder' => 'normal',
                                      'ResponsiveEnabled' => 'true',        
                                      'ThumbnailsPosition' => 'horizontal',
                                      'ThumbnailsBgColor' => 'ffffff',
                                      'ThumbnailsBgAlpha' => 0,
                                      'ThumbnailsBorderSize' => 0,
                                      'ThumbnailsBorderColor' => 'e0e0e0',
                                      'ThumbnailsSpacing' => 10,
                                      'ThumbnailsMarginTop' => 10,
                                      'ThumbnailsMarginRight' => 0,
                                      'ThumbnailsMarginBottom' => 10,
                                      'ThumbnailsMarginLeft' => 0,
                                      'ThumbnailsPaddingTop' => 0,
                                      'ThumbnailsPaddingRight' => 0,
                                      'ThumbnailsPaddingBottom' => 0,
                                      'ThumbnailsPaddingLeft' => 0,
                                      'ThumbnailsInfo' => 'label',        
                                      'ThumbnailsNavigationEasing' => 'linear',
                                      'ThumbnailsNavigationLoop' => 'false',                
                                      'ThumbnailsNavigationMouseEnabled' => 'false',        
                                      'ThumbnailsNavigationScrollEnabled' => 'false',
                                      'ThumbnailsScrollPosition' => 'bottom/right',
                                      'ThumbnailsScrollSize' => 5,
                                      'ThumbnailsScrollScrubColor' => '808080',
                                      'ThumbnailsScrollBarColor' => 'e0e0e0',        
                                      'ThumbnailsNavigationArrowsEnabled' => 'true',
                                      'ThumbnailsNavigationArrowsNoItemsSlide' => 1,
                                      'ThumbnailsNavigationArrowsSpeed' => 600,
                                      'ThumbnailsNavigationPrev' => 'dopts/uploads/settings/thumbnails-navigation-prev/0.png',
                                      'ThumbnailsNavigationPrevHover' => 'dopts/uploads/settings/thumbnails-navigation-prev-hover/0.png',
                                      'ThumbnailsNavigationPrevDisabled' => 'dopts/uploads/settings/thumbnails-navigation-prev-disabled/0.png',
                                      'ThumbnailsNavigationNext' => 'dopts/uploads/settings/thumbnails-navigation-next/0.png',
                                      'ThumbnailsNavigationNextHover' => 'dopts/uploads/settings/thumbnails-navigation-next-hover/0.png',
                                      'ThumbnailsNavigationNextDisabled' => 'dopts/uploads/settings/thumbnails-navigation-next-disabled/0.png',        
                                      'ThumbnailLoader' => 'dopts/uploads/settings/thumbnail-loader/0.gif',
                                      'ThumbnailWidth' => 100,
                                      'ThumbnailHeight' => 100,
                                      'ThumbnailAlpha' => 100,
                                      'ThumbnailAlphaHover' => 100,
                                      'ThumbnailBgColor' => 'f1f1f1',
                                      'ThumbnailBgColorHover' => 'f1f1f1',
                                      'ThumbnailBorderSize' => 1,
                                      'ThumbnailBorderColor' => 'd0d0d0',
                                      'ThumbnailBorderColorHover' => '303030',
                                      'ThumbnailPaddingTop' => 2,
                                      'ThumbnailPaddingRight' => 2,
                                      'ThumbnailPaddingBottom' => 2,
                                      'ThumbnailPaddingLeft' => 2,        
                                      'LightboxEnabled' => 'true',
                                      'LightboxDisplayTime' => 600,
                                      'LightboxWindowColor' => 'ffffff',
                                      'LightboxWindowAlpha' => 80,
                                      'LightboxLoader' => 'dopts/uploads/settings/lightbox-loader/0.gif',
                                      'LightboxBgColor' => 'ffffff',
                                      'LightboxBgAlpha' => 100,
                                      'LightboxBorderSize' => 1,
                                      'LightboxBorderColor' => 'e0e0e0',   
                                      'LightboxCaptionTextColor' => '999999',
                                      'LightboxMarginTop' => 30,
                                      'LightboxMarginRight' => 30,
                                      'LightboxMarginBottom' => 30,
                                      'LightboxMarginLeft' => 30,
                                      'LightboxPaddingTop' => 10,
                                      'LightboxPaddingRight' => 10,
                                      'LightboxPaddingBottom' => 10,
                                      'LightboxPaddingLeft' => 10,        
                                      'LightboxNavigationPrev' => 'dopts/uploads/settings/lightbox-navigation-prev/0.png',
                                      'LightboxNavigationPrevHover' => 'dopts/uploads/settings/lightbox-navigation-prev-hover/0.png',
                                      'LightboxNavigationNext' => 'dopts/uploads/settings/lightbox-navigation-next/0.png',
                                      'LightboxNavigationNextHover' => 'dopts/uploads/settings/lightbox-navigation-next-hover/0.png',
                                      'LightboxNavigationClose' => 'dopts/uploads/settings/lightbox-navigation-close/0.png',
                                      'LightboxNavigationCloseHover' => 'dopts/uploads/settings/lightbox-navigation-close-hover/0.png',
                                      'LightboxNavigationInfoBgColor' => 'ffffff',
                                      'LightboxNavigationInfoTextColor' => 'c0c0c0',
                                      'LightboxNavigationDisplayTime' => 600,
                                      'LightboxNavigationTouchDeviceSwipeEnabled' => 'true',        
                                      'TooltipBgColor' => 'ffffff',
                                      'TooltipStrokeColor' => '000000',
                                      'TooltipTextColor' => '000000',                                    
                                      'LabelPosition' => 'bottom',                                 
                                      'LabelAlwaysVisible' => 'false',
                                      'LabelBgColor' => '000000',
                                      'LabelBgAlpha' => 80,
                                      'LabelTextColor' => 'ffffff',        
                                      'SlideshowEnabled' => 'false',
                                      'SlideshowTime' => 5000,
                                      'SlideshowLoop' => 'false');
                     
                    $file = fopen('../../../data/scrollers.json', 'w');
                    fwrite($file, json_encode($scrollers));
                    fclose($file);
                                                            
                    $file = fopen('../../../data/settings'.count($scrollers).'.json', 'w');
                    fwrite($file, json_encode($settings));
                    fclose($file);
                    
                    $file = fopen('../../../data/content'.count($scrollers).'.json', 'w');
                    fwrite($file, '[]');
                    fclose($file);
                    
                    $this->showGalleries();
                }

                function showGalleryInfo(){// Show Gallery Info.     
                    if ($_POST['scroller_id'] == 0){
                        echo file_get_contents('../../../data/settings.json');
                    }
                    else{
                        $jsonData = file_get_contents('../../../data/scrollers.json');
                        $scrollers = json_decode($jsonData, TRUE);
                        $name = '';

                        foreach ($scrollers as $scroller){
                            if ($scroller['id'] ==  $_POST['scroller_id']){
                                $name = $scroller['name'];
                            }
                        }    
                        
                        $jsonData = file_get_contents('../../../data/settings'.$_POST['scroller_id'].'.json');
                        $settings = json_decode($jsonData, TRUE);
                        $settings['Name'] = $name;
                        
                        echo json_encode($settings);
                    }
                }

                function updateSettingsImage(){// Update Settings Images via AJAX.
                    if (isset($_POST['scroller_id'])){
                        $jsonData = file_get_contents('../../../data/settings'.$_POST['scroller_id'].'.json');
                        $settings = json_decode($jsonData, TRUE);
                        
                        switch ($_POST['item']){
                            case 'thumbnails_navigation_prev':
                                $settings['ThumbnailsNavigationPrev'] = 'dopts/'.$_POST['path'];
                                break;
                            case 'thumbnails_navigation_prev_hover':
                                $settings['ThumbnailsNavigationPrevHover'] = 'dopts/'.$_POST['path'];
                                break;
                            case 'thumbnails_navigation_prev_disabled':
                                $settings['ThumbnailsNavigationPrevDisabled'] = 'dopts/'.$_POST['path'];
                                break;
                            case 'thumbnails_navigation_next':
                                $settings['ThumbnailsNavigationNext'] = 'dopts/'.$_POST['path'];
                                break;
                            case 'thumbnails_navigation_next_hover':
                                $settings['ThumbnailsNavigationNextHover'] = 'dopts/'.$_POST['path'];
                                break;
                            case 'thumbnails_navigation_next_disabled':
                                $settings['ThumbnailsNavigationNextDisabled'] = 'dopts/'.$_POST['path'];
                                break;
                            case 'thumbnail_loader':
                                $settings['ThumbnailLoader'] = 'dopts/'.$_POST['path'];
                                break;                           
                            case 'lightbox_loader':
                                $settings['LightboxLoader'] = 'dopts/'.$_POST['path'];
                                break;
                            case 'lightbox_navigation_prev':
                                $settings['LightboxNavigationPrev'] = 'dopts/'.$_POST['path'];
                                break;
                            case 'lightbox_navigation_prev_hover':
                                $settings['LightboxNavigationPrevHover'] = 'dopts/'.$_POST['path'];
                                break;
                            case 'lightbox_navigation_next':
                                $settings['LightboxNavigationNext'] = 'dopts/'.$_POST['path'];
                                break;
                            case 'lightbox_navigation_next_hover':
                                $settings['LightboxNavigationNextHover'] = 'dopts/'.$_POST['path'];
                                break;
                            case 'lightbox_navigation_close':
                                $settings['LightboxNavigationClose'] = 'dopts/'.$_POST['path'];
                                break;
                            case 'lightbox_navigation_close_hover':
                                $settings['LightboxNavigationCloseHover'] = 'dopts/'.$_POST['path'];
                                break;
                        }
                        
                        $file = fopen('../../../data/settings'.$_POST['scroller_id'].'.json', 'w');
                        fwrite($file, json_encode($settings));
                        fclose($file);

                        echo '';
                    }
                }

                function editGallery(){// Edit Gallery Settings.
                    if ($_POST['scroller_id'] == 0){
                        $jsonData = file_get_contents('../../../data/settings.json');
                    }
                    else{
                        $jsonData = file_get_contents('../../../data/settings'.$_POST['scroller_id'].'.json');
                    }
                    $settings = json_decode($jsonData, TRUE);
                                            
                    $settings['Width'] = $_POST['width'];
                    $settings['Height'] = $_POST['height'];
                    $settings['BgColor'] = $_POST['bg_color'];
                    $settings['BgAlpha'] = $_POST['bg_alpha'];
                    $settings['BgBorderSize'] = $_POST['bg_border_size'];
                    $settings['BgBorderColor'] = $_POST['bg_border_color'];
                    $settings['ThumbnailsOrder'] = $_POST['thumbnails_order'];
                    $settings['ResponsiveEnabled'] = $_POST['responsive_enabled'];   
                    $settings['ThumbnailsPosition'] = $_POST['thumbnails_position'];
                    $settings['ThumbnailsBgColor'] = $_POST['thumbnails_bg_color'];
                    $settings['ThumbnailsBgAlpha'] = $_POST['thumbnails_bg_alpha'];
                    $settings['ThumbnailsBorderSize'] = $_POST['thumbnails_border_size'];
                    $settings['ThumbnailsBorderColor'] = $_POST['thumbnails_border_color'];
                    $settings['ThumbnailsSpacing'] = $_POST['thumbnails_spacing'];
                    $settings['ThumbnailsMarginTop'] = $_POST['thumbnails_margin_top'];
                    $settings['ThumbnailsMarginRight'] = $_POST['thumbnails_margin_right'];
                    $settings['ThumbnailsMarginBottom'] = $_POST['thumbnails_margin_bottom'];
                    $settings['ThumbnailsMarginLeft'] = $_POST['thumbnails_margin_left'];
                    $settings['ThumbnailsPaddingTop'] = $_POST['thumbnails_padding_top'];
                    $settings['ThumbnailsPaddingRight'] = $_POST['thumbnails_padding_right'];
                    $settings['ThumbnailsPaddingBottom'] = $_POST['thumbnails_padding_bottom'];
                    $settings['ThumbnailsPaddingLeft'] = $_POST['thumbnails_padding_left'];
                    $settings['ThumbnailsInfo'] = $_POST['thumbnails_info'];    
                    $settings['ThumbnailsNavigationEasing'] = $_POST['thumbnails_navigation_easing'];
                    $settings['ThumbnailsNavigationLoop'] = $_POST['thumbnails_navigation_loop'];
                    $settings['ThumbnailsNavigationMouseEnabled'] = $_POST['thumbnails_navigation_mouse_enabled'];
                    $settings['ThumbnailsNavigationScrollEnabled'] = $_POST['thumbnails_navigation_scroll_enabled'];
                    $settings['ThumbnailsScrollPosition'] = $_POST['thumbnails_scroll_position'];
                    $settings['ThumbnailsScrollSize'] = $_POST['thumbnails_scroll_size'];
                    $settings['ThumbnailsScrollScrubColor'] = $_POST['thumbnails_scroll_scrub_color'];
                    $settings['ThumbnailsScrollBarColor'] = $_POST['thumbnails_scroll_bar_color'];
                    $settings['ThumbnailsNavigationArrowsEnabled'] = $_POST['thumbnails_navigation_arrows_enabled'];
                    $settings['ThumbnailsNavigationArrowsNoItemsSlide'] = $_POST['thumbnails_navigation_arrows_no_items_slide'];
                    $settings['ThumbnailsNavigationArrowsSpeed'] = $_POST['thumbnails_navigation_arrows_speed'];
                    $settings['ThumbnailWidth'] = $_POST['thumbnail_width'];
                    $settings['ThumbnailHeight'] = $_POST['thumbnail_height'];
                    $settings['ThumbnailAlpha'] = $_POST['thumbnail_alpha'];
                    $settings['ThumbnailAlphaHover'] = $_POST['thumbnail_alpha_hover'];
                    $settings['ThumbnailBgColor'] = $_POST['thumbnail_bg_color'];
                    $settings['ThumbnailBgColorHover'] = $_POST['thumbnail_bg_color_hover'];
                    $settings['ThumbnailBorderSize'] = $_POST['thumbnail_border_size'];
                    $settings['ThumbnailBorderColor'] = $_POST['thumbnail_border_color'];
                    $settings['ThumbnailBorderColorHover'] = $_POST['thumbnail_border_color_hover'];
                    $settings['ThumbnailPaddingTop'] = $_POST['thumbnail_padding_top'];
                    $settings['ThumbnailPaddingRight'] = $_POST['thumbnail_padding_right'];
                    $settings['ThumbnailPaddingBottom'] = $_POST['thumbnail_padding_bottom'];
                    $settings['ThumbnailPaddingLeft'] = $_POST['thumbnail_padding_left'];
                    $settings['LightboxEnabled'] = $_POST['lightbox_enabled'];
                    $settings['LightboxDisplayTime'] = $_POST['lightbox_display_time'];
                    $settings['LightboxWindowColor'] = $_POST['lightbox_window_color'];
                    $settings['LightboxWindowAlpha'] = $_POST['lightbox_window_alpha'];
                    $settings['LightboxBgColor'] = $_POST['lightbox_bg_color'];
                    $settings['LightboxBgAlpha'] = $_POST['lightbox_bg_alpha'];
                    $settings['LightboxBorderSize'] = $_POST['lightbox_border_size'];
                    $settings['LightboxBorderColor'] = $_POST['lightbox_border_color'];
                    $settings['LightboxCaptionTextColor'] = $_POST['lightbox_caption_text_color'];
                    $settings['LightboxMarginTop'] = $_POST['lightbox_margin_top'];
                    $settings['LightboxMarginRight'] = $_POST['lightbox_margin_right'];
                    $settings['LightboxMarginBottom'] = $_POST['lightbox_margin_bottom'];
                    $settings['LightboxMarginLeft'] = $_POST['lightbox_margin_left'];
                    $settings['LightboxPaddingTop'] = $_POST['lightbox_padding_top'];
                    $settings['LightboxPaddingRight'] = $_POST['lightbox_padding_right'];
                    $settings['LightboxPaddingBottom'] = $_POST['lightbox_padding_bottom'];
                    $settings['LightboxPaddingLeft'] = $_POST['lightbox_padding_left'];
                    $settings['LightboxNavigationInfoBgColor'] = $_POST['lightbox_navigation_info_bg_color'];
                    $settings['LightboxNavigationInfoTextColor'] = $_POST['lightbox_navigation_info_text_color'];
                    $settings['LightboxNavigationDisplayTime'] = $_POST['lightbox_navigation_display_time'];
                    $settings['LightboxNavigationTouchDeviceSwipeEnabled'] = $_POST['lightbox_navigation_touch_device_swipe_enabled'];
                    $settings['TooltipBgColor'] = $_POST['tooltip_bg_color'];
                    $settings['TooltipStrokeColor'] = $_POST['tooltip_stroke_color'];
                    $settings['TooltipTextColor'] = $_POST['tooltip_text_color'];
                    $settings['LabelPosition'] = $_POST['label_position'];                           
                    $settings['LabelAlwaysVisible'] = $_POST['label_always_visible'];           
                    $settings['LabelBgColor'] = $_POST['label_bg_color'];
                    $settings['LabelBgAlpha'] = $_POST['label_bg_alpha'];
                    $settings['LabelTextColor'] = $_POST['label_text_color'];
                    $settings['SlideshowEnabled'] = $_POST['slideshow_enabled'];
                    $settings['SlideshowTime'] = $_POST['slideshow_time'];
                    $settings['SlideshowLoop'] = $_POST['slideshow_loop'];
                    
                    if (isset($_POST['thumbnail_loader'])){
                        $settings['ThumbnailsNavigationPrev'] = $_POST['thumbnails_navigation_prev'];
                        $settings['ThumbnailsNavigationPrevHover'] = $_POST['thumbnails_navigation_prev_hover'];
                        $settings['ThumbnailsNavigationPrevDisabled'] = $_POST['thumbnails_navigation_prev_disabled'];
                        $settings['ThumbnailsNavigationNext'] = $_POST['thumbnails_navigation_next'];
                        $settings['ThumbnailsNavigationNextHover'] = $_POST['thumbnails_navigation_next_hover'];
                        $settings['ThumbnailsNavigationNextDisabled'] = $_POST['thumbnails_navigation_next_disabled'];
                        $settings['ThumbnailLoader'] = $_POST['thumbnail_loader'];                        
                        $settings['LightboxLoader'] = $_POST['lightbox_loader'];                              
                        $settings['LightboxNavigationPrev'] = $_POST['lightbox_navigation_prev'];
                        $settings['LightboxNavigationPrevHover'] = $_POST['lightbox_navigation_prev_hover'];
                        $settings['LightboxNavigationNext'] = $_POST['lightbox_navigation_next'];
                        $settings['LightboxNavigationNextHover'] = $_POST['lightbox_navigation_next_hover'];
                        $settings['LightboxNavigationClose'] = $_POST['lightbox_navigation_close'];
                        $settings['LightboxNavigationCloseHover'] = $_POST['lightbox_navigation_close_hover'];
                    }
                    
                    $jsonData = file_get_contents('../../../data/scrollers.json');
                    $scrollers = json_decode($jsonData, TRUE);
                    $newGalleries = array();
                    
                    foreach ($scrollers as $scroller){
                        if ($scroller['id'] == $_POST['scroller_id']){
                            $scroller['name'] = $_POST['name'];
                        }
                        
                        array_push($newGalleries, $scroller);
                    }     
                                        
                    $file = fopen('../../../data/scrollers.json', 'w');
                    fwrite($file, json_encode($newGalleries));
                    fclose($file);
                    
                    $file = fopen('../../../data/settings'.$_POST['scroller_id'].'.json', 'w');
                    fwrite($file, json_encode($settings));
                    fclose($file);

                    echo '';
                }

                function deleteGallery(){// Delete Gallery.
                    $jsonData = file_get_contents('../../../data/scrollers.json');
                    $scrollers = json_decode($jsonData, TRUE);
                    $newGalleries = array();
                    $no = 0;
                    
                    foreach ($scrollers as $scroller){                        
                        if ($scroller['id'] == (int)$_POST['id']){
                            $scroller['status'] = 'deleted';
                        }
                        else if ($scroller['status'] != 'deleted'){
                            $no++;
                        }
                        
                        array_push($newGalleries, $scroller);
                    }     
                                        
                    $file = fopen('../../../data/scrollers.json', 'w');
                    fwrite($file, json_encode($newGalleries));
                    fclose($file);

                    $jsonData = file_get_contents('../../../data/content'.$_POST['id'].'.json');
                    $images = json_decode($jsonData, TRUE);                    
                    
                    foreach ($images as $image) {
                        if (file_exists(DOPTS_ABSOLUTE_PATH.$image['Image'])){                            
                            unlink(DOPTS_ABSOLUTE_PATH.$image['Image']);
                        }
                        if (file_exists(DOPTS_ABSOLUTE_PATH.$image['Thumb'])){
                            unlink(DOPTS_ABSOLUTE_PATH.$image['Thumb']);
                        }
                    }
                                        
                    if (file_exists(DOPTS_ABSOLUTE_PATH.'dopts/data/settings'.$_POST['id'].'.json')){ 
                        unlink(DOPTS_ABSOLUTE_PATH.'dopts/data/settings'.$_POST['id'].'.json');
                    }
                    if (file_exists(DOPTS_ABSOLUTE_PATH.'dopts/data/content'.$_POST['id'].'.json')){ 
                        unlink(DOPTS_ABSOLUTE_PATH.'dopts/data/content'.$_POST['id'].'.json');
                    }
                    
                    echo $no;
                }            

                function shortGalleryName($name, $size){// Return a short name for the scroller.
                    $new_name = '';
                    $pieces = str_split($name);

                    if (count($pieces) <= $size){
                        $new_name = $name;
                    }
                    else{
                        for ($i=0; $i<$size-3; $i++){
                            $new_name .= $pieces[$i];
                        }
                        $new_name .= '...';
                    }

                    return $new_name;
                }

                function showImages(){// Show Images List.
                    $jsonData = file_get_contents('../../../data/content'.$_POST['scroller_id'].'.json');
                    $images = json_decode($jsonData, TRUE);                    
                    $imagesHTML = array();
                    $id = 0;
                        
                    array_push($imagesHTML, '<ul>');
                                        
                    if (count($images) != 0){
                        foreach ($images as $image){
                            $id++;
                            
                            if ($image['Enabled'] == 'true'){
                                array_push($imagesHTML, '<li class="item-image" id="DOPTS-image-ID-'.$id.'"><img src="'.DOPTS_URL.$image['Thumb'].'" alt="" /></li>');
                            }
                            else{
                                array_push($imagesHTML, '<li class="item-image item-image-disabled" id="DOPTS-image-ID-'.$id.'"><img src="'.DOPTS_URL.$image['Thumb'].'" alt="" /></li>');
                            }
                        }
                    }
                    else{
                        array_push($imagesHTML, '<li class="no-data">'.DOPTS_NO_IMAGES.'</li>');
                    }

                    array_push($imagesHTML, '</ul>');

                    echo implode('', $imagesHTML);
                }

                function addImageFTP(){// Add Images from FTP.
                    global $wpdb;

                    $folder = DOPTS_ABSOLUTE_PATH.'dopts/ftp-uploads';
                    $images = array();
                    $folderData = opendir($folder);

                    while (($file = readdir($folderData)) !== false){
                        if ($file != '.' && $file != '..'){
                            array_push($images, "$file");
                        }
                    }

                    closedir($folderData);

                    $result = array();
                    $targetPath = DOPTS_ABSOLUTE_PATH.'dopts/uploads';
                    sort($images);

                    foreach ($images as $image):
                        $currFile = DOPTS_ABSOLUTE_PATH.'dopts/ftp-uploads/'.$image;
                        $ext = substr($image, strrpos($image, '.')+1);
                        $newName = $this->generateName();
                        $targetFile =  str_replace('//','/',$targetPath).'/'.$newName.'.'.$ext;

                        // File and new size
                        $filename = $targetPath.'/'.$newName.'.'.$ext;

                        // Get new sizes
                        list($width, $height) = getimagesize($currFile);

                        // Load
                        $newImage = ImageCreateTrueColor($width, $height);
                        if ($ext == 'png'){
                            imagealphablending($newImage, false);
                            imagesavealpha($newImage, true);  
                        }
                        if ($ext == 'png'){
                            $source = imagecreatefrompng($_POST['image_url']);
                            imagealphablending($source, true);
                        }
                        else{
                            $source = imagecreatefromjpeg($currFile);
                        }

                        // Resize
                        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $width, $height, $width, $height);

                        // Output
                        if ($ext == 'png'){
                            $source = imagepng($newImage, $filename);
                        }
                        else{
                            $source = imagejpeg($newImage, $filename, 100);
                        }

                        // CREATE THUMBNAIL

                        // Get new sizes
                        list($width, $height) = getimagesize($filename);
                        $newheight = 300;
                        $newwidth = $width*$newheight/$height;

                        if ($newwidth < 300){
                            $newwidth = 300;
                            $newheight = $height*$newwidth/$width;
                        }

                        // Load
                        $thumb = ImageCreateTrueColor($newwidth, $newheight);
                        if ($ext == 'png'){
                            imagealphablending($thumb, false);
                            imagesavealpha($thumb, true);  
                        }
                        if ($ext == 'png'){
                            $source = imagecreatefrompng($filename);
                            imagealphablending($source, true);
                        }
                        else{
                            $source = imagecreatefromjpeg($filename);
                        }

                        // Resize
                        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                        // Output
                        if ($ext == 'png'){
                            $source = imagepng($thumb, $targetPath.'/thumbs/'.$newName.'.'.$ext);
                        }
                        else{
                            $source = imagejpeg($thumb, $targetPath.'/thumbs/'.$newName.'.'.$ext, 100);
                        }

                        $jsonData = file_get_contents('../../../data/content'.$_POST['scroller_id'].'.json');
                        $imagesList = json_decode($jsonData, TRUE);
                    
                        array_push($imagesList, array('Image' => 'dopts/uploads/'.$newName.'.'.$ext,
                                                      'Thumb' => 'dopts/uploads/thumbs/'.$newName.'.'.$ext,
                                                      'Title' => '',
                                                      'Caption' => '',
                                                      'Media' => '',
                                                      'LightboxMedia' => '',
                                                      'Link' => '',
                                                      'Target' => '_blank',
                                                      'Enabled' => 'true'));
                        
                        $file = fopen('../../../data/content'.$_POST['scroller_id'].'.json', 'w');
                        fwrite($file, json_encode($imagesList));
                        fclose($file);
                        
                        array_push($result, count($imagesList).';;;'.$newName.'.'.$ext);
                    endforeach;

                    echo implode(';;;;;', $result);
                }

                function addImage(){// Add Image via AJAX.
                    $jsonData = file_get_contents('../../../data/content'.$_POST['scroller_id'].'.json');
                    $imagesList = json_decode($jsonData, TRUE);
                    
                    array_push($imagesList, array('Image' => 'dopts/uploads/'.$_POST['name'],
                                                  'Thumb' => 'dopts/uploads/thumbs/'.$_POST['name'],
                                                  'Title' => '',
                                                  'Caption' => '',
                                                  'Media' => '',
                                                  'LightboxMedia' => '',
                                                  'Link' => '',
                                                  'Target' => '_blank',
                                                  'Enabled' => 'true'));

                    $file = fopen('../../../data/content'.$_POST['scroller_id'].'.json', 'w');
                    fwrite($file, json_encode($imagesList));
                    fclose($file);                

                    echo count($imagesList);
                }

                function sortImages(){// Sort Images via AJAX.
                    $jsonData = file_get_contents('../../../data/content'.$_POST['scroller_id'].'.json');
                    $images = json_decode($jsonData, TRUE);
                    $order = explode(',', $_POST['data']);
                    $orderedImages = array();
                    
                    for ($i=0; $i<=count($order); $i++){
                        $id = 0;
                        
                        foreach ($images as $image):
                            $id++;
                        
                            if ($id == $order[$i]){
                                array_push($orderedImages, $image);
                                break;
                            }
                        endforeach;
                    }

                    $file = fopen('../../../data/content'.$_POST['scroller_id'].'.json', 'w');
                    fwrite($file, json_encode($orderedImages));
                    fclose($file);
                }

                function showImage(){// Show Image details.
                    $jsonData = file_get_contents('../../../data/content'.$_POST['scroller_id'].'.json');
                    $images = json_decode($jsonData, TRUE);
                    $id = 0;
                    
                    foreach ($images as $image):
                        $id++;
                        
                        if ($id == $_POST['image_id']){
                            $jsonSettings = file_get_contents('../../../data/settings'.$_POST['scroller_id'].'.json');
                            $settings = json_decode($jsonSettings, TRUE);
                            
                            $result = array('id' => $id,
                                            'image' => $image['Image'],
                                            'thumb' => $image['Thumb'],
                                            'thumbnail_width' => $settings['ThumbnailWidth'],
                                            'thumbnail_height' => $settings['ThumbnailHeight'],
                                            'title' => stripslashes($image['Title']),
                                            'caption' => preg_replace("/<br>/", "\n", stripslashes($image['Caption'])),
                                            'media' => stripslashes($image['Media']),
                                            'lightbox_media' => stripslashes($image['LightboxMedia']),
                                            'link' => stripslashes($image['Link']),
                                            'target' => $image['Target'],
                                            'enabled' => $image['Enabled']);
                            
                            echo json_encode($result);
                            
                            break;
                        }
                    endforeach;
                }

                function editImage(){// Edit Image.
                    $jsonData = file_get_contents('../../../data/content'.$_POST['scroller_id'].'.json');
                    $images = json_decode($jsonData, TRUE);
                    $newImages = array();
                    $id = 0;
                    
                    foreach ($images as $image):                    
                        $id++;
                    
                        if ($id == (int)$_POST['image_id']){
                            $imageData = $image['Image'];
                            $thumbData = $image['Thumb'];
                            $image['Title'] = $_POST['image_title'];
                            $image['Caption'] = preg_replace('`[\r\n]`', "<br>", $_POST['image_caption']);
                            $image['Media'] = $_POST['image_media'];
                            $image['LightboxMedia'] = $_POST['image_lightbox_media'];
                            $image['Link'] = $_POST['image_link'];
                            $image['Target'] = $_POST['image_target'];
                            $image['Enabled'] = $_POST['image_enabled'];
                        }
                                                
                        array_push($newImages, $image);
                    endforeach;
                    
                    $file = fopen('../../../data/content'.$_POST['scroller_id'].'.json', 'w');
                    fwrite($file, json_encode($newImages));
                    fclose($file);
                    
                    if ($_POST['crop_width'] > 0){
                        list($width, $height) = getimagesize(DOPTS_ABSOLUTE_PATH.$imageData);
                        $pr = $width/$_POST['image_width'];
                        $ext = substr($_POST['image_name'], strrpos($_POST['image_name'], '.') + 1);

                        $src = DOPTS_ABSOLUTE_PATH.$imageData;

                        if ($ext == 'png'){
                            $img_r = imagecreatefrompng($src);
                            imagealphablending($img_r, true);
                        }
                        else{
                            $img_r = imagecreatefromjpeg($src);
                        }

                        $thumb = ImageCreateTrueColor($_POST['thumb_width'], $_POST['thumb_height']);
                        if ($ext == 'png'){
                            imagealphablending($thumb, false);
                            imagesavealpha($thumb, true);  
                        }

                        imagecopyresampled($thumb, $img_r , 0, 0, $_POST['crop_x']*$pr, $_POST['crop_y']*$pr, $_POST['thumb_width'], $_POST['thumb_height'], $_POST['crop_width']*$pr, $_POST['crop_height']*$pr);

                        if ($ext == 'png') $source = imagepng($thumb, DOPTS_ABSOLUTE_PATH.$thumbData);
                        else $source = imagejpeg($thumb, DOPTS_ABSOLUTE_PATH.$thumbData, 100);

                        echo DOPTS_URL.$thumbData;
                    }
                    else{
                        echo '';
                    }
                }

                function deleteImage(){// Delete Image.
                    $jsonData = file_get_contents('../../../data/content'.$_POST['scroller_id'].'.json');
                    $images = json_decode($jsonData, TRUE);
                    $newImages = array();
                    $id = 0;
                    $num_rows = 0;
                    
                    foreach ($images as $image):                    
                        $id++;
                    
                        if ($id == (int)$_POST['image_id']){
                            $imageData = $image['Image'];
                            $thumbData = $image['Thumb'];                            
                        }
                        else{                        
                            $num_rows++;
                            array_push($newImages, $image);
                        }
                    endforeach;
                    
                    $file = fopen('../../../data/content'.$_POST['scroller_id'].'.json', 'w');
                    fwrite($file, json_encode($newImages));
                    fclose($file);
                                        
                    if (file_exists(DOPTS_ABSOLUTE_PATH.$imageData)){                            
                        unlink(DOPTS_ABSOLUTE_PATH.$imageData);
                    }
                    if (file_exists(DOPTS_ABSOLUTE_PATH.$thumbData)){
                        unlink(DOPTS_ABSOLUTE_PATH.$thumbData);
                    }

                    echo $num_rows;
                }

                private function generateName(){
                    $len = 64;
                    $base = 'ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789';
                    $max = strlen($base)-1;
                    $newName = '';
                    mt_srand((double)microtime()*1000000);

                    while (strlen($newName)<$len+1){
                        $newName .= $base{mt_rand(0,$max)};
                    }

                    return $newName;
                }  
            }
        }
        
        $admin = new DOPTSAdmin();
        
        switch ($_POST['action']){
            case 'dopts_show_scrollers':
                $admin->showGalleries(); break; 
            case 'dopts_add_scroller':
                $admin->addGallery(); break; 
            case 'dopts_show_scroller_info':
                $admin->showGalleryInfo(); break;  
            case 'dopts_update_settings_image':
                $admin->updateSettingsImage(); break;  
            case 'dopts_edit_scroller':
                $admin->editGallery(); break;   
            case 'dopts_delete_scroller':
                $admin->deleteGallery(); break; 
            case 'dopts_show_images':
                $admin->showImages(); break;  
            case 'dopts_add_image_ftp':
                $admin->addImageFTP(); break; 
            case 'dopts_add_image':
                $admin->addImage(); break; 
            case 'dopts_sort_images':
                $admin->sortImages(); break; 
            case 'dopts_show_image':
                $admin->showImage(); break; 
            case 'dopts_edit_image':
                $admin->editImage(); break;   
            case 'dopts_delete_image':
                $admin->deleteImage(); break;   
        }
    }
    else{
        echo 'not ok';
        exit('<h2 style="color:#aaaaaa; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold;">Warning! No direct script access allowed.</h2>');        
    }
    
?>