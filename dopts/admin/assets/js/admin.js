
/*
* Title                   : Thumbnail Scroller (with PHP Admin)
* Version                 : 1.1
* File                    : admin.js
* File Version            : 1.0
* Created / Last Modified : 10 December 2012
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Admin Scripts.
*/

//Declare global variables.
var ajaxurl = 'assets/php/admin.php',
currScroller = 0,
currImage = 0,
clearClick = true,
imageDisplay = false,
imageWidth = 0,
imageHeight = 0,
$jDOPTS = jQuery.noConflict();

$jDOPTS(document).ready(function(){
    doptsResize();

    $jDOPTS(window).resize(function(){
        doptsResize();
    });
    
    $jDOPTS(document).scroll(function(){
        doptsResize();
    });

    switch (DOPTS_curr_page){
        case 'Scrollers List':
            doptsShowScrollers();
            break;
        case 'Help':
            doptsInitHelp();
            break;            
    }
});

function doptsResize(){// Resize admin panel.
    $jDOPTS('.column2', '.DOPTS-admin').width(($jDOPTS('.DOPTS-admin').width()-$jDOPTS('.column1', '.DOPTS-admin').width()-2)/2);
    $jDOPTS('.column3', '.DOPTS-admin').width(($jDOPTS('.DOPTS-admin').width()-$jDOPTS('.column1', '.DOPTS-admin').width()-2)/2);
    $jDOPTS('.column-separator', '.DOPTS-admin').height(0);
    $jDOPTS('.column-separator', '.DOPTS-admin').height($jDOPTS('.DOPTS-admin').height()-$jDOPTS('h1', '.DOPTS-admin').height()-parseInt($jDOPTS('h1', '.DOPTS-admin').css('padding-top'))-parseInt($jDOPTS('h1', '.DOPTS-admin').css('padding-bottom')));
    $jDOPTS('.main', '.DOPTS-admin').css('display', 'block');

    $jDOPTS('.column-input', '.DOPTS-admin').width($jDOPTS('.column-content', '.column3', '.DOPTS-admin').width()-32);
    $jDOPTS('.column-image', '.DOPTS-admin').width($jDOPTS('.column-content', '.column3', '.DOPTS-admin').width()-20);
    
    if (imageDisplay){
        $jDOPTS('span', '.column-image', '.DOPTS-admin').width($jDOPTS('.column-image', '.DOPTS-admin').width());
        $jDOPTS('span', '.column-image', '.DOPTS-admin').height(($jDOPTS('.column-image', '.DOPTS-admin').width())*imageHeight/imageWidth);
        $jDOPTS('img', '.column-image', '.DOPTS-admin').width($jDOPTS('span', '.column-image', '.DOPTS-admin').width());
        $jDOPTS('img', '.column-image', '.DOPTS-admin').height($jDOPTS('span', '.column-image', '.DOPTS-admin').height());
        $jDOPTS('img', '.column-image', '.DOPTS-admin').css('margin-top', 0);
        $jDOPTS('img', '.column-image', '.DOPTS-admin').css('margin-left', 0);
    }
}

function doptsShowScrollers(){// Show all scrollers.
    doptsRemoveColumns(2);
    doptsToggleMessage('show', DOPTS_LOAD);
    
    $jDOPTS.post(ajaxurl, {action: 'dopts_show_scrollers'}, function(data){
        $jDOPTS('.column-content', '.column1', '.DOPTS-admin').html(data);
        doptsScrollersEvents();
        doptsToggleMessage('hide', DOPTS_SCROLLERS_LOADED);
    });
}

function doptsAddScroller(){// Add scroller via AJAX.
    if (clearClick){
        doptsRemoveColumns(2);
        doptsToggleMessage('show', DOPTS_ADD_SCROLLER_SUBMITED);
        
        $jDOPTS.post(ajaxurl, {action: 'dopts_add_scroller'}, function(data){
            $jDOPTS('.column-content', '.column1', '.DOPTS-admin').html(data);
            doptsScrollersEvents();
            doptsToggleMessage('hide', DOPTS_ADD_SCROLLER_SUCCESS);
        });
    }
}

function doptsShowScrollersInfo(){// Show default settings.
    if (clearClick){
        $jDOPTS('li', '.column1', '.DOPTS-admin').removeClass('item-selected');
        currScroller = 0;
        currImage = 0;
        doptsRemoveColumns(2);
        $jDOPTS('#scroller_id').val(0);
        doptsToggleMessage('show', DOPTS_LOAD);
        
        $jDOPTS.post(ajaxurl, {action: 'dopts_show_scroller_info', scroller_id:$jDOPTS('#scroller_id').val()}, function(data){
            var HeaderHTML = new Array(),
            json = $jDOPTS.parseJSON(data);

            HeaderHTML.push('<input type="button" name="DOPTS_scroller_submit" class="submit-style" onclick="doptsEditScroller()" title="'+DOPTS_EDIT_SCROLLERS_SUBMIT+'" value="'+DOPTS_SUBMIT+'" />');
            HeaderHTML.push('<a href="javascript:void()" class="header-help" title="'+DOPTS_SCROLLERS_EDIT_INFO_HELP+'"></a>');

            $jDOPTS('.column-header', '.column2', '.DOPTS-admin').html(HeaderHTML.join(''));
            doptsSettingsForm(json, 2);

            doptsResize();
            doptsToggleMessage('hide', DOPTS_SCROLLER_LOADED);
        });
    }
}

function doptsShowScrollerInfo(){// Show scroller settings.
    if (clearClick){
        $jDOPTS('li', '.column2', '.DOPTS-admin').removeClass('item-image-selected');
        doptsRemoveColumns(3);
        doptsToggleMessage('show', DOPTS_LOAD);
        
        $jDOPTS.post(ajaxurl, {action: 'dopts_show_scroller_info', scroller_id:$jDOPTS('#scroller_id').val()}, function(data){            
            var HeaderHTML = new Array(),
            json = $jDOPTS.parseJSON(data);
            
            HeaderHTML.push('<input type="button" name="DOPTS_scroller_submit" class="submit-style" onclick="doptsEditScroller()" title="'+DOPTS_EDIT_SCROLLER_SUBMIT+'" value="'+DOPTS_SUBMIT+'" />');
            HeaderHTML.push('<input type="button" name="DOPTS_scroller_delete" class="submit-style" onclick="doptsDeleteScroller('+$jDOPTS('#scroller_id').val()+')" title="'+DOPTS_DELETE_SCROLLER_SUBMIT+'" value="'+DOPTS_DELETE+'" />');
            HeaderHTML.push('<input type="button" name="DOPTS_scroller_delete" class="submit-style" onclick="doptsDefaultScroller()" title="'+DOPTS_DEFAULT+'" value="'+DOPTS_DEFAULT+'" />');
            HeaderHTML.push('<a href="javascript:void()" class="header-help" title="'+DOPTS_SCROLLER_EDIT_INFO_HELP+'"></a>');
            
            $jDOPTS('.column-header', '.column3', '.DOPTS-admin').html(HeaderHTML.join(''));
            doptsSettingsForm(json, 3);
            
            doptsResize();
            doptsToggleMessage('hide', DOPTS_SCROLLER_LOADED);
        });
    }
}

function doptsEditScroller(){// Edit Scroller Settings.
    if (clearClick){
        doptsToggleMessage('show', DOPTS_SAVE);
        
        $jDOPTS.post(ajaxurl, {action: 'dopts_edit_scroller',
                               scroller_id: $jDOPTS('#scroller_id').val(),
                               name: $jDOPTS('#name').val(),
                               width: $jDOPTS('#width').val(),
                               height: $jDOPTS('#height').val(),
                               bg_color: $jDOPTS('#bg_color').val(),
                               bg_alpha: $jDOPTS('#bg_alpha').val(),
                               bg_border_size: $jDOPTS('#bg_border_size').val(),
                               bg_border_color: $jDOPTS('#bg_border_color').val(),
                               thumbnails_order: $jDOPTS('#thumbnails_order').val(),
                               responsive_enabled: $jDOPTS('#responsive_enabled').val(),   
                               thumbnails_position: $jDOPTS('#thumbnails_position').val(),
                               thumbnails_bg_color: $jDOPTS('#thumbnails_bg_color').val(),
                               thumbnails_bg_alpha: $jDOPTS('#thumbnails_bg_alpha').val(),
                               thumbnails_border_size: $jDOPTS('#thumbnails_border_size').val(),
                               thumbnails_border_color: $jDOPTS('#thumbnails_border_color').val(),
                               thumbnails_spacing: $jDOPTS('#thumbnails_spacing').val(),
                               thumbnails_margin_top: $jDOPTS('#thumbnails_margin_top').val(),
                               thumbnails_margin_right: $jDOPTS('#thumbnails_margin_right').val(),
                               thumbnails_margin_bottom: $jDOPTS('#thumbnails_margin_bottom').val(),
                               thumbnails_margin_left: $jDOPTS('#thumbnails_margin_left').val(),
                               thumbnails_padding_top: $jDOPTS('#thumbnails_padding_top').val(),
                               thumbnails_padding_right: $jDOPTS('#thumbnails_padding_right').val(),
                               thumbnails_padding_bottom: $jDOPTS('#thumbnails_padding_bottom').val(),
                               thumbnails_padding_left: $jDOPTS('#thumbnails_padding_left').val(),
                               thumbnails_info: $jDOPTS('#thumbnails_info').val(),    
                               thumbnails_navigation_easing: $jDOPTS('#thumbnails_navigation_easing').val(),
                               thumbnails_navigation_loop: $jDOPTS('#thumbnails_navigation_loop').val(),
                               thumbnails_navigation_mouse_enabled: $jDOPTS('#thumbnails_navigation_mouse_enabled').val(),
                               thumbnails_navigation_scroll_enabled: $jDOPTS('#thumbnails_navigation_scroll_enabled').val(),
                               thumbnails_scroll_position: $jDOPTS('#thumbnails_scroll_position').val(),
                               thumbnails_scroll_size: $jDOPTS('#thumbnails_scroll_size').val(),
                               thumbnails_scroll_scrub_color: $jDOPTS('#thumbnails_scroll_scrub_color').val(),
                               thumbnails_scroll_bar_color: $jDOPTS('#thumbnails_scroll_bar_color').val(),
                               thumbnails_navigation_arrows_enabled: $jDOPTS('#thumbnails_navigation_arrows_enabled').val(),
                               thumbnails_navigation_arrows_no_items_slide: $jDOPTS('#thumbnails_navigation_arrows_no_items_slide').val(),
                               thumbnails_navigation_arrows_speed: $jDOPTS('#thumbnails_navigation_arrows_speed').val(),
                               thumbnail_width: $jDOPTS('#thumbnail_width').val(),
                               thumbnail_height: $jDOPTS('#thumbnail_height').val(),
                               thumbnail_alpha: $jDOPTS('#thumbnail_alpha').val(),
                               thumbnail_alpha_hover: $jDOPTS('#thumbnail_alpha_hover').val(),
                               thumbnail_bg_color: $jDOPTS('#thumbnail_bg_color').val(),
                               thumbnail_bg_color_hover: $jDOPTS('#thumbnail_bg_color_hover').val(),
                               thumbnail_border_size: $jDOPTS('#thumbnail_border_size').val(),
                               thumbnail_border_color: $jDOPTS('#thumbnail_border_color').val(),
                               thumbnail_border_color_hover: $jDOPTS('#thumbnail_border_color_hover').val(),
                               thumbnail_padding_top: $jDOPTS('#thumbnail_padding_top').val(),
                               thumbnail_padding_right: $jDOPTS('#thumbnail_padding_right').val(),
                               thumbnail_padding_bottom: $jDOPTS('#thumbnail_padding_bottom').val(),
                               thumbnail_padding_left: $jDOPTS('#thumbnail_padding_left').val(),
                               lightbox_enabled: $jDOPTS('#lightbox_enabled').val(),
                               lightbox_display_time: $jDOPTS('#lightbox_display_time').val(),
                               lightbox_window_color: $jDOPTS('#lightbox_window_color').val(),
                               lightbox_window_alpha: $jDOPTS('#lightbox_window_alpha').val(),
                               lightbox_bg_color: $jDOPTS('#lightbox_bg_color').val(),
                               lightbox_bg_alpha: $jDOPTS('#lightbox_bg_alpha').val(),
                               lightbox_border_size: $jDOPTS('#lightbox_border_size').val(),
                               lightbox_border_color: $jDOPTS('#lightbox_border_color').val(),
                               lightbox_caption_text_color: $jDOPTS('#lightbox_caption_text_color').val(),
                               lightbox_margin_top: $jDOPTS('#lightbox_margin_top').val(),
                               lightbox_margin_right: $jDOPTS('#lightbox_margin_right').val(),
                               lightbox_margin_bottom: $jDOPTS('#lightbox_margin_bottom').val(),
                               lightbox_margin_left: $jDOPTS('#lightbox_margin_left').val(),
                               lightbox_padding_top: $jDOPTS('#lightbox_padding_top').val(),
                               lightbox_padding_right: $jDOPTS('#lightbox_padding_right').val(),
                               lightbox_padding_bottom: $jDOPTS('#lightbox_padding_bottom').val(),
                               lightbox_padding_left: $jDOPTS('#lightbox_padding_left').val(),
                               lightbox_navigation_info_bg_color: $jDOPTS('#lightbox_navigation_info_bg_color').val(),
                               lightbox_navigation_info_text_color: $jDOPTS('#lightbox_navigation_info_text_color').val(),
                               lightbox_navigation_display_time: $jDOPTS('#lightbox_navigation_display_time').val(),
                               lightbox_navigation_touch_device_swipe_enabled: $jDOPTS('#lightbox_navigation_touch_device_swipe_enabled').val(),
                               tooltip_bg_color: $jDOPTS('#tooltip_bg_color').val(),
                               tooltip_stroke_color: $jDOPTS('#tooltip_stroke_color').val(),
                               tooltip_text_color: $jDOPTS('#tooltip_text_color').val(),
                               label_position: $jDOPTS('#label_position').val(),              
                               label_always_visible: $jDOPTS('#label_always_visible').val(),
                               label_bg_color: $jDOPTS('#label_bg_color').val(),
                               label_bg_alpha: $jDOPTS('#label_bg_alpha').val(),
                               label_text_color: $jDOPTS('#label_text_color').val(),
                               slideshow_enabled: $jDOPTS('#slideshow_enabled').val(),
                               slideshow_time: $jDOPTS('#slideshow_time').val(),
                               slideshow_loop: $jDOPTS('#slideshow_loop').val()}, function(data){
            if ($jDOPTS('#scroller_id').val() != '0'){
                $jDOPTS('.name', '#DOPTS-ID-'+$jDOPTS('#scroller_id').val()).html($jDOPTS('#name').val());
                doptsToggleMessage('hide', DOPTS_EDIT_SCROLLER_SUCCESS);
            }
            else{
                doptsToggleMessage('hide', DOPTS_EDIT_SCROLLERS_SUCCESS);
            }
        });
    }
}

