(function( $ ) {
	'use strict';

     $( ".pm_calendar" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  dateFormat:'yy-mm-dd',
	   yearRange: "1900:2025"
    });
    $( "#ui-datepicker-div" ).wrap( "<div class='pg-datepicker-wrap'></div>" );
    
    var icons = {
	  header: "ui-icon-circle-arrow-e",
	  activeHeader: "ui-icon-circle-arrow-s"
	};
        
    if($("#pm-accordion").length)
    {
        $( "#pm-accordion" ).accordion({
          icons: icons,
        });
    }
    
    $('#advance_search_pane').hide();
    $("#pm-advance-search-form").on('keypress',function(e){
        if(e.which==13){
            $("#pm-advance-search-form").attr("event","keypress");
            return false;
            }
    });
    
    $('#reset_btn').click(function(){
        $("#pm-advance-search-form").attr("event","reset");
        $("#pm-advance-search-form").submit();
        return false;
    });
    
    $("#pm-advance-search-form").submit(function(e)
    {
        e.preventDefault();
        var event = $(this).attr('event');
        if(event === 'keypress')
        {
            pm_advance_user_search('');
        }else if(event === 'reset')
        {
            pm_advance_user_search('Reset');
        }
    });
    
	
    
    //pagination dynamic ajax
    $(document).on('click','#pm_result_pane ul li .page-numbers',function(event){
        event.preventDefault();
      // console.log($(this).text());
       var link = $(this).attr("href");
       if(link !== undefined)
       {
           var newpagenum =link.split('pagenum=')[1];
           pm_advance_user_search(newpagenum);
       }
    });
        
        $(document).on('click','.pm-admin-pagination ul li .page-numbers',function(event){
                event.preventDefault();
              // console.log(jQuery(this).text());
               var link = $(this).attr("href");
               if(link !== undefined)
               {
                   var newpagenum =link.split('pagenum=')[1];
                   pm_filter_admins(newpagenum);
               }
        });
    
    $('#advance_search_option').click(function(e)
    {
        e.preventDefault();
        $('#advance_search_pane').slideToggle('slow');
        $("#pm-advance-search-form").attr("event","advance_options");
        $('#advance_search_option .pg-search-filter-up').toggle();
        $('#advance_search_option .pg-search-filter-down').toggle();
        //alert("test");
        return false;
    });
    
    $(window).load(function() 
    {
        var recaptcha = $(".g-recaptcha");

        if($(window).width() < 391 ) {
            var newScaleFactor = recaptcha.parent().innerWidth() / 304;
            recaptcha.css('transform', 'scale(' + newScaleFactor + ')');
            recaptcha.css('transform-origin', '0 0');
        }
        else {
            recaptcha.css('transform', 'scale(1)');
            recaptcha.css('transform-origin', '0 0');
        }
    });
    
    $(window).resize(function() 
    {
        var recaptcha = $(".g-recaptcha");
        if(recaptcha.css('margin') == '1px') {
            var newScaleFactor = recaptcha.parent().innerWidth() / 304;
            recaptcha.css('transform', 'scale(' + newScaleFactor + ')');
            recaptcha.css('transform-origin', '0 0');
        }
        else {
            recaptcha.css('transform', 'scale(1)');
            recaptcha.css('transform-origin', '0 0');
        }
    });
    
    
    //GUI Engine
    jQuery('.pm-widget-login-box').each(function (index, element) {
        var loginBoxArea = $(this).innerWidth();
        if(loginBoxArea>350)
        {
            $(this).addClass('pm-widget-login-box-large');
            $(this).removeClass('pm-widget-login-box-small');
            $(this).removeClass('pm-widget-login-box-medium');
        }
        else if(loginBoxArea<300)
        {
             $(this).addClass('pm-widget-login-box-small');
             $(this).removeClass('pm-widget-login-box-large');
             $(this).removeClass('pm-widget-login-box-medium');
        }
        else
        {
            $(this).addClass('pm-widget-login-box-medium');
            $(this).removeClass('pm-widget-login-box-large');
             $(this).removeClass('pm-widget-login-box-small');
        }
    });
    
    
    var profileArea = $('.pmagic').innerWidth();
    $('span#pm-cover-image-width').text(profileArea);
    $('.pm-cover-image').children('img').css('width', profileArea);
    if (profileArea < 550) {
        $('.pm-user-card, .pm-group, .pm-section').addClass('pm100');
    } else if (profileArea < 900) {
        $('.pm-user-card, .pm-group').addClass('pm50');
    } else if (profileArea >= 900) {
        $('.pm-user-card, .pm-group').addClass('pm33');
    }
    //Hover Image Change Menu
    $('.pm-cover-image, .pm-profile-image').hover(function() {
        $(this).children('.pg-profile-change-img').fadeIn();
    }, function() {
        $(this).children('.pg-profile-change-img').fadeOut();
    });
    //Profile Page Popup
    $('#pm-remove-image, #pm-change-image').click(function() {
        callPmPopup("#pm-change-image");
    });
    $('#pm-remove-cover-image, #pm-change-cover-image, #pm-coverimage-mask').click(function() {
        callPmPopup("#pm-change-cover-image");
    });
    $('#pm-change-password').click(function() {
        callPmPopup("#pm-change-password");
    });
    $('#pm-show-profile-image img').click(function(){
        callPmPopup("#pm-show-profile-image");
    });
    $('#pm-show-cover-image img').click(function(){
        callPmPopup("#pm-show-cover-image");
    });
    $('.pm-popup-close , .pm-popup-mask , .pg-group-setting-close-btn').click(function (){
       
        $('.pm-popup-mask').hide();
        $('.pm-popup-mask').next().hide();
    });
     // Sets all user cards equal height
    $('.pmagic').each(function(){  
        var highestBox = 0;
        $(this).find('.pm-user-card').each(function(){
            if($(this).height() > highestBox){  
                highestBox = $(this).height();  
            }
        });
        $(this).find('.pm-user-card.pm50, .pm-user-card.pm33').height(highestBox);
    });
    
    var showTotalChar = 250, showChar = pm_error_object.show_more, hideChar = pm_error_object.show_less;
    $('.pm_collapsable_textarea').each(function() 
    {
        var content = $(this).text();
        if (content.length > showTotalChar) 
        {
            var con = content.substr(0, showTotalChar);
            var hcon = content.substr(showTotalChar, content.length - showTotalChar);
            var txt= con +  '<span class="pm_morectnt"><span>' + hcon + '</span>&nbsp;&nbsp;<a href="" class="pm_showmoretxt">' + showChar + '</a></span>';
            $(this).html(txt);
        }
    });
    
    $(".pm_showmoretxt").click(function() 
    {
        if ($(this).hasClass("pm_sample")) 
        {
            $(this).removeClass("pm_sample");
            $(this).text(showChar);
        } 
        else 
        {
            $(this).addClass("pm_sample");
            $(this).text(hideChar);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
    
    $(".pmrow").has(".pm-col-spacer").addClass("pm-row-spacer");
    $(".pmrow").has(".pm-col-divider").addClass("pm-row-divider");
    
    var pmDomColor = $(".pmagic").find("a").css('color');
    $(".pm-section-nav-horizental .pm-profile-tab").append("<div class='pm-border-slide'></div>");
    $(".pm-section-nav-horizental .pm-border-slide").css('background', pmDomColor);
    jQuery(".pmagic #unread_notification_count").css('background-color', pmDomColor);
    
     // Sets all user cards equal height
    
    $('.pmagic').each(function()
    {  
        var highestBox = 0;
        $(this).find('.pm-user-card').each(function(){
            if($(this).height() > highestBox){  
                highestBox = $(this).height();  
            }
        })
        $(this).find('.pm-user-card.pm50, .pm-user-card.pm33').height(highestBox);
    });
    
    $(".pmagic").prepend("<a><a/>");
    var pmDomColor = $(".pmagic").find("a").css('color');
    $(".pm-color").css('color', pmDomColor);
    $( ".pmagic .page-numbers .page-numbers.current" ).addClass( "pm-bg" ).css('background', pmDomColor); 

    $('#change-pic').on('click', function(e) {
        $('#changePic').show();
        $('#change-pic').hide();
    });
    
    $('#photoimg').on('change', function() 
    { 
        $("#preview-avatar-profile").html('');
        $("#preview-avatar-profile").html('<div><div class="pm-loader"></div></div>');
        var pmDomColor = $(".pmagic").find("a").css('color');
        $(".pm-loader").css('border-top-color', pmDomColor);
        $('#avatar-edit-img').hide();
        $("#cropimage").ajaxForm({
        target: '#preview-avatar-profile',
        success: function()
                {
                    $("input[name='remove_image']").hide();
                    var error = $("#pg_profile_image_error").val();
                    if(error==1)
                    {
                        $("#btn-crop").hide();
                    }
                    else
                    {
                        $("#btn-crop").show();
                    }
                    $(".modal-footer").show();
                    var profileArea = 150;
                    var tw = $('#truewidth').val();
                    var th = $('#trueheight').val();
                    var x = 25/100*tw;
                    var y = 25/100*th;
                    if(x+profileArea>tw || y+profileArea>th)
                    {
                        x = 0;
                        y = 0;
                    }

                    if(profileArea>tw)
                    {
                        profileArea = tw;
                    } 

                    $('.jcrop-holder div div img').css('visibility','hidden');   
                    $('img#photo').Jcrop({
                       trueSize: [tw,th], 
                       aspectRatio: 1 / 1,
                       minSize:[profileArea,150], 
                       setSelect:   [ x,y,profileArea,150 ],
                       onSelect: updateCoords
                     });

                    $('#image_name').val($('#photo').attr('file-name'));
                }
        }).submit();

    });
    
    $('#btn-crop').on('click', function(e)
    {
        $(this).attr('disabled','disabled');
	    e.preventDefault();
	    var params = {
	            targetUrl: pm_ajax_object.ajax_url,
                    action: 'pm_upload_image',
	            status: 'save',
	            x: $('#x').val(),
	            y : $('#y').val(),
	            w: $('#w').val(),
	            h : $('#h').val(),
                    fullpath:$('#fullpath').val(),
                    user_id:$('#user_id').val(),
                    user_meta:$('#user_meta').val(),
                    attachment_id:$('#attachment_id').val()
	        };
                
            $.post(pm_ajax_object.ajax_url, params, function(response) 
            {
                if(response)
                {
                    $("#preview-avatar-profile").html(response);
                    location.reload(true);
                }	
            });		
	       
    });
    
    $('#btn-cancel').on('click', function(e)
    {
	    e.preventDefault();
	    var params = {
	            targetUrl: pm_ajax_object.ajax_url,
                    action: 'pm_upload_image',
	            status: 'cancel',
	            x: $('#x').val(),
	            y : $('#y').val(),
	            w: $('#w').val(),
	            h : $('#h').val(),
                    fullpath:$('#fullpath').val(),
                    user_id:$('#user_id').val(),
                    user_meta:$('#user_meta').val(),
                    attachment_id:$('#attachment_id').val()
	    };
                
            $.post(pm_ajax_object.ajax_url, params, function(response) 
            {
                if(response)
                {
                    location.reload(true);
                }
                else
                {
                    location.reload(true);
                }
            });		
	       
    });
    
    $('#change-cover-pic').on('click', function(e) {
        $('#changeCoverPic').show();
        $('#change-cover-pic').hide();
        $('#cover_minwidth').val($('.pmagic').innerWidth());
    });
    
    $('#coverimg').on('change', function() 
    { 
        $("#preview-cover-image").html('');
        $("#preview-cover-image").html('<div><div class="pm-loader"></div></div>');
        var pmDomColor = $(".pmagic").find("a").css('color');
        $(".pm-loader").css('border-top-color', pmDomColor);
        $("#cropcoverimage").ajaxForm({
            target: '#preview-cover-image',
            success:    function() { 
                            $('#cover-edit-img').hide();
                            $("input[name='remove_image']").hide();
                            var error = $("#pg_cover_image_error").val();
                            if(error==1)
                            {
                                $("#btn-cover-crop").hide();
                            }
                            else
                            {
                                $("#btn-cover-crop").show();
                            }

                            $(".modal-footer").show();
                            var profileArea = $('.pmagic').innerWidth();

                            var tw = $('#covertruewidth').val();
                            var th = $('#covertrueheight').val();

                            var x = 18/100*tw;
                            var y = 18/100*th;
                            if(x+profileArea>tw || y+300>th)
                            {
                                x = 0;
                                y = 0;
                            }

                            if(profileArea>tw)
                            {
                                profileArea = tw;
                            }   

                             $('img#coverimage').Jcrop({
                                trueSize: [tw,th], 
                                minSize:[profileArea,300], 
                                setSelect:   [ x,y,profileArea,300 ],
                                aspectRatio: profileArea/300,
                                onSelect: updateCoverCoords
                              });
                    }
        }).submit();
    });
    
    $('#btn-cover-crop').on('click', function(e)
    {
            $(this).attr('disabled','disabled');
	    e.preventDefault();
	    var params = {
	            targetUrl: pm_ajax_object.ajax_url,
                    action: 'pm_upload_cover_image',
	            cover_status: 'save',
	            x: $('#cx').val(),
	            y : $('#cy').val(),
	            w: $('#cw').val(),
	            h : $('#ch').val(),
                    fullpath:$('#coverfullpath').val(),
                    user_id:$('#user_id').val(),
                    user_meta:'pm_cover_image',
                    attachment_id:$('#cover_attachment_id').val()
	        };
            $.post(pm_ajax_object.ajax_url, params, function(response) {
                if(response)
                {
                    $("#preview-cover-image").html(response);
                    location.reload(true);
                }	
            });		
	       
    });
            
    $('#btn-cover-cancel').on('click', function(e)
    {
	    e.preventDefault();
	   var params = {
	            targetUrl: pm_ajax_object.ajax_url,
                    action: 'pm_upload_cover_image',
	            cover_status: 'cancel',
	            x: $('#cx').val(),
	            y : $('#cy').val(),
	            w: $('#cw').val(),
	            h : $('#ch').val(),
                    fullpath:$('#coverfullpath').val(),
                    user_id:$('#user_id').val(),
                    user_meta:$('#user_meta').val(),
                    attachment_id:$('#cover_attachment_id').val()
	        };
            $.post(pm_ajax_object.ajax_url, params, function(response) {
                if(response)
                {
                    //alert(response);
                    //$("#preview-avatar-profile").html(response);
                    location.reload(true);
                }
                else
                {
                    location.reload(true);
                }
            });		
	       
    });
    
    
    
    
//    $( "#sections" ).tabs(); 
//    $( "#pg-profile-tabs" ).tabs(); 
//    $( "#pg-friends-container" ).tabs();
//    $( "#pg-settings-container" ).tabs();
//    $("#pg_group_tabs").tabs();
//    $("#pg_group_setting").tabs();
        openParentTab();
    
    $(".pm-profile-tab a").click(function () {
        $("#pg-toggle-menu-close").prop('checked', false);
    });

    $(".pm-section-left-panel ul li a").click(function () {
        show_pg_section_right_panel();
    });

    $(".pg-mobile-479 .pm-section-right-panel").hide();
    
    $('#pm_submit_blog_page').on('click', function(e) {
        $('#pm-add-blog-dialog, .pm-popup-mask, .pg-blog-dialog-mask').toggle();
    });
    
     $('#pm-add-blog-dialog .pm-popup-close').on('click', function(e) {
        $('#pm-add-blog-dialog, .pm-popup-mask, .pg-blog-dialog-mask, #pm-edit-group-popup').hide();
    });
     var pmDomColor = $(".pmagic").find("a").css('color');
    $( ".pm-group-list-view-info span" ).css('background-color', pmDomColor); 
    $(".pmagic #pg_show_pending_post .pg-pending-posts").css('background-color', pmDomColor);
    $(".pmagic #pg_show_inbox .pg-rm-inbox").css('background-color', pmDomColor);
    $( ".pg-update-message svg" ).css('fill', pmDomColor); 
    $( ".pmagic .pg-group-filters-head .pg-sort-view input:checked+label svg" ).css('fill', pmDomColor); 
    
    
    $(document).on('click','.pm-blog-pagination ul li .page-numbers',function(event){
        event.preventDefault();
      // console.log($(this).text());
       var link = $(this).attr("href");
       if(link !== undefined)
       {
           var newpagenum =link.split('pagenum=')[1];
           pm_get_all_user_blogs_from_group(newpagenum);
       }
    });
    
    
    $(document).on('click','.pm-member-pagination ul li .page-numbers',function(event){
        event.preventDefault();
      // console.log($(this).text());
       var link = $(this).attr("href");
       if(link !== undefined)
       {
           var newpagenum =link.split('pagenum=')[1];
           pm_get_all_users_from_group(newpagenum);
       }
    });
    
    $(document).on('click','.pm-member-pagination-grid ul li .page-numbers',function(event){
        event.preventDefault();
      // console.log($(this).text());
       var link = $(this).attr("href");
       if(link !== undefined)
       {
           var newpagenum =link.split('pagenum=')[1];
           pm_get_all_users_from_group_grid_view(newpagenum,'grid');
       }
    });
    
     $(document).on('click','.pm-groups-pagination ul li .page-numbers',function(event){
        event.preventDefault();
      // console.log($(this).text());
       var link = $(this).attr("href");
       if(link !== undefined)
       {
           var newpagenum =link.split('pagenum=')[1];
           pm_get_all_groups(newpagenum);
       }
    });
    
    $(document).on('click','.pm-request-pagination ul li .page-numbers',function(event){
        event.preventDefault();
      // console.log($(this).text());
       var link = $(this).attr("href");
       if(link !== undefined)
       {
           var newpagenum =link.split('pagenum=')[1];
           pm_get_all_requests_from_group(newpagenum);
       }
    });
    
    
    $(document).on('click','#pg-myfriends ul li .page-numbers',function(event){
        event.preventDefault();
      // console.log(jQuery(this).text());
       var link = $(this).attr("href");
       if(link !== undefined)
       {
           var newpagenum =link.split('pagenum=')[1];
           //alert(newpagenum);
           var uid = $('#pm-uid').val();
           pm_get_my_friends(newpagenum,uid);
       }
    });

    
    $(document).on('click','#pg-requests-sent ul li .page-numbers',function(event){
        event.preventDefault();
      // console.log(jQuery(this).text());
       var link = $(this).attr("href");
       if(link !== undefined)
       {
           var newpagenum =link.split('pagenum=')[1];
           //alert(newpagenum);
           var uid = $('#pm-uid').val();
           pm_get_friend_requests_sent(newpagenum,uid);
       }
    });
    
    
    $(document).on('click','#pg-friend-requests ul li .page-numbers',function(event){
        event.preventDefault();
      // console.log(jQuery(this).text());
       var link = $(this).attr("href");
       if(link !== undefined)
       {
           var newpagenum =link.split('pagenum=')[1];
           //alert(newpagenum);
           var uid = $('#pm-uid').val();
           pm_get_friend_requests(newpagenum,uid);
       }
    });

//*---Get group setting Width--- *//

if(show_rm_sumbmission_tab.registration_tab==1){
    setTimeout(function(){ $('[href="#pg-settings"]').trigger('click'); }, 2000);
    setTimeout(function(){ $('[href="#pg_rm_registration_tab"]').trigger('click'); }, 3000);
}

})(jQuery);

