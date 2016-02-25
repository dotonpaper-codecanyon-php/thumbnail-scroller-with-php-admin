
/*
* Title                   : Thumbnail Scroller (with PHP Admin)
* Version                 : 1.1
* File                    : login.js
* File Version            : 1.0
* Created / Last Modified : 10 December 2012
* Author                  : Dot on Paper
* Copyright               : © 2012 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Login Scripts.
*/

$(document).ready(function(){
    $('#wrapper').css('height', $(window).height());
    $('#DOPTS_Login').css('margin-left', $(window).width());
    $('#DOPTS_Login').css('margin-top', ($(window).height()-$('#DOPTS_Login').height())/2-30);
    $('#DOPTS_Login').css('display', 'block');
    $('#DOPTS_Login').stop(true, true).animate({'margin-left':($(window).width()-$('#DOPTS_Login').width())/2}, 600, function(){
        $('#DOPTS_Info').stop(true, true).fadeIn(600);
    });

    $(window).resize(function(){
        $('#wrapper').css('height', $(window).height());
        $('#DOPTS_Login').css({'margin-left': ($(window).width()-$('#DOPTS_Login').width())/2,
                               'margin-top': ($(window).height()-$('#DOPTS_Login').height())/2-30});
    })
});

function login(){    
    disableForm(true);

    $('#DOPTS_Info').fadeOut(400, function(){ 
        $('#DOPTS_Info .info_icon .info').css('display', 'none');
        $('#DOPTS_Info .info_icon .loader').css('display', 'block');        
        $('#DOPTS_Info .info_message .info').css('display', 'none');
        $('#DOPTS_Info .info_message .success').css('display', 'none');
        $('#DOPTS_Info .info_message .error').css('display', 'none');
        $('#DOPTS_Info .info_message .processing').css('display', 'block');
        
        $('#DOPTS_Info').fadeIn(400, function(){
            $.post('assets/php/login.php', {username: $('#username').val(), password:$('#password').val()}, function(data){
                data = $.trim(data);
                
                if (data == 'success'){                    
                    $('#DOPTS_Info').fadeOut(400, function(){
                        $('#DOPTS_Info .info_icon .info').css('display', 'block');
                        $('#DOPTS_Info .info_icon .loader').css('display', 'none');        
                        $('#DOPTS_Info .info_message .info').css('display', 'none');
                        $('#DOPTS_Info .info_message .success').css('display', 'block');
                        $('#DOPTS_Info .info_message .error').css('display', 'none');
                        $('#DOPTS_Info .info_message .processing').css('display', 'none');
                        
                        $('#DOPTS_Info').fadeIn(400, function(){
                            location.reload();
                        });
                    });
                }
                else{
                    disableForm(false);

                    $('#DOPTS_Info').fadeOut(400, function(){
                        $('#username').val('');
                        $('#password').val('');
                        $('#DOPTS_Info .info_icon .info').css('display', 'block');
                        $('#DOPTS_Info .info_icon .loader').css('display', 'none');        
                        $('#DOPTS_Info .info_message .info').css('display', 'none');
                        $('#DOPTS_Info .info_message .success').css('display', 'none');
                        $('#DOPTS_Info .info_message .error').css('display', 'block');
                        $('#DOPTS_Info .info_message .processing').css('display', 'none');
                        $('#DOPTS_Info').fadeIn(400);
                    });
                }
            });
        });
    });

    return false;
}

function disableForm(val){
    $('#username').attr('disabled', val);
    $('#password').attr('disabled', val);
    if (val){
        $('#submit').css('cursor', 'default');
    }
    else{
        $('#submit').css('cursor', 'pointer');
    }
    $('#submit').attr('disabled', val);
}