function doptsDefaultScroller(){// Add default settings to scroller.
    if (clearClick){
        if (confirm(DOPTS_EDIT_SCROLLER_USE_DEFAULT_CONFIRMATION)){
            doptsToggleMessage('show', DOPTS_SAVE);
            
            $jDOPTS.post(ajaxurl, {action: 'dopts_show_scroller_info', scroller_id:0}, function(data){
                data = $jDOPTS.parseJSON(data);
                
                $jDOPTS('#width').val(data['Width']);
                $jDOPTS('#height').val(data['Height']);
                $jDOPTS('#bg_color').val(data['BgColor']);
                $jDOPTS('#bg_alpha').val(data['BgAlpha']);
                $jDOPTS('#bg_border_size').val(data['BgBorderSize']);
                $jDOPTS('#bg_border_color').val(data['BgBorderColor']);
                $jDOPTS('#thumbnails_order').val(data['ThumbnailsOrder']);
                $jDOPTS('#responsive_enabled').val(data['ResponsiveEnabled']);
                
                $jDOPTS('#thumbnails_position').val(data['ThumbnailsPosition']);
                $jDOPTS('#thumbnails_bg_color').val(data['ThumbnailsBgColor']);
                $jDOPTS('#thumbnails_bg_alpha').val(data['ThumbnailsBgAlpha']);
                $jDOPTS('#thumbnails_border_size').val(data['ThumbnailsBorderSize']),
                $jDOPTS('#thumbnails_border_color').val(data['ThumbnailsBorderColor']),
                $jDOPTS('#thumbnails_spacing').val(data['ThumbnailsSpacing']);
                $jDOPTS('#thumbnails_margin_top').val(data['ThumbnailsMarginTop']);
                $jDOPTS('#thumbnails_margin_right').val(data['ThumbnailsMarginRight']);
                $jDOPTS('#thumbnails_margin_bottom').val(data['ThumbnailsMarginBottom']);
                $jDOPTS('#thumbnails_margin_left').val(data['ThumbnailsMarginLeft']);
                $jDOPTS('#thumbnails_padding_top').val(data['ThumbnailsPaddingTop']);
                $jDOPTS('#thumbnails_padding_right').val(data['ThumbnailsPaddingRight']);
                $jDOPTS('#thumbnails_padding_bottom').val(data['ThumbnailsPaddingBottom']);
                $jDOPTS('#thumbnails_padding_left').val(data['ThumbnailsPaddingLeft']); 
                $jDOPTS('#thumbnails_info').val(data['ThumbnailsInfo']),    
                $jDOPTS('#thumbnails_navigation_easing').val(data['ThumbnailsNavigationEasing']),
                $jDOPTS('#thumbnails_navigation_loop').val(data['ThumbnailsNavigationLoop']),
                $jDOPTS('#thumbnails_navigation_mouse_enabled').val(data['ThumbnailsNavigationMouseEnabled']),
                $jDOPTS('#thumbnails_navigation_scroll_enabled').val(data['ThumbnailsNavigationScrollEnabled']),
                $jDOPTS('#thumbnails_scroll_position').val(data['ThumbnailsScrollPosition']),
                $jDOPTS('#thumbnails_scroll_size').val(data['ThumbnailsScrollSize']),
                $jDOPTS('#thumbnails_scroll_scrub_color').val(data['ThumbnailsScrollScrubColor']),
                $jDOPTS('#thumbnails_scroll_bar_color').val(data['ThumbnailsScrollBarColor']),
                $jDOPTS('#thumbnails_navigation_arrows_enabled').val(data['ThumbnailsNavigationArrowsEnabled']),
                $jDOPTS('#thumbnails_navigation_arrows_no_items_slide').val(data['ThumbnailsNavigationArrowsNoItemsSlide']),
                $jDOPTS('#thumbnails_navigation_arrows_speed').val(data['ThumbnailsNavigationArrowsSpeed']),
                
                $jDOPTS('#thumbnails_navigation_prev_image').html('<img src="'+DOPTS_URL+data['ThumbnailsNavigationPrev']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#thumbnails_navigation_prev_hover_image').html('<img src="'+DOPTS_URL+data['ThumbnailsNavigationPrevHover']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#thumbnails_navigation_prev_disabled_image').html('<img src="'+DOPTS_URL+data['ThumbnailsNavigationPrevDisabled']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#thumbnails_navigation_next_image').html('<img src="'+DOPTS_URL+data['ThumbnailsNavigationNext']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#thumbnails_navigation_next_hover_image').html('<img src="'+DOPTS_URL+data['ThumbnailsNavigationNextHover']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#thumbnails_navigation_next_disabled_image').html('<img src="'+DOPTS_URL+data['ThumbnailsNavigationNextDisabled']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');  
                
                $jDOPTS('#thumbnail_loader_image').html('<img src="'+DOPTS_URL+data['ThumbnailLoader']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#thumbnail_width').val(data['ThumbnailWidth']);
                $jDOPTS('#thumbnail_height').val(data['ThumbnailHeight']);
                $jDOPTS('#thumbnail_alpha').val(data['ThumbnailAlpha']);
                $jDOPTS('#thumbnail_alpha_hover').val(data['ThumbnailAlphaHover']);
                $jDOPTS('#thumbnail_bg_color').val(data['ThumbnailBgColor']);
                $jDOPTS('#thumbnail_bg_color_hover').val(data['ThumbnailBgColorHover']);
                $jDOPTS('#thumbnail_border_size').val(data['ThumbnailBorderSize']);
                $jDOPTS('#thumbnail_border_color').val(data['ThumbnailBorderColor']);
                $jDOPTS('#thumbnail_border_color_hover').val(data['ThumbnailBorderColorHover']);
                $jDOPTS('#thumbnail_padding_top').val(data['ThumbnailPaddingTop']);
                $jDOPTS('#thumbnail_padding_right').val(data['ThumbnailPaddingRight']);
                $jDOPTS('#thumbnail_padding_bottom').val(data['ThumbnailPaddingBottom']);
                $jDOPTS('#thumbnail_padding_left').val(data['ThumbnailPaddingLeft']);
                
                $jDOPTS('#lightbox_enabled').val(data['LightboxEnabled']);
                $jDOPTS('#lightbox_display_time').val(data['LightboxDisplayTime']),
                $jDOPTS('#lightbox_window_color').val(data['LightboxWindowColor']);
                $jDOPTS('#lightbox_window_alpha').val(data['LightboxWindowAlpha']);
                $jDOPTS('#lightbox_loader_image').html('<img src="'+DOPTS_URL+data['LightboxLoader']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#lightbox_bg_color').val(data['LightboxBgColor']);
                $jDOPTS('#lightbox_bg_alpha').val(data['LightboxBgAlpha']);
                $jDOPTS('#lightbox_border_size').val(data['LightboxBorderSize']);
                $jDOPTS('#lightbox_border_color').val(data['LightboxBorderColor']);
                $jDOPTS('#lightbox_caption_text_color').val(data['LightboxCaptionTextColor']);
                $jDOPTS('#lightbox_margin_top').val(data['LightboxMarginTop']);
                $jDOPTS('#lightbox_margin_right').val(data['LightboxMarginRight']);
                $jDOPTS('#lightbox_margin_bottom').val(data['LightboxMarginBottom']);
                $jDOPTS('#lightbox_margin_left').val(data['LightboxMarginLeft']);
                $jDOPTS('#lightbox_padding_top').val(data['LightboxPaddingTop']);
                $jDOPTS('#lightbox_padding_right').val(data['LightboxPaddingRight']);
                $jDOPTS('#lightbox_padding_bottom').val(data['LightboxPaddingBottom']);
                $jDOPTS('#lightbox_padding_left').val(data['LightboxPaddingLeft']);
                                
                $jDOPTS('#lightbox_navigation_prev_image').html('<img src="'+DOPTS_URL+data['LightboxNavigationPrev']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#lightbox_navigation_prev_hover_image').html('<img src="'+DOPTS_URL+data['LightboxNavigationPrevHover']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#lightbox_navigation_next_image').html('<img src="'+DOPTS_URL+data['LightboxNavigationNext']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#lightbox_navigation_next_hover_image').html('<img src="'+DOPTS_URL+data['LightboxNavigationNextHover']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#lightbox_navigation_close_image').html('<img src="'+DOPTS_URL+data['LightboxNavigationClose']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#lightbox_navigation_close_hover_image').html('<img src="'+DOPTS_URL+data['LightboxNavigationCloseHover']+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                $jDOPTS('#lightbox_navigation_info_bg_color').val(data['LightboxNavigationInfoBgColor']);
                $jDOPTS('#lightbox_navigation_info_text_color').val(data['LightboxNavigationInfoTextColor']);
                $jDOPTS('#lightbox_navigation_touch_device_swipe_enabled').val(data['LightboxNavigationTouchDeviceSwipeEnabled']);   
                $jDOPTS('#lightbox_navigation_info_bg_color').val(data['LightboxNavigationInfoBgColor']);
                $jDOPTS('#lightbox_navigation_info_text_color').val(data['LightboxNavigationInfoTextColor']);
                $jDOPTS('#lightbox_navigation_display_time').val(data['LightboxNavigationDisplayTime']);
                $jDOPTS('#lightbox_navigation_touch_device_swipe_enabled').val(data['LightboxNavigationTouchDeviceSwipeEnabled']); 
                
                $jDOPTS('#tooltip_bg_color').val(data['TooltipBgColor']);
                $jDOPTS('#tooltip_stroke_color').val(data['TooltipStrokeColor']);
                $jDOPTS('#tooltip_text_color').val(data['TooltipTextColor']);
                
                $jDOPTS('#label_position').val(data['LabelPosition']);  
                $jDOPTS('#label_always_visible').val(data['LabelAlwaysVisible']);
                $jDOPTS('#label_bg_color').val(data['LabelBgColor']);
                $jDOPTS('#label_bg_alpha').val(data['LabelBgAlpha']);
                $jDOPTS('#label_text_color').val(data['LabelTextColor']);
                
                $jDOPTS('#slideshow').val(data['Slideshow']);
                $jDOPTS('#slideshow_time').val(data['SlideshowTime']);
                $jDOPTS('#slideshow_autostart').val(data['SlideshowAutostart']);
                $jDOPTS('#slideshow_loop').val(data['SlideshowLoop']);
                
                $jDOPTS.post(ajaxurl, {action: 'dopts_edit_scroller',
                                       scroller_id: $jDOPTS('#scroller_id').val(),
                                       name: $jDOPTS('#name').val(),
                                       width: $jDOPTS('#width').val(),
                                       height: $jDOPTS('#height').val(),
                                       bg_color: $jDOPTS('#bg_color').val(),
                                       bg_alpha: $jDOPTS('#bg_alpha').val(),
                                       bg_border_size: $jDOPTS('#bg_border_size').val(),
                                       bg_border_color: $jDOPTS('#bg_border_color').val(),
                                       thumbnails_order: $jDOPTS('#thumbnails_order').val(),
                                       responsive_enabled: $jDOPTS('#responsive_enabled').val(),   
                                       thumbnails_position: $jDOPTS('#thumbnails_position').val(),
                                       thumbnails_bg_color: $jDOPTS('#thumbnails_bg_color').val(),
                                       thumbnails_bg_alpha: $jDOPTS('#thumbnails_bg_alpha').val(),
                                       thumbnails_border_size: $jDOPTS('#thumbnails_border_size').val(),
                                       thumbnails_border_color: $jDOPTS('#thumbnails_border_color').val(),
                                       thumbnails_spacing: $jDOPTS('#thumbnails_spacing').val(),
                                       thumbnails_margin_top: $jDOPTS('#thumbnails_margin_top').val(),
                                       thumbnails_margin_right: $jDOPTS('#thumbnails_margin_right').val(),
                                       thumbnails_margin_bottom: $jDOPTS('#thumbnails_margin_bottom').val(),
                                       thumbnails_margin_left: $jDOPTS('#thumbnails_margin_left').val(),
                                       thumbnails_padding_top: $jDOPTS('#thumbnails_padding_top').val(),
                                       thumbnails_padding_right: $jDOPTS('#thumbnails_padding_right').val(),
                                       thumbnails_padding_bottom: $jDOPTS('#thumbnails_padding_bottom').val(),
                                       thumbnails_padding_left: $jDOPTS('#thumbnails_padding_left').val(),
                                       thumbnails_info: $jDOPTS('#thumbnails_info').val(),    
                                       thumbnails_navigation_easing: $jDOPTS('#thumbnails_navigation_easing').val(),
                                       thumbnails_navigation_loop: $jDOPTS('#thumbnails_navigation_loop').val(),
                                       thumbnails_navigation_mouse_enabled: $jDOPTS('#thumbnails_navigation_mouse_enabled').val(),
                                       thumbnails_navigation_scroll_enabled: $jDOPTS('#thumbnails_navigation_scroll_enabled').val(),
                                       thumbnails_scroll_position: $jDOPTS('#thumbnails_scroll_position').val(),
                                       thumbnails_scroll_size: $jDOPTS('#thumbnails_scroll_size').val(),
                                       thumbnails_scroll_scrub_color: $jDOPTS('#thumbnails_scroll_scrub_color').val(),
                                       thumbnails_scroll_bar_color: $jDOPTS('#thumbnails_scroll_bar_color').val(),
                                       thumbnails_navigation_arrows_enabled: $jDOPTS('#thumbnails_navigation_arrows_enabled').val(),
                                       thumbnails_navigation_arrows_no_items_slide: $jDOPTS('#thumbnails_navigation_arrows_no_items_slide').val(),
                                       thumbnails_navigation_arrows_speed: $jDOPTS('#thumbnails_navigation_arrows_speed').val(),                               
                                       thumbnails_navigation_prev: data['ThumbnailsNavigationPrev'],
                                       thumbnails_navigation_prev_hover: data['ThumbnailsNavigationPrevHover'],
                                       thumbnails_navigation_prev_disabled: data['ThumbnailsNavigationPrevDisabled'],
                                       thumbnails_navigation_next: data['ThumbnailsNavigationNext'],
                                       thumbnails_navigation_next_hover: data['ThumbnailsNavigationNextHover'],
                                       thumbnails_navigation_next_disabled: data['ThumbnailsNavigationNextDisabled'],
                                       thumbnail_loader: data['ThumbnailLoader'],
                                       thumbnail_width: $jDOPTS('#thumbnail_width').val(),
                                       thumbnail_height: $jDOPTS('#thumbnail_height').val(),
                                       thumbnail_alpha: $jDOPTS('#thumbnail_alpha').val(),
                                       thumbnail_alpha_hover: $jDOPTS('#thumbnail_alpha_hover').val(),
                                       thumbnail_bg_color: $jDOPTS('#thumbnail_bg_color').val(),
                                       thumbnail_bg_color_hover: $jDOPTS('#thumbnail_bg_color_hover').val(),
                                       thumbnail_border_size: $jDOPTS('#thumbnail_border_size').val(),
                                       thumbnail_border_color: $jDOPTS('#thumbnail_border_color').val(),
                                       thumbnail_border_color_hover: $jDOPTS('#thumbnail_border_color_hover').val(),
                                       thumbnail_padding_top: $jDOPTS('#thumbnail_padding_top').val(),
                                       thumbnail_padding_right: $jDOPTS('#thumbnail_padding_right').val(),
                                       thumbnail_padding_bottom: $jDOPTS('#thumbnail_padding_bottom').val(),
                                       thumbnail_padding_left: $jDOPTS('#thumbnail_padding_left').val(),
                                       lightbox_enabled: $jDOPTS('#lightbox_enabled').val(),
                                       lightbox_display_time: $jDOPTS('#lightbox_display_time').val(),
                                       lightbox_window_color: $jDOPTS('#lightbox_window_color').val(),
                                       lightbox_window_alpha: $jDOPTS('#lightbox_window_alpha').val(),
                                       lightbox_loader: data['LightboxLoader'],
                                       lightbox_bg_color: $jDOPTS('#lightbox_bg_color').val(),
                                       lightbox_bg_alpha: $jDOPTS('#lightbox_bg_alpha').val(),
                                       lightbox_border_size: $jDOPTS('#lightbox_border_size').val(),
                                       lightbox_border_color: $jDOPTS('#lightbox_border_color').val(),
                                       lightbox_caption_text_color: $jDOPTS('#lightbox_caption_text_color').val(),
                                       lightbox_margin_top: $jDOPTS('#lightbox_margin_top').val(),
                                       lightbox_margin_right: $jDOPTS('#lightbox_margin_right').val(),
                                       lightbox_margin_bottom: $jDOPTS('#lightbox_margin_bottom').val(),
                                       lightbox_margin_left: $jDOPTS('#lightbox_margin_left').val(),
                                       lightbox_padding_top: $jDOPTS('#lightbox_padding_top').val(),
                                       lightbox_padding_right: $jDOPTS('#lightbox_padding_right').val(),
                                       lightbox_padding_bottom: $jDOPTS('#lightbox_padding_bottom').val(),
                                       lightbox_padding_left: $jDOPTS('#lightbox_padding_left').val(),
                                       lightbox_navigation_prev: data['LightboxNavigationPrev'],
                                       lightbox_navigation_prev_hover: data['LightboxNavigationPrevHover'],
                                       lightbox_navigation_next: data['LightboxNavigationNext'],
                                       lightbox_navigation_next_hover: data['LightboxNavigationNextHover'],
                                       lightbox_navigation_close: data['LightboxNavigationClose'],
                                       lightbox_navigation_close_hover: data['LightboxNavigationCloseHover'],
                                       lightbox_navigation_info_bg_color: $jDOPTS('#lightbox_navigation_info_bg_color').val(),
                                       lightbox_navigation_info_text_color: $jDOPTS('#lightbox_navigation_info_text_color').val(),
                                       lightbox_navigation_display_time: $jDOPTS('#lightbox_navigation_display_time').val(),
                                       lightbox_navigation_touch_device_swipe_enabled: $jDOPTS('#lightbox_navigation_touch_device_swipe_enabled').val(),
                                       tooltip_bg_color: $jDOPTS('#tooltip_bg_color').val(),
                                       tooltip_stroke_color: $jDOPTS('#tooltip_stroke_color').val(),
                                       tooltip_text_color: $jDOPTS('#tooltip_text_color').val(),
                                       label_position: $jDOPTS('#label_position').val(),  
                                       label_always_visible: $jDOPTS('#label_always_visible').val(),
                                       label_bg_color: $jDOPTS('#label_bg_color').val(),
                                       label_bg_alpha: $jDOPTS('#label_bg_alpha').val(),
                                       label_text_color: $jDOPTS('#label_text_color').val(),
                                       slideshow_enabled: $jDOPTS('#slideshow_enabled').val(),
                                       slideshow_time: $jDOPTS('#slideshow_time').val(),
                                       slideshow_loop: $jDOPTS('#slideshow_loop').val()}, function(data){
                    doptsToggleMessage('hide', DOPTS_EDIT_SCROLLER_SUCCESS);
                });
            });
        }
    }
}

function doptsDeleteScroller(id){// Delete scroller
    if (clearClick){
        if (confirm(DOPTS_DELETE_SCROLLER_CONFIRMATION)){
            doptsToggleMessage('show', DOPTS_DELETE_SCROLLER_SUBMITED);
            
            $jDOPTS.post(ajaxurl, {action: 'dopts_delete_scroller', id:id}, function(data){
                doptsRemoveColumns(2);
                $jDOPTS('#DOPTS-ID-'+id).stop(true, true).animate({'opacity':0}, 600, function(){
                    $jDOPTS(this).remove();
                    if (data == '0'){
                        $jDOPTS('.column-content', '.column1', '.DOPTS-admin').html('<ul><li class="no-data">'+DOPTS_NO_SCROLLERS+'</li></ul>');
                    }
                    doptsToggleMessage('hide', DOPTS_DELETE_SCROLLER_SUCCESS);
                });
            });
        }
    }
}

function doptsScrollersEvents(){// Init Scroller Events.
    $jDOPTS('li', '.column1', '.DOPTS-admin').click(function(){
        if (clearClick){
            var id = $jDOPTS(this).attr('id').split('-')[2];
            
            if (currScroller != id){
                currScroller = id;
                $jDOPTS('li', '.column1', '.DOPTS-admin').removeClass('item-selected');
                $jDOPTS(this).addClass('item-selected');
                doptsShowImages(id);
            }
        }
    });
}

function doptsShowImages(scroller_id){// Show Images List.
    if (clearClick){
        $jDOPTS('#scroller_id').val(scroller_id);
        doptsRemoveColumns(2);
        doptsToggleMessage('show', DOPTS_LOAD);
        
        $jDOPTS.post(ajaxurl, {action: 'dopts_show_images', scroller_id:scroller_id}, function(data){
            var HeaderHTML = new Array();
            HeaderHTML.push('<div class="add-button">');
            HeaderHTML.push('    <a href="javascript:doptsAddImages()" title="'+DOPTS_ADD_IMAGE_SUBMIT+'"></a>');
            HeaderHTML.push('</div>');
            HeaderHTML.push('<div class="edit-button">');
            HeaderHTML.push('    <a href="javascript:doptsShowScrollerInfo()" title="'+DOPTS_EDIT_SCROLLER_SUBMIT+'"></a>');
            HeaderHTML.push('</div>');
            HeaderHTML.push('<div class="code-button">');
            HeaderHTML.push('    <a href="javascript:doptsShowScrollerCode()" title="'+DOPTS_EDIT_SCROLLER_CODE+'"></a>');
            HeaderHTML.push('</div>');
            HeaderHTML.push('<a href="javascript:void()" class="header-help" title="'+DOPTS_SCROLLER_EDIT_HELP+'"></a>');
            
            $jDOPTS('.column-header', '.column2', '.DOPTS-admin').html(HeaderHTML.join(''));
            $jDOPTS('.column-content', '.column2', '.DOPTS-admin').html(data);
            $jDOPTS('.column-content', '.column2', '.DOPTS-admin').DOPImageLoader({'LoaderURL': DOPTS_URL+'dopts/libraries/gui/images/image-loader/loader.gif', 'NoImageURL': DOPTS_URL+'dopts/libraries/gui/images/image-loader/no-image.png'});
            doptsImagesEvents();
            doptsToggleMessage('hide', DOPTS_IMAGES_LOADED);
        });
    }
}

function doptsImagesEvents(){// Init Images Events.
    $jDOPTS('li', '.column2', '.DOPTS-admin').click(function(){
        var id = $jDOPTS(this).attr('id').split('-')[3];
        
        if (currImage != id && clearClick){
            $jDOPTS('li', '.column2', '.DOPTS-admin').removeClass('item-image-selected');
            $jDOPTS(this).addClass('item-image-selected');
            doptsShowImage(id);
        }
    });

    $jDOPTS('ul', '.column2').sortable({opacity:0.6, cursor:'move', update:function(){
        if (clearClick){
            var data = new Array();
            
            doptsToggleMessage('show', DOPTS_SORT_IMAGES_SUBMITED);
            $jDOPTS('li', '.column2', '.DOPTS-admin').each(function(){
                data.push($jDOPTS(this).attr('id').split('-')[3]);
            });
                        
            $jDOPTS.post(ajaxurl, {action: 'dopts_sort_images', scroller_id:$jDOPTS('#scroller_id').val(), data:data.join(',')}, function(data){
                doptsRedoImageIDs();
                doptsToggleMessage('hide', DOPTS_SORT_IMAGES_SUCCESS);
            });
        }
    },
    stop:function(){
        $jDOPTS('li', '.column2').removeAttr('style');
    }});
}

function doptsRedoImageIDs(){
    var id = 0;
    
    doptsRemoveColumns(3);
    
    $jDOPTS('.DOPTS-admin .column2 .item-image').each(function(){
        id++;        
        $jDOPTS(this).attr('id', 'DOPTS-image-ID-'+id);
    });
}

function doptsAddImages(){// Add Image/Images.
    if (clearClick){
        $jDOPTS('li', '.column2', '.DOPTS-admin').removeClass('item-image-selected');
        doptsRemoveColumns(3);
        
        var uploadifyHTML = new Array(), HeaderHTML = new Array();
        HeaderHTML.push('<a href="javascript:void()" class="header-help" title="'+DOPTS_ADD_IMAGES_HELP+'"></a>');

        uploadifyHTML.push('<h3 class="settings">'+DOPTS_ADD_IMAGE_SIMPLE_UPLOAD+'</h3>');
        uploadifyHTML.push('<form action="'+DOPTS_URL+'dopts/libraries/php/upload.php?path='+DOPTS_ABSOLUTE_PATH+'/dopts/" method="post" enctype="multipart/form-data" id="dopts_ajax_upload_form" name="dopts_ajax_upload_form" target="dopts_upload_target" onsubmit="doptsUploadImage()">');
        uploadifyHTML.push('    <input name="dopts_image" type="file" onchange="$jDOPTS(\'#dopts_ajax_upload_form\').submit(); return false;" style="margin:5px 0 0 10px"; />');
        uploadifyHTML.push('    <a href="javascript:void()" class="header-help" title="'+DOPTS_ADD_IMAGES_HELP_AJAX+'"></a><br class="DOPTS-clear" />');
        uploadifyHTML.push('</form>');
        uploadifyHTML.push('<iframe id="dopts_upload_target" name="dopts_upload_target" src="javascript:void(0)" style="display: none;"></iframe>');
        
        uploadifyHTML.push('<h3 class="settings">'+DOPTS_ADD_IMAGE_MULTIPLE_UPLOAD+'</h3>');
        uploadifyHTML.push('<div class="uploadifyContainer" style="float:left; margin-top:5px;">');
        uploadifyHTML.push('    <div><input type="file" name="uploadify" id="uploadify" style="width:100px;" /></div>');
        uploadifyHTML.push('    <div id="fileQueue"></div>');
        uploadifyHTML.push('</div>');
        uploadifyHTML.push('<a href="javascript:void()" class="header-help" title="'+DOPTS_ADD_IMAGES_HELP_UPLOADIFY+'"></a><br class="DOPTS-clear" />');  
        
        uploadifyHTML.push('<h3 class="settings">'+DOPTS_ADD_IMAGE_FTP_UPLOAD+'</h3>');
        uploadifyHTML.push('<input name="dopts_ftp_image" id="dopts_ftp_image" type="button" value="'+DOPTS_SELECT_FTP_IMAGES+'" class="select-images" />');
        uploadifyHTML.push('<a href="javascript:void()" class="header-help" title="'+DOPTS_ADD_IMAGES_HELP_FTP+'"></a><br class="DOPTS-clear" />');

        $jDOPTS('.column-header', '.column3', '.DOPTS-admin').html(HeaderHTML.join(''));
        $jDOPTS('.column-content', '.column3', '.DOPTS-admin').html(uploadifyHTML.join(''));
        
        // Add Images width Uploadify.
        
        $jDOPTS('#uploadify').uploadify({
            'uploader'       : DOPTS_URL+'dopts/libraries/swf/uploadify.swf',
            'script'         : DOPTS_URL+'dopts/libraries/php/uploadify.php?path='+DOPTS_ABSOLUTE_PATH+'/dopts/',
            'cancelImg'      : DOPTS_URL+'dopts/libraries/gui/images/uploadify/cancel.png',
            'folder'         : '',
            'queueID'        : 'fileQueue',
            'buttonText'     : DOPTS_SELECT_IMAGES,
            'auto'           : true,
            'multi'          : true,
            'onError'        : function (event,ID,fileObj,errorObj){
                                    alert(errorObj.type + ' Error: ' + errorObj.info);
                               },
            'onInit'         : function(){
                                   doptsResize();
                               },
            'onCancel'         : function(event,ID,fileObj,data){
                                   doptsResize();
                               },
            'onSelect'       : function(event, ID, fileObj){
                                   clearClick = false;
                                   doptsToggleMessage('show', DOPTS_ADD_IMAGE_SUBMITED);
                                   setTimeout(function(){
                                       doptsResize();
                                   }, 100);
                               },
            'onComplete'     : function(event, ID, fileObj, response, data){                 
                                   if (response != '-1'){
                                       setTimeout(function(){
                                           doptsResize();
                                       }, 1000);
                                       
                                       $jDOPTS.post(ajaxurl, {action: 'dopts_add_image', scroller_id:$jDOPTS('#scroller_id').val(), name:response}, function(data){
                                           if ($jDOPTS('ul', '.column2', '.DOPTS-admin').html() == '<li class="no-data">'+DOPTS_NO_IMAGES+'</li>'){
                                               $jDOPTS('ul', '.column2', '.DOPTS-admin').html('<li class="item-image" id="DOPTS-image-ID-'+data+'"><img src="'+DOPTS_URL+'dopts/uploads/thumbs/'+response+'" alt="" /></li>');
                                           }
                                           else{
                                               $jDOPTS('ul', '.column2', '.DOPTS-admin').append('<li class="item-image" id="DOPTS-image-ID-'+data+'"><img src="'+DOPTS_URL+'dopts/uploads/thumbs/'+response+'" alt="" /></li>');
                                           }
                                           doptsResize();
                                           
                                           $jDOPTS('#DOPTS-image-ID-'+data).click(function(){
                                               var id = $jDOPTS(this).attr('id').split('-')[3];
                                               
                                               if (currImage != id && clearClick){
                                                   $jDOPTS('li', '.column2', '.DOPTS-admin').removeClass('item-image-selected');
                                                   $jDOPTS(this).addClass('item-image-selected');
                                                   doptsShowImage(id);
                                               }
                                           });
                                           $jDOPTS('#DOPTS-image-ID-'+data).DOPImageLoader({'LoaderURL': DOPTS_URL+'libraries/gui/images/image-loader/loader.gif', 'NoImageURL': DOPTS_URL+'dopts/libraries/gui/images/image-loader/no-image.png'});
                                       });
                                   }
                               },
            'onAllComplete'  : function(event, data){
                                   doptsToggleMessage('hide', DOPTS_ADD_IMAGE_SUCCESS);
                               }
        });
        
        // Add Images from FTP.
                
        $jDOPTS('#dopts_ftp_image').click(function(){
            if (clearClick){
                doptsToggleMessage('show', DOPTS_ADD_IMAGE_SUBMITED);

                $jDOPTS.post(ajaxurl, {action: 'dopts_add_image_ftp', scroller_id:$jDOPTS('#scroller_id').val()}, function(data){
                    var images = data.split(';;;;;'), 
                    i, imageName, imageID;
                    
                    for (i=0; i<images.length; i++){
                        imageID = images[i].split(';;;')[0];
                        imageName = images[i].split(';;;')[1];

                        if ($jDOPTS('ul', '.column2', '.DOPTS-admin').html() == '<li class="no-data">'+DOPTS_NO_IMAGES+'</li>'){
                            $jDOPTS('ul', '.column2', '.DOPTS-admin').html('<li class="item-image" id="DOPTS-image-ID-'+imageID+'"><img src="'+DOPTS_URL+'dopts/uploads/thumbs/'+imageName+'" alt="" /></li>');
                        }
                        else{
                            $jDOPTS('ul', '.column2', '.DOPTS-admin').append('<li class="item-image" id="DOPTS-image-ID-'+imageID+'"><img src="'+DOPTS_URL+'dopts/uploads/thumbs/'+imageName+'" alt="" /></li>');
                        }

                        doptsResize();

                        $jDOPTS('#DOPTS-image-ID-'+imageID).click(function(){
                            var id = $jDOPTS(this).attr('id').split('-')[3];

                            if (currImage != id && clearClick){
                                $jDOPTS('li', '.column2', '.DOPTS-admin').removeClass('item-image-selected');
                                $jDOPTS(this).addClass('item-image-selected');
                                doptsShowImage(id);
                            }
                        });

                        $jDOPTS('#DOPTS-image-ID-'+imageID).DOPImageLoader({'LoaderURL': DOPTS_URL+'libraries/gui/images/image-loader/loader.gif', 'NoImageURL': DOPTS_URL+'dopts/libraries/gui/images/image-loader/no-image.png'});
                    }

                    doptsToggleMessage('hide', DOPTS_ADD_IMAGE_SUCCESS);
                });            
            }
        });

        doptsResize();
    }
}

function doptsUploadImage(){
    doptsToggleMessage('show', DOPTS_ADD_IMAGE_SUBMITED);
}

function doptsUploadImageSuccess(response, data){
    if (response != '-1'){
        setTimeout(function(){
            doptsResize();
        }, 1000);

        $jDOPTS.post(ajaxurl, {action: 'dopts_add_image', scroller_id:$jDOPTS('#scroller_id').val(), name:response}, function(data){
            if ($jDOPTS('ul', '.column2', '.DOPTS-admin').html() == '<li class="no-data">'+DOPTS_NO_IMAGES+'</li>'){
                $jDOPTS('ul', '.column2', '.DOPTS-admin').html('<li class="item-image" id="DOPTS-image-ID-'+data+'"><img src="'+DOPTS_URL+'dopts/uploads/thumbs/'+response+'" alt="" /></li>');
            }
            else{
                $jDOPTS('ul', '.column2', '.DOPTS-admin').append('<li class="item-image" id="DOPTS-image-ID-'+data+'"><img src="'+DOPTS_URL+'dopts/uploads/thumbs/'+response+'" alt="" /></li>');
            }
            doptsResize();

            $jDOPTS('#DOPTS-image-ID-'+data).click(function(){
                var id = $jDOPTS(this).attr('id').split('-')[3];
                
                if (currImage != id && clearClick){
                    $jDOPTS('li', '.column2', '.DOPTS-admin').removeClass('item-image-selected');
                    $jDOPTS(this).addClass('item-image-selected');
                    doptsShowImage(id);
                }
            });
            doptsToggleMessage('hide', DOPTS_ADD_IMAGE_SUCCESS);
            $jDOPTS('#DOPTS-image-ID-'+data).DOPImageLoader({'LoaderURL': DOPTS_URL+'dopts/libraries/gui/images/image-loader/loader.gif', 'NoImageURL': DOPTS_URL+'dopts/libraries/gui/images/image-loader/no-image.png'});
        });
    }
}

function doptsShowImage(id){// Show Image Details.
    if (clearClick){
        doptsRemoveColumns(3);
        currImage = id;
        doptsToggleMessage('show', DOPTS_LOAD);
        
        $jDOPTS.post(ajaxurl, {action: 'dopts_show_image', scroller_id: $jDOPTS('#scroller_id').val(), image_id: id}, function(data){          
            var json = $jDOPTS.parseJSON(data),
            HeaderHTML = new Array(), HTML = new Array();
            
            HeaderHTML.push('<input type="button" name="DOPTS_image_submit" class="submit-style" onclick="doptsEditImage('+json['id']+')" title="'+DOPTS_EDIT_IMAGE_SUBMIT+'" value="'+DOPTS_SUBMIT+'" />');
            HeaderHTML.push('<input type="button" name="DOPTS_image_delete" class="submit-style" onclick="doptsDeleteImage('+json['id']+')" title="'+DOPTS_DELETE_IMAGE_SUBMIT+'" value="'+DOPTS_DELETE+'" />');
            HeaderHTML.push('<a href="javascript:void()" class="header-help" title="'+DOPTS_IMAGE_EDIT_HELP+'"></a>');

            HTML.push('<input type="hidden" name="crop_x" id="crop_x" value="0" />');
            HTML.push('<input type="hidden" name="crop_y" id="crop_y" value="0" />');
            HTML.push('<input type="hidden" name="crop_width" id="crop_width" value="0" />');
            HTML.push('<input type="hidden" name="crop_height" id="crop_height" value="0" />');
            HTML.push('<input type="hidden" name="image_width" id="image_width" value="0" />');
            HTML.push('<input type="hidden" name="image_height" id="image_height" value="0" />');
            HTML.push('<input type="hidden" name="thumb_width" id="thumb_width" value="'+json['thumbnail_width']+'" />');
            HTML.push('<input type="hidden" name="thumb_height" id="thumb_height" value="'+json['thumbnail_height']+'" />');
            HTML.push('<div class="column-image">');
            HTML.push('    <img src="'+DOPTS_URL+json['image']+'" alt="" />');
            HTML.push('</div>');
            HTML.push('<div class="column-thumbnail-left">');
            HTML.push('    <label class="label">'+DOPTS_EDIT_IMAGE_CROP_THUMBNAIL+'</label>');
            HTML.push('    <div class="column-thumbnail" style="width:'+json['thumbnail_width']+'px; height:'+json['thumbnail_height']+'px;">');
            HTML.push('        <img src="'+DOPTS_URL+json['image']+'" style="width:'+json['thumbnail_width']+'px; height:'+json['thumbnail_height']+'px;" alt="" />');
            HTML.push('    </div>');
            HTML.push('</div>');
            HTML.push('<div class="column-thumbnail-right">');
            HTML.push('    <label class="label">'+DOPTS_EDIT_IMAGE_CURRENT_THUMBNAIL+'</label>');
            HTML.push('    <div class="column-thumbnail" id="DOPTS-curr-thumb" style="float: right; width:'+json['thumbnail_width']+'px; height:'+json['thumbnail_height']+'px;">');
            HTML.push('        <img src="'+DOPTS_URL+json['thumb']+'?cacheBuster='+doptsRandomString(64)+'" style="width:'+json['thumbnail_width']+'px; height:'+json['thumbnail_height']+'px;" alt="" />');
            HTML.push('    </div>');
            HTML.push('</div>');
            HTML.push('<br class="DOPTS-clear" />');
            HTML.push('<label class="label" for="image_title">'+DOPTS_EDIT_IMAGE_TITLE+'</label>');
            HTML.push('<input type="text" class="column-input" name="image_title" id="image_title" value="'+json['title']+'" />');
            HTML.push('<label class="label" for="image_caption">'+DOPTS_EDIT_IMAGE_CAPTION+'</label>');
            HTML.push('<textarea class="column-input" name="image_caption" id="image_caption" cols="" rows="6">'+json['caption']+'</textarea>');
            HTML.push('<label class="label" for="image_video">'+DOPTS_EDIT_IMAGE_MEDIA+'</label>');
            HTML.push('<textarea class="column-input" name="image_media" id="image_media" cols="" rows="6">'+json['media']+'</textarea>');
            HTML.push('<label class="label" for="image_video">'+DOPTS_EDIT_IMAGE_LIGHTBOX_MEDIA+'</label>');
            HTML.push('<textarea class="column-input" name="image_lightbox_media" id="image_lightbox_media" cols="" rows="6">'+json['lightbox_media']+'</textarea>');
            HTML.push('<label class="label" for="image_link">'+DOPTS_EDIT_IMAGE_LINK+'</label>');
            HTML.push('<input type="text" class="column-input" name="image_link" id="image_link" value="'+json['link']+'" />');
            HTML.push('<label class="label" for="image_target">'+DOPTS_EDIT_IMAGE_LINK_TARGET+'</label>');
            HTML.push('<select class="column-select" name="image_target" id="image_target">');
            if (json['target'] == '_self'){
                HTML.push('<option value="_blank">_blank</option>');
                HTML.push('<option value="_self" selected="selected">_self</option>');
                HTML.push('<option value="_parent">_parent</option>');
                HTML.push('<option value="_top">_top</option>');
            }
            else if (json['target'] == '_parent'){
                HTML.push('<option value="_blank">_blank</option>');
                HTML.push('<option value="_self">_self</option>');
                HTML.push('<option value="_parent" selected="selected">_parent</option>');
                HTML.push('<option value="_top">_top</option>');
            }
            else if (json['target'] == '_top'){
                HTML.push('<option value="_blank">_blank</option>');
                HTML.push('<option value="_self">_self</option>');
                HTML.push('<option value="_parent">_parent</option>');
                HTML.push('<option value="_top" selected="selected">_top</option>');
            }
            else{
                HTML.push('<option value="_blank" selected="selected">_blank</option>');
                HTML.push('<option value="_self">_self</option>');
                HTML.push('<option value="_parent">_parent</option>');
                HTML.push('<option value="_top">_top</option>');
            }
            HTML.push('</select>');
            HTML.push('<label class="label" for="image_enabled">'+DOPTS_EDIT_IMAGE_ENABLED+'</label>');
            HTML.push('<select class="column-select" name="image_enabled" id="image_enabled">');
            if (json['enabled'] == 'true'){
                HTML.push('<option value="true" selected="selected">true</option>');
                HTML.push('<option value="false">false</option>');
            }
            else{
                HTML.push('<option value="true">true</option>');
                HTML.push('<option value="false" selected="selected">false</option>');
            }
            HTML.push('</select>');

            $jDOPTS('.column-header', '.column3', '.DOPTS-admin').html(HeaderHTML.join(''));
            $jDOPTS('.column-content', '.column3', '.DOPTS-admin').html(HTML.join(''));
            doptsResize();
            $jDOPTS('.column-image', '.DOPTS-admin').DOPImageLoader({'LoaderURL': DOPTS_URL+'dopts/libraries/gui/images/image-loader/loader.gif', 'NoImageURL': DOPTS_URL+'dopts/libraries/gui/images/image-loader/no-image.png', 'SuccessCallback': 'doptsInitJcrop()'});
            
            doptsToggleMessage('hide', DOPTS_IMAGE_LOADED);
        });
    }
}

function doptsInitJcrop(){// Init Jcrop. (For croping thumbnails)
    imageDisplay = true;
    imageWidth = $jDOPTS('img', '.column-image', '.DOPTS-admin').width();
    imageHeight = $jDOPTS('img', '.column-image', '.DOPTS-admin').height();
    doptsResize();
    $jDOPTS('img', '.column-image', '.DOPTS-admin').Jcrop({onChange: doptsShowCropPreview, onSelect: doptsShowCropPreview, aspectRatio: $jDOPTS('.column-thumbnail', '.DOPTS-admin').width()/$jDOPTS('.column-thumbnail', '.DOPTS-admin').height(), minSize: [$jDOPTS('.column-thumbnail', '.DOPTS-admin').width(), $jDOPTS('.column-thumbnail', '.DOPTS-admin').height()]});
    doptsResize();        
    setTimeout(function(){        
        doptsResize();        
    }, 100);
}

function doptsShowCropPreview(coords){// Select thumbnail with Jcrop.
    if (parseInt(coords.w) > 0){
        $jDOPTS('#crop_x').val(coords.x);
        $jDOPTS('#crop_y').val(coords.y);
        $jDOPTS('#crop_width').val(coords.w);
        $jDOPTS('#crop_height').val(coords.h);
        $jDOPTS('#image_width').val($jDOPTS('img', '.column-image', '.DOPTS-admin').width());
        $jDOPTS('#image_height').val($jDOPTS('img', '.column-image', '.DOPTS-admin').height());

        var rx = $jDOPTS('.column-thumbnail', '.DOPTS-admin').width()/coords.w;
        var ry = $jDOPTS('.column-thumbnail', '.DOPTS-admin').height()/coords.h;

        $jDOPTS('img', '.column-thumbnail-left', '.DOPTS-admin').css({
            width: Math.round(rx*$jDOPTS('img', '.column-image', '.DOPTS-admin').width()) + 'px',
            height: Math.round(ry*$jDOPTS('img', '.column-image', '.DOPTS-admin').height()) + 'px',
            marginLeft: '-'+Math.round(rx * coords.x)+'px',
            marginTop: '-'+Math.round(ry * coords.y)+'px'
        });
    }
}

function doptsEditImage(id){// Edit Image Details.
    if (clearClick){
        doptsToggleMessage('show', DOPTS_SAVE);
        
        $jDOPTS.post(ajaxurl, {action: 'dopts_edit_image',
                               scroller_id: $jDOPTS('#scroller_id').val(),
                               image_id: id,
                               crop_x: $jDOPTS('#crop_x').val(),
                               crop_y: $jDOPTS('#crop_y').val(),
                               crop_width: $jDOPTS('#crop_width').val(),
                               crop_height: $jDOPTS('#crop_height').val(),
                               image_width: $jDOPTS('#image_width').val(),
                               image_height: $jDOPTS('#image_height').val(),
                               image_name: $jDOPTS('#image_name').val(),
                               thumb_width: $jDOPTS('#thumb_width').val(),
                               thumb_height: $jDOPTS('#thumb_height').val(),
                               image_title: $jDOPTS('#image_title').val(),
                               image_caption: $jDOPTS('#image_caption').val(),
                               image_media: $jDOPTS('#image_media').val(),
                               image_lightbox_media: $jDOPTS('#image_lightbox_media').val(),
                               image_link: $jDOPTS('#image_link').val(),
                               image_target: $jDOPTS('#image_target').val(),
                               image_enabled: $jDOPTS('#image_enabled').val()}, function(data){
            doptsToggleMessage('hide', DOPTS_EDIT_IMAGE_SUCCESS);
            if ($jDOPTS('#image_enabled').val() == 'true'){
                $jDOPTS('#DOPTS-image-ID-'+id).removeClass('item-image-disabled');
            }
            else{
                $jDOPTS('#DOPTS-image-ID-'+id).addClass('item-image-disabled');
            }
            
            if (data != ''){
                $jDOPTS('#DOPTS-curr-thumb').html('<img src="'+data+'?cacheBuster='+doptsRandomString(64)+'" style="width:'+$jDOPTS('#thumb_width').val()+'px; height:'+$jDOPTS('#thumb_height').val()+'px;" alt="" />');
            }
        });
    }
}

function doptsDeleteImage(id){// Delete Image.
    if (clearClick){
        if (confirm(DOPTS_DELETE_IMAGE_CONFIRMATION)){
            doptsToggleMessage('show', DOPTS_DELETE_IMAGE_SUBMITED);
            $jDOPTS.post(ajaxurl, {action: 'dopts_delete_image',
                                   scroller_id: $jDOPTS('#scroller_id').val(),
                                   image_id: id}, function(data){
                doptsRemoveColumns(3);
                $jDOPTS('#DOPTS-image-ID-'+id).stop(true, true).animate({'opacity':0}, 600, function(){
                    $jDOPTS(this).remove();
                    doptsToggleMessage('hide', DOPTS_DELETE_SCROLLER_SUCCESS);
                    
                    if (data == '0'){
                        $jDOPTS('.column-content', '.column2', '.DOPTS-admin').html('<ul><li class="no-data">'+DOPTS_NO_IMAGES+'</li></ul>');
                    }
                    else{
                        doptsRedoImageIDs();
                    }
                });
            });
        }
    }
}

function doptsRemoveColumns(no){// Clear columns content.
    if (no <= 2){
        $jDOPTS('.column-header', '.column2', '.DOPTS-admin').html('');
        $jDOPTS('.column-content', '.column2', '.DOPTS-admin').html('');
    }
    if (no <= 3){
        $jDOPTS('.column-header', '.column3', '.DOPTS-admin').html('');
        $jDOPTS('.column-content', '.column3', '.DOPTS-admin').html('');
        imageDisplay = false;
        currImage = 0;
        doptsResize();
    }
}

function doptsToggleMessage(action, message){// Display Info Messages.
    doptsResize();
    
    if (action == 'show'){
        clearClick = false;
        $jDOPTS('#DOPTS-admin-message').addClass('loader');
        $jDOPTS('#DOPTS-admin-message').html(message);
        $jDOPTS('#DOPTS-admin-message').stop(true, true).animate({'opacity':1}, 600);
    }
    else{
        clearClick = true;
        $jDOPTS('#DOPTS-admin-message').removeClass('loader');
        $jDOPTS('#DOPTS-admin-message').html(message);
        setTimeout(function(){
            $jDOPTS('#DOPTS-admin-message').stop(true, true).animate({'opacity':0}, 600, function(){
                $jDOPTS('#DOPTS-admin-message').html('');
            });
        }, 2000);
    }
}

function doptsRandomString(string_length){// Create a string with random elements
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz",
    random_string = '';

    for (var i=0; i<string_length; i++){
        var rnum = Math.floor(Math.random()*chars.length);
        random_string += chars.substring(rnum,rnum+1);
    }
    return random_string;
}

function doptsShowScrollerCode(){// Show Image Details.
    if (clearClick){
        doptsRemoveColumns(3);
  
        var HeaderHTML = new Array(), HTML = new Array();

        HeaderHTML.push('<input type="button" name="DOPTS_image_submit" class="submit-style" onclick="doptsGenerateScrollerCode()" title="'+DOPTS_EDIT_SCROLLER_CODE+'" value="'+DOPTS_EDIT_SCROLLER_CODE+'" />');
        HeaderHTML.push('<a href="javascript:void()" class="header-help" title="'+DOPTS_EDIT_SCROLLER_CODE_HELP+'"></a>');
                    
        HTML.push('<div class="setting-box">');
        HTML.push('    <input type="checkbox" name="jquery_file" id="jquery_file" checked="checked" /><label for="jquery_file" style="width:auto;">'+DOPTS_EDIT_SCROLLER_CODE_INCLUDE_JQUERY+'</label>');
        HTML.push('<br class="DOPTS-clear"></div>');
        HTML.push('<div class="setting-box">');
        HTML.push('    <input type="checkbox" name="jquery_ui_file" id="jquery_ui_file" checked="checked" /><label for="scroll_pane_file" style="width:auto;">'+DOPTS_EDIT_SCROLLER_CODE_INCLUDE_JQUERY_UI+'</label>');
        HTML.push('<br class="DOPTS-clear"></div>');
        HTML.push('<div class="setting-box">');
        HTML.push('    <input type="checkbox" name="scroller_file" id="scroller_file" checked="checked" /><label for="scroller_file" style="width:auto;">'+DOPTS_EDIT_SCROLLER_CODE_INCLUDE_SCROLLER+'</label>');
        HTML.push('<br class="DOPTS-clear"></div>');
        HTML.push('<div class="setting-box">');
        HTML.push('    <input type="checkbox" name="scroller_embed" id="scroller_embed" /><label for="scroller_embed" style="width:auto;">'+DOPTG_EDIT_SCROLLER_CODE_SCROLLER_EMBED+'</label>');
        HTML.push('<br class="DOPTG-clear"></div>');
        HTML.push('<label class="label" for="image_video">'+DOPTS_EDIT_SCROLLER_CODE_COPY+'</label>');
        HTML.push('<textarea class="column-input" name="code_area" id="code_area" cols="" rows="6"></textarea>');
        HTML.push('<label class="label" for="image_video">'+DOPTS_EDIT_SCROLLER_CODE_LINK+'</label>');
        HTML.push('<input type="text" class="column-input" name="scroller_link" id="scroller_link" value="'+DOPTS_URL+'dopts/?scroller_id='+$jDOPTS('#scroller_id').val()+'" />');
        
        $jDOPTS('.column-header', '.column3', '.DOPTS-admin').html(HeaderHTML.join(''));
        $jDOPTS('.column-content', '.column3', '.DOPTS-admin').html(HTML.join(''));
        doptsResize();
    }
}

function doptsGenerateScrollerCode(){
    var CODE = new Array(),
    htmlCODE = new Array();
    
    if ($jDOPTS('#jquery_file').prop('checked')){
        CODE.push('<script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>\n');
    }
    if ($jDOPTS('#jquery_ui_file').prop('checked')){
        CODE.push('<script type="text/JavaScript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>\n');
    }
    if ($jDOPTS('#scroller_file').prop('checked')){    
        CODE.push('<link rel="stylesheet" type="text/css" href="'+DOPTS_URL+'dopts/assets/gui/css/jquery.dop.ThumbnailScroller.css" />\n');
        CODE.push('<script type="text/JavaScript" src="'+DOPTS_URL+'dopts/assets/js/jquery.dop.ThumbnailScroller.js"></script>\n');
    }
    
    if ($jDOPTS('#scroller_embed').prop('checked')){  
        $jDOPTS.getJSON(doptsACAOBuster(DOPTS_URL+'dopts/data/settings'+$jDOPTS('#scroller_id').val()+'.json'), {}, function(data){
            htmlCODE.push('    <ul class="Settings" style="display:none;">\n');
            htmlCODE.push('        <li class="Width">'+(parseInt(data['Width']))+'</li>\n');
            htmlCODE.push('        <li class="Height">'+(parseInt(data['Height']))+'</li>\n');
            htmlCODE.push('        <li class="BgColor">'+(data['BgColor'] || 'ffffff')+'</li>\n');
            htmlCODE.push('        <li class="BgAlpha">'+(parseInt(data['BgAlpha']))+'</li>\n');
            htmlCODE.push('        <li class="BgBorderSize">'+(parseInt(data['BgBorderSize']))+'</li>\n');
            htmlCODE.push('        <li class="BgBorderColor">'+(data['BgBorderColor'] || 'e0e0e0')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsOrder">'+(data['ThumbnailsOrder'] || 'random')+'</li>\n');
            htmlCODE.push('        <li class="ResponsiveEnabled">'+(data['ResponsiveEnabled'] || 'true')+'</li>\n');

            htmlCODE.push('        <li class="ThumbnailsPosition">'+(data['ThumbnailsPosition'] || 'horizontal')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsBgColor">'+(data['ThumbnailsBgColor'] || 'ffffff')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsBgAlpha">'+(parseInt(data['ThumbnailsBgAlpha']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsBorderSize">'+(parseInt(data['ThumbnailsBorderSize']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsBorderColor">'+(data['ThumbnailsBorderColor'] || 'e0e0e0')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsSpacing">'+(parseInt(data['ThumbnailsSpacing']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsMarginTop">'+(parseInt(data['ThumbnailsMarginTop']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsMarginRight">'+(parseInt(data['ThumbnailsMarginRight']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsMarginBottom">'+(parseInt(data['ThumbnailsMarginBottom']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsMarginLeft">'+(parseInt(data['ThumbnailsMarginLeft']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsPaddingTop">'+(parseInt(data['ThumbnailsPaddingTop']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsPaddingRight">'+(parseInt(data['ThumbnailsPaddingRight']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsPaddingBottom">'+(parseInt(data['ThumbnailsPaddingBottom']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsPaddingLeft">'+(parseInt(data['ThumbnailsPaddingLeft']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsInfo">'+(data['ThumbnailsInfo'] || 'label')+'</li>\n');

            htmlCODE.push('        <li class="ThumbnailsNavigationEasing">'+(data['ThumbnailsNavigationEasing'] || 'linear')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsNavigationLoop">'+(data['ThumbnailsNavigationLoop'] || 'false')+'</li>\n');

            htmlCODE.push('        <li class="ThumbnailsNavigationMouseEnabled">'+(data['ThumbnailsNavigationMouseEnabled'] || 'false')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsNavigationMouseSpeed">'+(parseInt(data['ThumbnailsNavigationMouseSpeed']))+'</li>\n');

            htmlCODE.push('        <li class="ThumbnailsNavigationScrollEnabled">'+(data['ThumbnailsNavigationScrollEnabled'] || 'false')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsScrollPosition">'+(data['ThumbnailsScrollPosition'] || 'bottom/right')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsScrollSize">'+(parseInt(data['ThumbnailsScrollSize']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsScrollScrubColor">'+(data['ThumbnailsScrollScrubColor'] || '808080')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsScrollBarColor">'+(data['ThumbnailsScrollBarColor'] || 'e0e0e0')+'</li>\n');                   

            htmlCODE.push('        <li class="ThumbnailsNavigationArrowsEnabled">'+(data['ThumbnailsNavigationArrowsEnabled'] || 'true')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsNavigationArrowsNoItemsSlide">'+(parseInt(data['ThumbnailsNavigationArrowsNoItemsSlide']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsNavigationArrowsSpeed">'+(parseInt(data['ThumbnailsNavigationArrowsSpeed']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsNavigationPrev">'+(DOPTS_URL+data['ThumbnailsNavigationPrev'] || DOPTS_URL+'dopts/uploads/settings/thumbnails-navigation-prev/0.png')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsNavigationPrevHover">'+(DOPTS_URL+data['ThumbnailsNavigationPrevHover'] || DOPTS_URL+'dopts/uploads/settings/thumbnails-navigation-prev-hover/0.png')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsNavigationPrevDisabled">'+(DOPTS_URL+data['ThumbnailsNavigationPrevDisabled'] || DOPTS_URL+'dopts/uploads/settings/thumbnails-navigation-prev-disabled/0.png')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsNavigationNext">'+(DOPTS_URL+data['ThumbnailsNavigationNext'] || DOPTS_URL+'dopts/uploads/settings/thumbnails-navigation-next/0.png')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsNavigationNextHover">'+(DOPTS_URL+data['ThumbnailsNavigationNextHover'] || DOPTS_URL+'dopts/uploads/settings/thumbnails-navigation-next-hover/0.png')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailsNavigationNextDisabled">'+(DOPTS_URL+data['ThumbnailsNavigationNextDisabled'] || DOPTS_URL+'dopts/uploads/settings/thumbnails-navigation-next-disabled/0.png')+'</li>\n');

            htmlCODE.push('        <li class="ThumbnailLoader">'+(DOPTS_URL+data['ThumbnailLoader'] || DOPTS_URL+'DOPThumbnailScroller/assets/gui/images/ThumbnailLoader.gif')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailWidth">'+(parseInt(data['ThumbnailWidth']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailHeight">'+(parseInt(data['ThumbnailHeight']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailAlpha">'+(parseInt(data['ThumbnailAlpha']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailAlphaHover">'+(parseInt(data['ThumbnailAlphaHover']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailBgColor">'+(data['ThumbnailBgColor'] || 'f1f1f1')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailBgColorHover">'+(data['ThumbnailBgColorHover'] || 'f1f1f1')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailBorderSize">'+(parseInt(data['ThumbnailBorderSize']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailBorderColor">'+(data['ThumbnailBorderColor'] || 'd0d0d0')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailBorderColorHover">'+(data['ThumbnailBorderColorHover'] || '303030')+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailPaddingTop">'+(parseInt(data['ThumbnailPaddingTop']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailPaddingRight">'+(parseInt(data['ThumbnailPaddingRight']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailPaddingBottom">'+(parseInt(data['ThumbnailPaddingBottom']))+'</li>\n');
            htmlCODE.push('        <li class="ThumbnailPaddingLeft">'+(parseInt(data['ThumbnailPaddingLeft']))+'</li>\n');

            htmlCODE.push('        <li class="LightboxEnabled">'+(data['LightboxEnabled'] || 'true')+'</li>\n');
            htmlCODE.push('        <li class="LightboxDisplayTime">'+(parseInt(data['LightboxDisplayTime']))+'</li>\n');
            htmlCODE.push('        <li class="LightboxWindowColor">'+(data['LightboxWindowColor'] || 'ffffff')+'</li>\n');
            htmlCODE.push('        <li class="LightboxWindowAlpha">'+(parseInt(data['LightboxWindowAlpha']))+'</li>\n');
            htmlCODE.push('        <li class="LightboxLoader">'+(DOPTS_URL+data['LightboxLoader'] || DOPTS_URL+'dopts/uploads/settings/lightbox-loader/0.gif')+'</li>\n');
            htmlCODE.push('        <li class="LightboxBgColor">'+(data['LightboxBgColor'] || 'ffffff')+'</li>\n');
            htmlCODE.push('        <li class="LightboxBgAlpha">'+(parseInt(data['LightboxBgAlpha']))+'</li>\n');
            htmlCODE.push('        <li class="LightboxBorderSize">'+(parseInt(data['LightboxBorderSize']))+'</li>\n');
            htmlCODE.push('        <li class="LightboxBorderColor">'+(data['LightboxBorderColor'] || 'e0e0e0')+'</li>\n');
            htmlCODE.push('        <li class="LightboxCaptionTextColor">'+(data['LightboxCaptionTextColor'] || '999999')+'</li>\n');
            htmlCODE.push('        <li class="LightboxMarginTop">'+(parseInt(data['LightboxMarginTop']))+'</li>\n');
            htmlCODE.push('        <li class="LightboxMarginRight">'+(parseInt(data['LightboxMarginRight']))+'</li>\n');
            htmlCODE.push('        <li class="LightboxMarginBottom">'+(parseInt(data['LightboxMarginBottom']))+'</li>\n');
            htmlCODE.push('        <li class="LightboxMarginLeft">'+(parseInt(data['LightboxMarginLeft']))+'</li>\n');
            htmlCODE.push('        <li class="LightboxPaddingTop">'+(parseInt(data['LightboxPaddingTop']))+'</li>\n');
            htmlCODE.push('        <li class="LightboxPaddingRight">'+(parseInt(data['LightboxPaddingRight']))+'</li>\n');
            htmlCODE.push('        <li class="LightboxPaddingBottom">'+(parseInt(data['LightboxPaddingBottom']))+'</li>\n');
            htmlCODE.push('        <li class="LightboxPaddingLeft">'+(parseInt(data['LightboxPaddingLeft']))+'</li>\n');

            htmlCODE.push('        <li class="LightboxNavigationPrev">'+(DOPTS_URL+data['LightboxNavigationPrev'] || DOPTS_URL+'dopts/uploads/settings/lightbox-navigation-prev/0.png')+'</li>\n');
            htmlCODE.push('        <li class="LightboxNavigationPrevHover">'+(DOPTS_URL+data['LightboxNavigationPrevHover'] || DOPTS_URL+'dopts/uploads/settings/lightbox-navigation-prev-hover/0.png')+'</li>\n');
            htmlCODE.push('        <li class="LightboxNavigationNext">'+(DOPTS_URL+data['LightboxNavigationNext'] || DOPTS_URL+'dopts/uploads/settings/lightbox-navigation-next/0.png')+'</li>\n');
            htmlCODE.push('        <li class="LightboxNavigationNextHover">'+(DOPTS_URL+data['LightboxNavigationNextHover'] || DOPTS_URL+'dopts/uploads/settings/lightbox-navigation-next-hover/0.png')+'</li>\n');
            htmlCODE.push('        <li class="LightboxNavigationClose">'+(DOPTS_URL+data['LightboxNavigationClose'] || DOPTS_URL+'dopts/uploads/settings/lightbox-navigation-close/0.png')+'</li>\n');
            htmlCODE.push('        <li class="LightboxNavigationCloseHover">'+(DOPTS_URL+data['LightboxNavigationCloseHover'] || DOPTS_URL+'dopts/uploads/settings/lightbox-navigation-close-hover/0.png')+'</li>\n');
            htmlCODE.push('        <li class="LightboxNavigationInfoBgColor">'+(data['LightboxNavigationInfoBgColor'] || 'ffffff')+'</li>\n');
            htmlCODE.push('        <li class="LightboxNavigationInfoTextColor">'+(data['LightboxNavigationInfoTextColor'] || 'c0c0c0')+'</li>\n');
            htmlCODE.push('        <li class="LightboxNavigationDisplayTime">'+(parseInt(data['LightboxNavigationDisplayTime']))+'</li>\n');
            htmlCODE.push('        <li class="LightboxNavigationTouchDeviceSwipeEnabled">'+(data['LightboxNavigationTouchDeviceSwipeEnabled'] || 'true')+'</li>\n');

            htmlCODE.push('        <li class="TooltipBgColor">'+(data['TooltipBgColor'] || 'ffffff')+'</li>\n');
            htmlCODE.push('        <li class="TooltipStrokeColor">'+(data['TooltipStrokeColor'] || '000000')+'</li>\n');
            htmlCODE.push('        <li class="TooltipTextColor">'+(data['TooltipTextColor'] || '000000')+'</li>\n');

            htmlCODE.push('        <li class="LabelPosition">'+(data['LabelPosition'] || 'bottom')+'</li>\n');
            htmlCODE.push('        <li class="LabelAlwaysVisible">'+(data['LabelAlwaysVisible'] || 'false')+'</li>\n');
            htmlCODE.push('        <li class="LabelBgColor">'+(data['LabelBgColor'] || '000000')+'</li>\n');
            htmlCODE.push('        <li class="LabelBgAlpha">'+(parseInt(data['LabelBgAlpha']))+'</li>\n');
            htmlCODE.push('        <li class="LabelTextColor">'+(data['LabelTextColor'] || 'ffffff')+'</li>\n');

            htmlCODE.push('        <li class="SlideshowEnabled">'+(data['SlideshowEnabled'] || 'false')+'</li>\n');
            htmlCODE.push('        <li class="SlideshowTime">'+(parseInt(data['SlideshowTime']))+'</li>\n');
            htmlCODE.push('        <li class="SlideshowLoop">'+(data['SlideshowLoop'] || 'false')+'</li>\n');
            htmlCODE.push('    </ul>\n');
            
            $jDOPTS.getJSON(doptsACAOBuster(DOPTS_URL+'dopts/data/content'+$jDOPTS('#scroller_id').val()+'.json'), {}, function(data){
                htmlCODE.push('    <ul class="Content" style="display:none;">\n');                
                $jDOPTS.each(data, function(index){
                    if (data[index]['Enabled'] == 'true'){
                        htmlCODE.push('        <li>\n');
                        htmlCODE.push('            <span class="Image">'+(DOPTS_URL+data[index]['Image'])+'</span>\n');
                        htmlCODE.push('            <span class="Thumb">'+(DOPTS_URL+data[index]['Thumb'])+'</span>\n');
                        htmlCODE.push('            <span class="Title">'+(doptsStripslashes(data[index]['Title']))+'</span>\n');
                        htmlCODE.push('            <span class="Caption">'+(doptsStripslashes(data[index]['Caption']))+'</span>\n');
                        htmlCODE.push('            <span class="Media">'+(doptsStripslashes(data[index]['Media']))+'</span>\n');
                        htmlCODE.push('            <span class="LightboxMedia">'+(doptsStripslashes(data[index]['LightboxMedia']))+'</span>\n');
                        htmlCODE.push('            <span class="Link">'+(doptsStripslashes(data[index]['Link']))+'</span>\n');
                        htmlCODE.push('            <span class="Target">'+(doptsStripslashes(data[index]['Target']))+'</span>\n');
                        htmlCODE.push('        </li>\n');                                 
                    }
                });
                htmlCODE.push('    </ul>\n');
                            
                CODE.push('<script type="text/JavaScript">\n');
                CODE.push('    $(document).ready(function(){\n');
                CODE.push('        $(\'#DOPThumbnailScrollerContainer'+$jDOPTS('#scroller_id').val()+'\').DOPThumbnailScroller({\'DataType\': \'HTML\'});\n');
                CODE.push('    });\n');
                CODE.push('</script>\n');
                CODE.push('<div id="DOPThumbnailScrollerContainer'+$jDOPTS('#scroller_id').val()+'">\n');
                CODE.push(htmlCODE.join(''));
                CODE.push('</div>');
                
                $jDOPTS('#code_area').val(CODE.join(''));
            });
        });
    }
    else{
        CODE.push('<script type="text/JavaScript">\n');
        CODE.push('    $(document).ready(function(){\n');
        CODE.push('        $(\'#DOPThumbnailScrollerContainer'+$jDOPTS('#scroller_id').val()+'\').DOPThumbnailScroller({\'URL\': \''+DOPTS_URL+'\', \'SettingsFilePath\': \''+DOPTS_URL+'dopts/data/settings'+$jDOPTS('#scroller_id').val()+'.json\', \'ContentFilePath\': \''+DOPTS_URL+'dopts/data/content'+$jDOPTS('#scroller_id').val()+'.json\'});\n');
        CODE.push('    });\n');
        CODE.push('</script>\n');
        CODE.push('<div id="DOPThumbnailScrollerContainer'+$jDOPTS('#scroller_id').val()+'"></div>');

        $jDOPTS('#code_area').val(CODE.join(''));
    }
}

function doptsSettingsForm(data, column){// Settings Form.
    var HTML = new Array();
    
    HTML.push('<form method="post" class="settings" action="" onsubmit="return false;">');

// General Styles & Settings
    HTML.push('    <h3 class="settings">'+DOPTS_GENERAL_STYLES_SETTINGS+'</h3>');
    if ($jDOPTS('#scroller_id').val() != '0'){
        HTML.push(doptsSettingsFormInput('name', data['Name'], DOPTS_SCROLLER_NAME, '', '', '', 'help', DOPTS_SCROLLER_NAME_INFO));
    }                               
    HTML.push(doptsSettingsFormInput('width', data['Width'], DOPTS_WIDTH, '', 'px', 'small', 'help-small', DOPTS_WIDTH_INFO));
    HTML.push(doptsSettingsFormInput('height', data['Height'], DOPTS_HEIGHT, '', 'px', 'small', 'help-small', DOPTS_HEIGHT_INFO));
    HTML.push(doptsSettingsFormInput('bg_color', data['BgColor'], DOPTS_BG_COLOR, '#', '', 'small', 'help-small', DOPTS_BG_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('bg_alpha', data['BgAlpha'], DOPTS_BG_ALPHA, '', '', 'small', 'help-small', DOPTS_BG_ALPHA_INFO));
    HTML.push(doptsSettingsFormInput('bg_border_size', data['BgBorderSize'], DOPTS_BG_BORDER_SIZE, '', 'px', 'small', 'help-small', DOPTS_BG_BORDER_SIZE_INFO));
    HTML.push(doptsSettingsFormInput('bg_border_color', data['BgBorderColor'], DOPTS_BG_BORDER_COLOR, '#', '', 'small', 'help-small', DOPTS_BG_BORDER_COLOR_INFO));
    HTML.push(doptsSettingsFormSelect('thumbnails_order', data['ThumbnailsOrder'], DOPTS_IMAGES_ORDER, '', '', '', 'help', DOPTS_IMAGES_ORDER_INFO, 'normal;;random'));
    HTML.push(doptsSettingsFormSelect('responsive_enabled', data['ResponsiveEnabled'], DOPTS_RESPONSIVE_ENABLED, '', '', '', 'help', DOPTS_RESPONSIVE_ENABLED_INFO, 'true;;false'));
   
// Thumbnails Styles & Settings
    HTML.push('    <a href="javascript:doptsMoveTop()" class="go-top">'+DOPTS_GO_TOP+'</a><h3 class="settings">'+DOPTS_THUMBNAILS_STYLES_SETTINGS+'</h3>');        
    
    HTML.push(doptsSettingsFormSelect('thumbnails_position', data['ThumbnailsPosition'], DOPTS_THUMBNAILS_POSITION, '', '', '', 'help', DOPTS_THUMBNAILS_POSITION_INFO, 'horizontal;;vertical'));
    HTML.push(doptsSettingsFormInput('thumbnails_bg_color', data['ThumbnailsBgColor'], DOPTS_THUMBNAILS_BG_COLOR, '#', '', 'small', 'help-small', DOPTS_THUMBNAILS_BG_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_bg_alpha', data['ThumbnailsBgAlpha'], DOPTS_THUMBNAILS_BG_ALPHA, '', '', 'small', 'help-small', DOPTS_THUMBNAILS_BG_ALPHA_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_border_size', data['ThumbnailsBorderSize'], DOPTS_THUMBNAILS_BORDER_SIZE, '', 'px', 'small', 'help-small', DOPTS_THUMBNAILS_BORDER_SIZE_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_border_color', data['ThumbnailsBorderColor'], DOPTS_THUMBNAILS_BORDER_COLOR, '#', '', 'small', 'help-small', DOPTS_THUMBNAILS_BORDER_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_spacing', data['ThumbnailsSpacing'], DOPTS_THUMBNAILS_SPACING, '', 'px', 'small', 'help-small', DOPTS_THUMBNAILS_SPACING_INFO));    
    HTML.push(doptsSettingsFormInput('thumbnails_margin_top', data['ThumbnailsMarginTop'], DOPTS_THUMBNAILS_MARGIN_TOP, '', 'px', 'small', 'help-small', DOPTS_THUMBNAILS_MARGIN_TOP_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_margin_right', data['ThumbnailsMarginRight'], DOPTS_THUMBNAILS_MARGIN_RIGHT, '', 'px', 'small', 'help-small', DOPTS_THUMBNAILS_MARGIN_RIGHT_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_margin_bottom', data['ThumbnailsMarginBottom'], DOPTS_THUMBNAILS_MARGIN_BOTTOM, '', 'px', 'small', 'help-small', DOPTS_THUMBNAILS_MARGIN_BOTTOM_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_margin_left', data['ThumbnailsMarginLeft'], DOPTS_THUMBNAILS_MARGIN_LEFT, '', 'px', 'small', 'help-small', DOPTS_THUMBNAILS_MARGIN_LEFT_INFO));    
    HTML.push(doptsSettingsFormInput('thumbnails_padding_top', data['ThumbnailsPaddingTop'], DOPTS_THUMBNAILS_PADDING_TOP, '', 'px', 'small', 'help-small', DOPTS_THUMBNAILS_PADDING_TOP_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_padding_right', data['ThumbnailsPaddingRight'], DOPTS_THUMBNAILS_PADDING_RIGHT, '', 'px', 'small', 'help-small', DOPTS_THUMBNAILS_PADDING_RIGHT_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_padding_bottom', data['ThumbnailsPaddingBottom'], DOPTS_THUMBNAILS_PADDING_BOTTOM, '', 'px', 'small', 'help-small', DOPTS_THUMBNAILS_PADDING_BOTTOM_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_padding_left', data['ThumbnailsPaddingLeft'], DOPTS_THUMBNAILS_PADDING_LEFT, '', 'px', 'small', 'help-small', DOPTS_THUMBNAILS_PADDING_LEFT_INFO));
    HTML.push(doptsSettingsFormSelect('thumbnails_info', data['ThumbnailsInfo'], DOPTS_THUMBNAILS_INFO, '', '', '', 'help', DOPTS_THUMBNAILS_INFO_INFO, 'none;;tooltip;;label'));
    
// Thumbnails Navigation Styles & Settings
    HTML.push('    <a href="javascript:doptsMoveTop()" class="go-top">'+DOPTS_GO_TOP+'</a><h3 class="settings">'+DOPTS_THUMBNAILS_NAVIGATION_STYLES_SETTINGS+'</h3>');                                                                        
    
    HTML.push(doptsSettingsFormSelect('thumbnails_navigation_easing', data['ThumbnailsNavigationEasing'], DOPTS_THUMBNAILS_NAVIGATION_EASING, '', '', '', 'help', DOPTS_THUMBNAILS_NAVIGATION_EASING_INFO, 'linear;;swing;;easeInQuad;;easeOutQuad;;easeInOutQuad;;easeInCubic;;easeOutCubic;;easeInOutCubic;;easeInQuart;;easeOutQuart;;easeInOutQuart;;easeInQuint;;easeOutQuint;;easeInOutQuint;;easeInSine;;easeOutSine;;easeInOutSine;;easeInExpo;;easeOutExpo;;easeInOutExpo;;easeInCirc;;easeOutCirc;;easeInOutCirc;;easeInElastic;;easeOutElastic;;easeInOutElastic;;easeInBack;;easeOutBack;;easeInOutBack;;easeInBounce;;easeOutBounce;;easeInOutBounce'));
    HTML.push(doptsSettingsFormSelect('thumbnails_navigation_loop', data['ThumbnailsNavigationLoop'], DOPTS_THUMBNAILS_NAVIGATION_LOOP, '', '', '', 'help', DOPTS_THUMBNAILS_NAVIGATION_LOOP_INFO, 'true;;false'));
    HTML.push(doptsSettingsFormSelect('thumbnails_navigation_mouse_enabled', data['ThumbnailsNavigationMouseEnabled'], DOPTS_THUMBNAILS_NAVIGATION_MOUSE_ENABLED, '', '', '', 'help', DOPTS_THUMBNAILS_NAVIGATION_MOUSE_ENABLED_INFO, 'true;;false'));
    HTML.push(doptsSettingsFormSelect('thumbnails_navigation_scroll_enabled', data['ThumbnailsNavigationScrollEnabled'], DOPTS_THUMBNAILS_NAVIGATION_SCROLL_ENABLED, '', '', '', 'help', DOPTS_THUMBNAILS_NAVIGATION_SCROLL_ENABLED_INFO, 'true;;false'));
    HTML.push(doptsSettingsFormSelect('thumbnails_scroll_position', data['ThumbnailsScrollPosition'], DOPTS_THUMBNAILS_NAVIGATION_SCROLL_POSITION, '', '', '', 'help', DOPTS_THUMBNAILS_NAVIGATION_SCROLL_POSITION_INFO, 'bottom/right;;top/left'));
    HTML.push(doptsSettingsFormInput('thumbnails_scroll_size', data['ThumbnailsScrollSize'], DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SIZE, '', 'px', 'small', 'help-small', DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SIZE_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_scroll_scrub_color', data['ThumbnailsScrollScrubColor'], DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SCRUB_COLOR, '#', '', 'small', 'help-small', DOPTS_THUMBNAILS_NAVIGATION_SCROLL_SCRUB_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_scroll_bar_color', data['ThumbnailsScrollBarColor'], DOPTS_THUMBNAILS_NAVIGATION_SCROLL_BAR_COLOR, '#', '', 'small', 'help-small', DOPTS_THUMBNAILS_NAVIGATION_SCROLL_BAR_COLOR_INFO));
    HTML.push(doptsSettingsFormSelect('thumbnails_navigation_arrows_enabled', data['ThumbnailsNavigationArrowsEnabled'], DOPTS_THUMBNAILS_NAVIGATION_ARROWS_ENABLED, '', '', '', 'help', DOPTS_THUMBNAILS_NAVIGATION_ARROWS_ENABLED_INFO, 'true;;false'));
    HTML.push(doptsSettingsFormInput('thumbnails_navigation_arrows_no_items_slide', data['ThumbnailsNavigationArrowsNoItemsSlide'], DOPTS_THUMBNAILS_NAVIGATION_ARROWS_NO_ITEMS_SLIDE, '', '', 'small', 'help-small', DOPTS_THUMBNAILS_NAVIGATION_ARROWS_NO_ITEMS_SLIDE_INFO));
    HTML.push(doptsSettingsFormInput('thumbnails_navigation_arrows_speed', data['ThumbnailsNavigationArrowsSpeed'], DOPTS_THUMBNAILS_NAVIGATION_ARROWS_SPEED, '', '', 'small', 'help-small', DOPTS_THUMBNAILS_NAVIGATION_ARROWS_SPEED_INFO));
    HTML.push(doptsSettingsFormImage('thumbnails_navigation_prev', data['ThumbnailsNavigationPrev'], DOPTS_THUMBNAILS_NAVIGATION_PREV, 'help-image', DOPTS_THUMBNAILS_NAVIGATION_PREV_INFO));
    HTML.push(doptsSettingsFormImage('thumbnails_navigation_prev_hover', data['ThumbnailsNavigationPrevHover'], DOPTS_THUMBNAILS_NAVIGATION_PREV_HOVER, 'help-image', DOPTS_THUMBNAILS_NAVIGATION_PREV_HOVER_INFO));
    HTML.push(doptsSettingsFormImage('thumbnails_navigation_prev_disabled', data['ThumbnailsNavigationPrevDisabled'], DOPTS_THUMBNAILS_NAVIGATION_PREV_DISABLED, 'help-image', DOPTS_THUMBNAILS_NAVIGATION_PREV_DISABLED_INFO));
    HTML.push(doptsSettingsFormImage('thumbnails_navigation_next', data['ThumbnailsNavigationNext'], DOPTS_THUMBNAILS_NAVIGATION_NEXT, 'help-image', DOPTS_THUMBNAILS_NAVIGATION_NEXT_INFO));
    HTML.push(doptsSettingsFormImage('thumbnails_navigation_next_hover', data['ThumbnailsNavigationNextHover'], DOPTS_THUMBNAILS_NAVIGATION_NEXT_HOVER, 'help-image', DOPTS_THUMBNAILS_NAVIGATION_NEXT_HOVER_INFO));
    HTML.push(doptsSettingsFormImage('thumbnails_navigation_next_disabled', data['ThumbnailsNavigationNextDisabled'], DOPTS_THUMBNAILS_NAVIGATION_NEXT_DISABLED, 'help-image', DOPTS_THUMBNAILS_NAVIGATION_NEXT_DISABLED_INFO));
    
// Styles & Settings for a Thumbnail
    HTML.push('    <a href="javascript:doptsMoveTop()" class="go-top">'+DOPTS_GO_TOP+'</a><h3 class="settings">'+DOPTS_THUMBNAIL_STYLES_SETTINGS+'</h3>');
    
    HTML.push(doptsSettingsFormImage('thumbnail_loader', data['ThumbnailLoader'], DOPTS_THUMBNAIL_LOADER, 'help-image', DOPTS_THUMBNAIL_LOADER_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_width', data['ThumbnailWidth'], DOPTS_THUMBNAIL_WIDTH, '', 'px', 'small', 'help-small', DOPTS_THUMBNAIL_WIDTH_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_height', data['ThumbnailHeight'], DOPTS_THUMBNAIL_HEIGHT, '', 'px', 'small', 'help-small', DOPTS_THUMBNAIL_HEIGHT_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_alpha', data['ThumbnailAlpha'], DOPTS_THUMBNAIL_ALPHA, '', '', 'small', 'help-small', DOPTS_THUMBNAIL_ALPHA_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_alpha_hover', data['ThumbnailAlphaHover'], DOPTS_THUMBNAIL_ALPHA_HOVER, '', '', 'small', 'help-small', DOPTS_THUMBNAIL_ALPHA_HOVER_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_bg_color', data['ThumbnailBgColor'], DOPTS_THUMBNAIL_BG_COLOR, '#', '', 'small', 'help-small', DOPTS_THUMBNAIL_BG_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_bg_color_hover', data['ThumbnailBgColorHover'], DOPTS_THUMBNAIL_BG_COLOR_HOVER, '#', '', 'small', 'help-small', DOPTS_THUMBNAIL_BG_COLOR_HOVER_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_border_size', data['ThumbnailBorderSize'], DOPTS_THUMBNAIL_BORDER_SIZE, '', 'px', 'small', 'help-small', DOPTS_THUMBNAIL_BORDER_SIZE_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_border_color', data['ThumbnailBorderColor'], DOPTS_THUMBNAIL_BORDER_COLOR, '#', '', 'small', 'help-small', DOPTS_THUMBNAIL_BORDER_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_border_color_hover', data['ThumbnailBorderColorHover'], DOPTS_THUMBNAIL_BORDER_COLOR_HOVER, '#', '', 'small', 'help-small', DOPTS_THUMBNAIL_BORDER_COLOR_HOVER_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_padding_top', data['ThumbnailPaddingTop'], DOPTS_THUMBNAIL_PADDING_TOP, '', 'px', 'small', 'help-small', DOPTS_THUMBNAIL_PADDING_TOP_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_padding_right', data['ThumbnailPaddingRight'], DOPTS_THUMBNAIL_PADDING_RIGHT, '', 'px', 'small', 'help-small', DOPTS_THUMBNAIL_PADDING_RIGHT_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_padding_bottom', data['ThumbnailPaddingBottom'], DOPTS_THUMBNAIL_PADDING_BOTTOM, '', 'px', 'small', 'help-small', DOPTS_THUMBNAIL_PADDING_BOTTOM_INFO));
    HTML.push(doptsSettingsFormInput('thumbnail_padding_left', data['ThumbnailPaddingLeft'], DOPTS_THUMBNAIL_PADDING_LEFT, '', 'px', 'small', 'help-small', DOPTS_THUMBNAIL_PADDING_LEFT_INFO));
   
// Lightbox Styles & Settings
    HTML.push('    <a href="javascript:doptsMoveTop()" class="go-top">'+DOPTS_GO_TOP+'</a><h3 class="settings">'+DOPTS_LIGHTBOX_STYLES_SETTINGS+'</h3>');
    
    HTML.push(doptsSettingsFormSelect('lightbox_enabled', data['LightboxEnabled'], DOPTS_LIGHTBOX_ENABLED, '', '', '', 'help', DOPTS_LIGHTBOX_ENABLED_INFO, 'true;;false'));
    HTML.push(doptsSettingsFormInput('lightbox_display_time', data['LightboxDisplayTime'], DOPTS_LIGHTBOX_DISPLAY_TIME, '', '', 'small', 'help-small', DOPTS_LIGHTBOX_DISPLAY_TIME_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_window_color', data['LightboxWindowColor'], DOPTS_LIGHTBOX_WINDOW_COLOR, '#', '', 'small', 'help-small', DOPTS_LIGHTBOX_WINDOW_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_window_alpha', data['LightboxWindowAlpha'], DOPTS_LIGHTBOX_WINDOW_ALPHA, '', '', 'small', 'help-small', DOPTS_LIGHTBOX_WINDOW_ALPHA_INFO));
    HTML.push(doptsSettingsFormImage('lightbox_loader', data['LightboxLoader'], DOPTS_LIGHTBOX_LOADER, 'help-image', DOPTS_LIGHTBOX_LOADER_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_bg_color', data['LightboxBgColor'], DOPTS_LIGHTBOX_BACKGROUND_COLOR, '#', '', 'small', 'help-small', DOPTS_LIGHTBOX_BACKGROUND_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_bg_alpha', data['LightboxBgAlpha'], DOPTS_LIGHTBOX_BACKGROUND_ALPHA, '', '', 'small', 'help-small', DOPTS_LIGHTBOX_BACKGROUND_ALPHA_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_border_size', data['LightboxBorderSize'], DOPTS_LIGHTBOX_BORDER_SIZE, '', 'px', 'small', 'help-small', DOPTS_LIGHTBOX_BORDER_SIZE_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_border_color', data['LightboxBorderColor'], DOPTS_LIGHTBOX_BORDER_COLOR, '#', '', 'small', 'help-small', DOPTS_LIGHTBOX_BORDER_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_caption_text_color', data['LightboxCaptionTextColor'], DOPTS_LIGHTBOX_CAPTION_TEXT_COLOR, '#', '', 'small', 'help-small', DOPTS_LIGHTBOX_CAPTION_TEXT_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_margin_top', data['LightboxMarginTop'], DOPTS_LIGHTBOX_MARGIN_TOP, '', 'px', 'small', 'help-small', DOPTS_LIGHTBOX_MARGIN_TOP_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_margin_right', data['LightboxMarginRight'], DOPTS_LIGHTBOX_MARGIN_RIGHT, '', 'px', 'small', 'help-small', DOPTS_LIGHTBOX_MARGIN_RIGHT_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_margin_bottom', data['LightboxMarginBottom'], DOPTS_LIGHTBOX_MARGIN_BOTTOM, '', 'px', 'small', 'help-small', DOPTS_LIGHTBOX_MARGIN_BOTTOM_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_margin_left', data['LightboxMarginLeft'], DOPTS_LIGHTBOX_MARGIN_LEFT, '', 'px', 'small', 'help-small', DOPTS_LIGHTBOX_MARGIN_LEFT_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_padding_top', data['LightboxPaddingTop'], DOPTS_LIGHTBOX_PADDING_TOP, '', 'px', 'small', 'help-small', DOPTS_LIGHTBOX_PADDING_TOP_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_padding_right', data['LightboxPaddingRight'], DOPTS_LIGHTBOX_PADDING_RIGHT, '', 'px', 'small', 'help-small', DOPTS_LIGHTBOX_PADDING_RIGHT_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_padding_bottom', data['LightboxPaddingBottom'], DOPTS_LIGHTBOX_PADDING_BOTTOM, '', 'px', 'small', 'help-small', DOPTS_LIGHTBOX_PADDING_BOTTOM_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_padding_left', data['LightboxPaddingLeft'], DOPTS_LIGHTBOX_PADDING_LEFT, '', 'px', 'small', 'help-small', DOPTS_LIGHTBOX_PADDING_LEFT_INFO));
        
// Lightbox Navigation Icons Styles & Settings
    HTML.push('    <a href="javascript:doptsMoveTop()" class="go-top">'+DOPTS_GO_TOP+'</a><h3 class="settings">'+DOPTS_LIGHTBOX_NAVIGATION_STYLES_SETTINGS+'</h3>');
         
    HTML.push(doptsSettingsFormImage('lightbox_navigation_prev', data['LightboxNavigationPrev'], DOPTS_LIGHTBOX_NAVIGATION_PREV, 'help-image', DOPTS_LIGHTBOX_NAVIGATION_PREV_INFO));
    HTML.push(doptsSettingsFormImage('lightbox_navigation_prev_hover', data['LightboxNavigationPrevHover'], DOPTS_LIGHTBOX_NAVIGATION_PREV_HOVER, 'help-image', DOPTS_LIGHTBOX_NAVIGATION_PREV_HOVER_INFO));
    HTML.push(doptsSettingsFormImage('lightbox_navigation_next', data['LightboxNavigationNext'], DOPTS_LIGHTBOX_NAVIGATION_NEXT, 'help-image', DOPTS_LIGHTBOX_NAVIGATION_NEXT_INFO));
    HTML.push(doptsSettingsFormImage('lightbox_navigation_next_hover', data['LightboxNavigationNextHover'], DOPTS_LIGHTBOX_NAVIGATION_NEXT_HOVER, 'help-image', DOPTS_LIGHTBOX_NAVIGATION_NEXT_HOVER_INFO));
    HTML.push(doptsSettingsFormImage('lightbox_navigation_close', data['LightboxNavigationClose'], DOPTS_LIGHTBOX_NAVIGATION_CLOSE, 'help-image', DOPTS_LIGHTBOX_NAVIGATION_CLOSE_INFO));
    HTML.push(doptsSettingsFormImage('lightbox_navigation_close_hover', data['LightboxNavigationCloseHover'], DOPTS_LIGHTBOX_NAVIGATION_CLOSE_HOVER, 'help-image', DOPTS_LIGHTBOX_NAVIGATION_CLOSE_HOVER_INFO));    
    HTML.push(doptsSettingsFormInput('lightbox_navigation_info_bg_color', data['LightboxNavigationInfoBgColor'], DOPTS_LIGHTBOX_NAVIGATION_INFO_BG_COLOR, '#', '', 'small', 'help-small', DOPTS_LIGHTBOX_NAVIGATION_INFO_BG_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_navigation_info_text_color', data['LightboxNavigationInfoTextColor'], DOPTS_LIGHTBOX_NAVIGATION_INFO_TEXT_COLOR, '#', '', 'small', 'help-small', DOPTS_LIGHTBOX_NAVIGATION_INFO_TEXT_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('lightbox_navigation_display_time', data['LightboxNavigationDisplayTime'], DOPTS_LIGHTBOX_NAVIGATION_DISPLAY_TIME, '', '', 'small', 'help-small', DOPTS_LIGHTBOX_NAVIGATION_DISPLAY_TIME_INFO));
    HTML.push(doptsSettingsFormSelect('lightbox_navigation_touch_device_swipe_enabled', data['LightboxNavigationTouchDeviceSwipeEnabled'], DOPTS_LIGHTBOX_NAVIGATION_TOUCH_DEVICE_SWIPE_ENABLED, '', '', '', 'help', DOPTS_LIGHTBOX_NAVIGATION_TOUCH_DEVICE_SWIPE_ENABLED_INFO, 'true;;false'));
    
// Tooltip Styles & Settings
    HTML.push('    <a href="javascript:doptsMoveTop()" class="go-top">'+DOPTS_GO_TOP+'</a><h3 class="settings">'+DOPTS_TOOLTIP_STYLES_SETTINGS+'</h3>');
    
    HTML.push(doptsSettingsFormInput('tooltip_bg_color', data['TooltipBgColor'], DOPTS_TOOLTIP_BG_COLOR, '#', '', 'small', 'help-small', DOPTS_TOOLTIP_BG_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('tooltip_stroke_color', data['TooltipStrokeColor'], DOPTS_TOOLTIP_STROKE_COLOR, '#', '', 'small', 'help-small', DOPTS_TOOLTIP_STROKE_COLOR_INFO));
    HTML.push(doptsSettingsFormInput('tooltip_text_color', data['TooltipTextColor'], DOPTS_TOOLTIP_TEXT_COLOR, '#', '', 'small', 'help-small', DOPTS_TOOLTIP_TEXT_COLOR_INFO));

// Label Styles & Settings
    HTML.push('    <a href="javascript:doptsMoveTop()" class="go-top">'+DOPTS_GO_TOP+'</a><h3 class="settings">'+DOPTS_LABEL_STYLES_SETTINGS+'</h3>');
    
    HTML.push(doptsSettingsFormSelect('label_position', data['LabelPosition'], DOPTS_LABEL_POSITION, '', '', '', 'help', DOPTS_LABEL_POSITION_INFO, 'bottom;;top'));
    HTML.push(doptsSettingsFormSelect('label_always_visible', data['LabelAlwaysVisible'], DOPTS_LABEL_ALWAYS_VISIBLE, '', '', '', 'help', DOPTS_LABEL_ALWAYS_VISIBLE_INFO, 'true;;false'));
    HTML.push(doptsSettingsFormInput('label_bg_color', data['LabelBgColor'], DOPTS_LABEL_BG_COLOR, '#', '', 'small', 'help-small', DOPTS_LABEL_BG_COLOR_INFO));    
    HTML.push(doptsSettingsFormInput('label_bg_alpha', data['LabelBgAlpha'], DOPTS_LABEL_BG_ALPHA, '', '', 'small', 'help-small', DOPTS_LABEL_BG_ALPHA_INFO));
    HTML.push(doptsSettingsFormInput('label_text_color', data['LabelTextColor'], DOPTS_LABEL_TEXT_COLOR, '#', '', 'small', 'help-small', DOPTS_LABEL_TEXT_COLOR_INFO));// Slideshow Settings
    
// Slideshow Settings    
    HTML.push('    <a href="javascript:doptsMoveTop()" class="go-top">'+DOPTS_GO_TOP+'</a><h3 class="settings">'+DOPTS_SLIDESHOW_SETTINGS+'</h3>');
    
    HTML.push(doptsSettingsFormSelect('slideshow_enabled', data['SlideshowEnabled'], DOPTS_SLIDESHOW_ENABLED, '', '', '', 'help', DOPTS_SLIDESHOW_ENABLED_INFO, 'true;;false'));
    HTML.push(doptsSettingsFormInput('slideshow_time', data['SlideshowTime'], DOPTS_SLIDESHOW_TIME, '', '', 'small', 'help-small', DOPTS_SLIDESHOW_TIME_INFO));
    HTML.push(doptsSettingsFormSelect('slideshow_loop', data['SlideshowLoop'], DOPTS_SLIDESHOW_LOOP, '', '', '', 'help', DOPTS_SLIDESHOW_LOOP_INFO, 'true;;false'));
    
    HTML.push('</form>');

    $jDOPTS('.column-content', '.column'+column, '.DOPTS-admin').html(HTML.join(''));
    setTimeout(function(){
        doptsResize();
        setTimeout(function(){
           doptsResize();
        }, 10000);
    }, 5000);
    
    $jDOPTS('#bg_color,\n\
             #bg_border_color,\n\
             #thumbnails_bg_color,\n\
             #thumbnails_border_color,\n\
             #thumbnails_scroll_scrub_color,\n\
             #thumbnails_scroll_bar_color,\n\
             #thumbnail_bg_color,\n\
             #thumbnail_bg_color_hover,\n\
             #thumbnail_border_color,\n\
             #thumbnail_border_color_hover,\n\
             #lightbox_window_color,\n\
             #lightbox_bg_color,\n\
             #lightbox_border_color,\n\
             #lightbox_navigation_info_bg_color,\n\
             #lightbox_navigation_info_text_color,\n\
             #lightbox_caption_text_color,\n\
             #tooltip_bg_color,\n\
             #tooltip_stroke_color,\n\
             #tooltip_text_color,\n\
             #label_bg_color,\n\
             #label_text_color').ColorPicker({
        onSubmit:function(hsb, hex, rgb, el){
            $jDOPTS(el).val(hex);
            $jDOPTS(el).ColorPickerHide();
        },
        onBeforeShow:function(){
            $jDOPTS(this).ColorPickerSetColor(this.value);
        },
        onShow:function(colpkr){
            $jDOPTS(colpkr).fadeIn(500);
            return false;
        },
        onHide:function(colpkr){
            $jDOPTS(colpkr).fadeOut(500);
            return false;
        }
    })
    .bind('keyup', function(){
        $jDOPTS(this).ColorPickerSetColor(this.value);
    });
    
    doptsSettingsImageUpload('thumbnails_navigation_prev', 'uploads/settings/thumbnails-navigation-prev/', DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_SUBMITED, DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_SUCCESS);
    doptsSettingsImageUpload('thumbnails_navigation_prev_hover', 'uploads/settings/thumbnails-navigation-prev-hover/', DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_HOVER_SUBMITED, DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_HOVER_SUCCESS);
    doptsSettingsImageUpload('thumbnails_navigation_prev_disabled', 'uploads/settings/thumbnails-navigation-prev-disabled/', DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_DISABLED_SUBMITED, DOPTS_ADD_THUMBNAILS_NAVIGATION_PREV_DISABLED_SUCCESS);
    doptsSettingsImageUpload('thumbnails_navigation_next', 'uploads/settings/thumbnails-navigation-next/', DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_SUBMITED, DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_SUCCESS);
    doptsSettingsImageUpload('thumbnails_navigation_next_hover', 'uploads/settings/thumbnails-navigation-next-hover/', DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_HOVER_SUBMITED, DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_HOVER_SUCCESS);
    doptsSettingsImageUpload('thumbnails_navigation_next_disabled', 'uploads/settings/thumbnails-navigation-next-disabled/', DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_DISABLED_SUBMITED, DOPTS_ADD_THUMBNAILS_NAVIGATION_NEXT_DISABLED_SUCCESS);    
    doptsSettingsImageUpload('thumbnail_loader', 'uploads/settings/thumbnail-loader/', DOPTS_ADD_THUMBNAIL_LOADER_SUBMITED, DOPTS_ADD_THUMBNAIL_LOADER_SUCCESS);
    doptsSettingsImageUpload('lightbox_loader', 'uploads/settings/lightbox-loader/', DOPTS_ADD_LIGHTBOX_LOADER_SUBMITED, DOPTS_ADD_LIGHTBOX_LOADER_SUCCESS);
    doptsSettingsImageUpload('lightbox_navigation_prev', 'uploads/settings/lightbox-navigation-prev/', DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_SUBMITED, DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_SUCCESS);
    doptsSettingsImageUpload('lightbox_navigation_prev_hover', 'uploads/settings/lightbox-navigation-prev-hover/', DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_HOVER_SUBMITED, DOPTS_ADD_LIGHTBOX_NAVIGATION_PREV_HOVER_SUCCESS);
    doptsSettingsImageUpload('lightbox_navigation_next', 'uploads/settings/lightbox-navigation-next/', DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_SUBMITED, DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_SUCCESS);
    doptsSettingsImageUpload('lightbox_navigation_next_hover', 'uploads/settings/lightbox-navigation-next-hover/', DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_HOVER_SUBMITED, DOPTS_ADD_LIGHTBOX_NAVIGATION_NEXT_HOVER_SUCCESS);
    doptsSettingsImageUpload('lightbox_navigation_close', 'uploads/settings/lightbox-navigation-close/', DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_SUBMITED, DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_SUCCESS);
    doptsSettingsImageUpload('lightbox_navigation_close_hover', 'uploads/settings/lightbox-navigation-close-hover/', DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_HOVER_SUBMITED, DOPTS_ADD_LIGHTBOX_NAVIGATION_CLOSE_HOVER_SUCCESS);
}

function doptsSettingsFormInput(id, value, label, pre, suf, input_class, help_class, help){// Create an Input Field.
    var inputHTML = new Array();

    inputHTML.push('    <div class="setting-box">');
    inputHTML.push('        <label for="'+id+'">'+label+'</label>');
    inputHTML.push('        <span class="pre">'+pre+'</span><input type="text" class="'+input_class+'" name="'+id+'" id="'+id+'" value="'+value+'" /><span class="suf">'+suf+'</span>');
    inputHTML.push('        <a href="javascript:void()" class="'+help_class+'" title="'+help+'"></a>');
    inputHTML.push('        <br class="DOPTS-clear" />');
    inputHTML.push('    </div>');

    return inputHTML.join('');
}

function doptsSettingsFormSelect(id, value, label, pre, suf, input_class, help_class, help, values){// Create a Combo Box.
    var selectHTML = new Array(), i,
    valuesList = values.split(';;');

    selectHTML.push('    <div class="setting-box">');
    selectHTML.push('        <label for="'+id+'">'+label+'</label>');
    selectHTML.push('        <span class="pre">'+pre+'</span>');
    selectHTML.push('            <select name="'+id+'" id="'+id+'">');
    for (i=0; i<valuesList.length; i++){
        if (valuesList[i] == value){
            selectHTML.push('        <option value="'+valuesList[i]+'" selected="selected">'+valuesList[i]+'</option>');
        }
        else{
            selectHTML.push('        <option value="'+valuesList[i]+'">'+valuesList[i]+'</option>');
        }
    }
    selectHTML.push('            </select>');
    selectHTML.push('        <span class="suf">'+suf+'</span>');
    selectHTML.push('        <a href="javascript:void()" class="'+help_class+'" title="'+help+'"></a>');
    selectHTML.push('        <br class="DOPTS-clear" />');
    selectHTML.push('    </div>');

    return selectHTML.join('');
}

function doptsSettingsFormImage(id, value, label, help_class, help){// Create an Image Field.
    var imageHTML = new Array();
    
    imageHTML.push('    <div class="setting-box">');
    imageHTML.push('        <label for="'+id+'">'+label+'</label>');
    imageHTML.push('        <span class="pre"></span>');
    imageHTML.push('        <div class="uploadifyContainer" style="float:left; margin:0; width:120px;">');
    imageHTML.push('            <div><input type="file" name="'+id+'" id="'+id+'" style="width:120px;" /></div>');
    imageHTML.push('            <div id="fileQueue_'+id+'"></div>');
    imageHTML.push('        </div>');
    imageHTML.push('        <a href="javascript:void()" class="'+help_class+'" title="'+help+'"></a>');
    imageHTML.push('        <br class="DOPTS-clear" />');
    imageHTML.push('        <label for=""></label>');
    imageHTML.push('        <span class="pre"></span>');
    imageHTML.push('        <div class="uploadifyContainer" id="'+id+'_image" style="float:left; margin:5px 0 0 0; padding:0 0 10px 0;">');
    imageHTML.push('            <img src="'+DOPTS_URL+value+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
    imageHTML.push('        </div>');
    imageHTML.push('        <br class="DOPTS-clear" />');
    imageHTML.push('    </div>');

    return imageHTML.join('');
}

function doptsSettingsImageUpload(id, path, submitMessage, successMessage){
    $jDOPTS('#'+id).uploadify({
        'uploader'       : DOPTS_URL+'dopts/libraries/swf/uploadify.swf',
        'script'         : DOPTS_URL+'dopts/libraries/php/uploadify-settings.php?data='+DOPTS_ABSOLUTE_PATH+'dopts/;;'+path+';;'+$jDOPTS('#scroller_id').val(),
        'cancelImg'      : DOPTS_URL+'dopts/libraries/gui/images/uploadify/cancel.png',
        'folder'         : '',
        'queueID'        : 'fileQueue_'+id,
        'buttonText'     : DOPTS_SELECT_FILE,
        'auto'           : true,
        'multi'          : false,
        'onInit'         : function(){
                               doptsResize();
                           },
        'onCancel'         : function(event,ID,fileObj,data){
                               doptsResize();
                           },
        'onSelect'       : function(event, ID, fileObj){
                               clearClick = false;
                               doptsToggleMessage('show', submitMessage);
                               
                               setTimeout(function(){
                                   doptsResize();
                               }, 100);
                           },
        'onComplete'     : function(event, ID, fileObj, response, data){
                               if (response != -1){
                                   setTimeout(function(){
                                       doptsResize();
                                   }, 1000);
                                    
                                   $jDOPTS.post(ajaxurl, {action: 'dopts_update_settings_image', item:id, scroller_id:$jDOPTS('#scroller_id').val(), path:response}, function(data){
                                       $jDOPTS('#'+id+'_image').html('<img src="'+DOPTS_URL+'dopts/'+response+'?cacheBuster='+doptsRandomString(64)+'" alt="" />');
                                       doptsToggleMessage('hide', successMessage);
                                   });
                               }
                           }
    });
}

function doptsInitHelp(){
    if (clearClick){
        var HTML = new Array(), i;
        $jDOPTS('li', '.column1', '.DOPTS-admin').removeClass('item-selected');

        HTML.push('<div class="DOPTS-faq">');
        for (i=0; i<DOPTS_help_info.length; i++){
            HTML.push('<div class="DOPTS-question" id="DOPTS-question_'+i+'">'+DOPTS_help_info[i]['question']+'</div>');
            HTML.push('<div class="DOPTS-answer" id="DOPTS-answer_'+i+'">'+DOPTS_help_info[i]['answer']+'</div>');
        }
        HTML.push('</div>');

        doptsRemoveColumns(2);
        $jDOPTS('.column-content', '.column2', '.DOPTS-admin').html(HTML.join(''));
        doptsResize();

        $jDOPTS('.DOPTS-question').unbind('click');
        $jDOPTS('.DOPTS-question').bind('click', function(){
            var no = $jDOPTS(this).attr('id').split('_')[1],
            id = '#DOPTS-answer_'+no;

            if ($jDOPTS(id).css('display') == 'none'){
                $jDOPTS('.DOPTS-answer').css('display', 'none');
                $jDOPTS('.DOPTS-answer').html('');
                $jDOPTS(id).html(DOPTS_help_info[no]['answer']);
                $jDOPTS(id).css('display', 'block');
                doptsResize();
            }
            else{
                $jDOPTS(id).css('display', 'none');
                doptsResize();
            }
        });
    }
}

function doptsMoveTop(){
    jQuery('html').stop(true, true).animate({'scrollTop':'0'}, 300);
    jQuery('body').stop(true, true).animate({'scrollTop':'0'}, 300);
}

function doptsStripslashes(str) {
    return (str + '').replace(/\\(.?)/g, function (s, n1) {
        switch (n1){
            case '\\':
                return '\\';
            case '0':
                return '\u0000';
            case '':
                return '';
            default:
                return n1;
        }
    });
}
                        
function doptsACAOBuster(dataURL){
    var topURL = window.location.href;

    if (topURL.indexOf('https') != -1){
        if (topURL.indexOf('https://www.') != -1 && dataURL.indexOf('https://www.') == -1){
            return 'https://www.'+dataURL.split('https://')[1];
        }
        else if (topURL.indexOf('https://www.') == -1 && dataURL.indexOf('https://www.') != -1){
            return 'https://'+dataURL.split('https://www.')[1];
        }
        else{
            return dataURL;
        }                                
    }
    else{
        if (topURL.indexOf('http://www.') != -1 && dataURL.indexOf('http://www.') == -1){
            return 'http://www.'+dataURL.split('http://')[1];
        }
        else if (topURL.indexOf('http://www.') == -1 && dataURL.indexOf('http://www.') != -1){
            return 'http://'+dataURL.split('http://www.')[1];
        }
        else{
            return dataURL;
        }
    }
}