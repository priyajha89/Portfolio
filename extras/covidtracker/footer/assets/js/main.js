(function ($) {
    "use strict";

    /*	Table OF Contents
	==========================
	
	1-Navigation
	2-Sticky
	3-sliders
	4-Blog layout
	5-Contact
	6-Portfolio Filtring/Popup
	7-Animations
	8-Statistics Handling (Records)
	9-Google Maps
  /*===================
    1-Navigation
    ===================*/

    var leftPos, newWidth, isNavClicked = false,
        $mainNav_animate = $(".navbar-nav");

    $mainNav_animate.append("<li id='XV-lamp'></li>");
    var $animation_tool = $("#XV-lamp");

    $animation_tool
        .width($(".active").width())
        .css("left", $(".active").position().left)
        .data("origLeft", $(".active").position().left)
        .data("origWidth", $animation_tool.width());

    function xv_lava($el, speed) {
        leftPos = $el.position().left;
        newWidth = $el.width();
        $animation_tool.stop().animate({
            left: leftPos,
            width: newWidth,
        }, speed);
    }

    $(".navbar-nav a[href^='#']").click(function () {
        isNavClicked = true;
        $('.navbar-nav li').removeClass('active');
        $(this).parent().addClass('active');
        xv_lava($(this).parent(), 1000);
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top - 30
        }, 1500, function () {
            isNavClicked = false;
        });
        return false;
    });

    $(window).scroll(function () {
        if (!isNavClicked) {
            xv_lava($(".navbar-nav li.active"), 800);
        }
        if ($(window).scrollTop() >= 100) {


            if (!$("#sticktop").hasClass('slideInDown')) {
                $("#sticktop").addClass('animated slideInDown nav-shadow').removeClass('stickyNav');
            }
        } else if ($(window).scrollTop() <= 1) {
            if ($("#sticktop").hasClass('slideInDown')) {
                $("#sticktop").removeClass('animated slideInDown nav-shadow').addClass('stickyNav');
            }
        }

    });

    $('.navbar-nav li').hover(
        function () {
            if (!$(this).parents().hasClass('dropdown-menu')) {
                xv_lava($(this), 400);
            }
        }, function () {
            xv_lava($(".navbar-nav li.active"), 400);
        });


    $('ul.nav li.dropdown').click(
        function () {

            var state = $(this).data('toggleState');
            if (state) {
                $(this).children('ul.dropdown-menu').slideUp();
            } else {
                $(this).children('ul.dropdown-menu').slideDown();
            }
            $(this).data('toggleState', !state);
        });


    /*===================
    2-Sticky
    ===================*/
    $(window).on("resize", function () {
        xv_lava($(".navbar-nav li.active"), 100);
		if( !$('#sticktop').hasClass('nav-stop')){
			$("#sticktop").sticky({topSpacing: 0});
		}
    }).resize();

    /*===================
    3- sliders
    ===================*/
	$('.about-wrapper').waitForImages(function () {
		$('.about-wrapper').carouFredSel({
			width: "100%",
			circular: false,
			infinite: false,
			auto: false,
			scroll: {
				items: 1,
				easing: "linear"
			},
			prev: {
				button: "#phase-prev",
				key: "left"
			},
			next: {
				button: "#phase-next",
				key: "right"
			}
		});
	});
	 $('.team-wrapper').waitForImages(function () {
		$('.team-wrapper').carouFredSel({
			width: "100%",
			circular: false,
			auto: false,
			scroll: {
				items: 1,
				easing: "linear"
			},
			prev: {
				button: "#member-prev",
				key: "left"
			},
			next: {
				button: "#member-next",
				key: "right"
			}
		});
	 });

    $('#home-slider').flexslider({
        animation: "slide",
        directionNav: false,
        controlNav: true,
        pauseOnHover: true,
        slideshowSpeed: 4000,
        direction: "horizontal" //Direction of slides
    });
	 $('.flex-control').show();
            var $tweetlSlides = $('#home-slider');
            $('#flex-next').click(function () {
                $tweetlSlides.flexslider("next");
            });
            $('#flex-prev').click(function () {
                $tweetlSlides.flexslider("prev");
            });



    /*===================
	4 - Blog layout
	===================*/

    function onImagesLoaded($container, callback) {
        $container.before("<div class='load-img'></div>");
        var $images = $container.find("img");
        var imgCount = $images.length;
        if (!imgCount) {
            $('.load-img').hide();
            callback();
        } else {
            $("img", $container).each(function () {
                $(this).one("load error", function () {
                    imgCount--;
                    if (imgCount === 0) {
                        $('.load-img').hide();
                        callback();
                    }
                });
                if (this.complete) $(this).load();
            });
        }
    }

    onImagesLoaded($(".masonry-container"), function () {

        var $container = $('.masonry-container');
        $container.show();
        $container.masonry({
            itemSelector: '.post-unit'
        });

    });

    $('a.add-reply').click(function () {
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top - 70
        }, 1000);
        return false;
    });

    /*===================
    5 - Contact
    ===================*/

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }


    $("#contactform").submit(function () {
        var name = $("#name").val();
        var email = $("#email").val();
        var subject = $("#subject").val();
        var message = $("#message").val();
        var dataString = 'name=' + name + '&email=' + email + '&subject=' + subject + '&message=' + message;

        if (name === '' || !IsEmail(email) || subject === '' || message === '') {
            $('#valid-issue').html('Please Provide Valid Information').show();
        } else {
            $.ajax({
                type: "POST",
                url: "assets/php/submit.php",
                data: dataString,
                success: function () {
                    $('#contactform').hide();
                    $('#valid-issue').html('Your message has been sent,<BR> We will contact you back with in next 24 hours.').show();
                }
            });
        }
        return false;
    });


    /*===================
    6 -Portfolio Filtring/Popup
    ===================*/
    $('#Grid').mixitup({
        targetSelector: '.project',
        effects: ['scale'],
        easing: 'snap',
        transitionSpeed: 500,
    });

    $("a[data-rel^='prettyPhoto']").prettyPhoto();

    /*===================
    7 - Animations
    ===================*/


    $('.work-phase .hover').hover(function (e) {
        $(this).children('h2').addClass('fadeInDown animated');
        $(this).children('.btn').addClass('fadeInUpBig animated');
        $(this).children('span').addClass('bounceInDown animated');
    }, function (e) {
        $(this).children('h2').removeClass('fadeInDown animated');
        $(this).children('.btn').removeClass('fadeInUpBig animated');
        $(this).children('span').removeClass('bounceInDown animated');
    });

    $('.flip-container').eq(0).addClass('hover');

    $('.flip-container').hover(function () {
        $('.flip-container').removeClass('hover');
        $(this).addClass('hover');
    });
	
	


    $('.record').bind('inview', function (event, visible) {
        if (visible === true) {
            if (!$('.record').hasClass('animated')) {
                growRecords();
            }
            $('.record').addClass('fadeInRight animated');
        }
    });

    /*================================
	8 - Statistics Handling (Records)
	================================*/
    function growRecords() {
        $('#records .stat').each(function () {
            var container = $(this);
            var total = container.attr('data-total');
            looper(total, container, 1200);
        });
    }

    function looper(total, target, duration) {
        if (duration) {
            var counter = 1;
            var speed = parseInt(duration / total);
            var interval = setInterval(function () {
                if (counter <= total) {
                    target.html(counter);
                } else {
                    target.html(total);
                    clearInterval(interval);
                }
                counter++;
            }, speed);
        } else {
            target.html(total);
        }
    }

    
	
	/*============Ajax===============*/
	 var active, next_project, prev_project,
        target, hash, url, page, projectIndex,
        xv_scrollTo,
        projectLength,
        ajaxLoading = false,
        xv_projectHeight,
        content = false,
        xv_projects = $('.projects'),
        easing = 'easeOutExpo',
        nav_height = $('#sticktop').height(),
        loader = $('.ajax-loader'),
        projectContainer = $('.ajax-content'),
        projectNav = $('.folio-nav ul'),
        exitProject = $('#folio-close');

    $('.folio-nav ul').fadeOut();

    $(window).bind('hashchange', function () {
        hash = $(window.location).attr('hash');
        var root = '#';
        var rootLength = root.length;
        if (hash.substr(0, rootLength) != root) {
            return;
        } else {
            hash = $(window.location).attr('hash');
            url = hash.replace(/[#]/g, '');

            $('.ajax-project a').click(function () {
                $('.ajax-project').removeClass('active');
                $(this).parents('.ajax-project').addClass('active');
            });

            $('#portfolio').find('.projects.active-folio').removeClass('active-folio');
            $('#portfolio').find('.ajax-holder.ajax-action').removeClass('ajax-action');
            xv_projects.find('.ajax-project a[href="#' + url + '"]').parents('.ajax-project').addClass('active');
            xv_projects.find('.ajax-project.active').find('a[href="#' + url + '"]').addClass('active');
            xv_projects.find('.ajax-project a[href="#' + url + '"]').parents('.projects').addClass('active-folio');

            $('.ajax-holder').addClass('ajax-action');
            if (hash.substr(0, rootLength) == root) {
                jQuery('html,body').stop().animate({
                    scrollTop: (projectContainer.offset().top - 20) + 'px'
                }, 800, 'easeOutExpo', function () {
                    loadProject();
                });
            } else if (hash.substr(0, rootLength) == root) {

                jQuery('html,body').stop().animate({
                    scrollTop: (projectContainer.offset().top - nav_height + 100) + 'px'
                }, 800, 'easeOutExpo', function () {

                    if (content == false) {
                        loadProject();
                    } else {
                        projectContainer.animate({
                            opacity: 0,
                            height: xv_projectHeight
                        }, function () {
                            loadProject();
                        });
                    }
                    projectNav.fadeOut('100');
                });
            } else if (hash == '' || hash.substr(0, rootLength) != root || hash.substr(0, rootLength) != root) {
                xv_scrollTo = hash;
                $('html,body').stop().animate({
                    scrollTop: xv_scrollTo + 'px'
                }, 1000, function () {
                    XV_ajaxClose();
                });
            }
        }
    });

    function loadProject() {
        loader.fadeIn().removeClass('projectError').html('');
        if (!ajaxLoading) {
            ajaxLoading = true;
            projectContainer.load(url + ' div#ajaxpage', function (xhr, statusText, request) {
                if (statusText == "success") {
                    ajaxLoading = false;
                    page = $('#ajaxpage');
                    $('#ajaxpage').waitForImages(function () {
                        loader.delay(300).fadeOut(function () {
							showProject();
							
                        });
                    });
                }
                if (statusText == "error") {
                    loader.addClass('projectError').append("<p>Loading Error!</p>").slideDown();
                }
            });
        }
    }

    function showProject() {
        xv_projectHeight = projectContainer.children('#ajaxpage').outerHeight() + 'px';
        if (content == false) {
            xv_projectHeight = projectContainer.children('#ajaxpage').outerHeight() + 'px';
            projectContainer.animate({
                opacity: 1,
                height: xv_projectHeight
            }, function () {
                xv_scrollTo = $('html,body').scrollTop();
                projectNav.fadeIn();
                content = true;
            });
        } else {
            xv_projectHeight = projectContainer.children('#ajaxpage').outerHeight() + 'px';
            projectContainer.animate({
                opacity: 1,
                height: xv_projectHeight
            }, function () {
                xv_scrollTo = $('html,body').scrollTop();
                projectNav.fadeIn();
            });
        }
        projectIndex = xv_projects.find('.ajax-project.active').index();
        projectLength = $('.ajax-project a').length - 1;
        if (projectIndex == projectLength) {
            $('#folio-next').addClass('disabled');
            $('#folio-prev').removeClass('disabled');
        } else if (projectIndex == 0) {
            $('#folio-prev').addClass('disabled');
            $('#folio-next').removeClass('disabled');
        } else {
            $('#folio-next, #folio-prev').removeClass('disabled');
        }
    }

    function XV_ajaxClose(closeURL) {
        projectNav.fadeOut();
        projectContainer.animate({
            opacity: 0,
            height: '0px'
        }, 800, 'easeOutExpo');
        projectContainer.empty();
        $('html,body').stop().animate({
            scrollTop: projectContainer.offset().top - nav_height - 100
        });
        $('#portfolio').find('.projects.active-folio').removeClass('active-folio');
        $('#portfolio').find('.ajax-holder.ajax-action').removeClass('ajax-action');
    }
    $('#folio-next').on('click', function () {
        active = xv_projects.find('.ajax-project.active');
        next_project = active.next('.ajax-project');
        target = $(next_project).find('.ajax-btn').attr('href');
        $(this).attr('href', target);
        if (next_project.length === 0) {
            return false;
        }
        active.removeClass('active');
        next_project.addClass('active');
		
    });
    $('#folio-prev').on('click', function () {
        active = xv_projects.find('.ajax-project.active');
        prev_project = active.prev('.ajax-project');
        target = $(prev_project).find('.ajax-btn').attr('href');
        $(this).attr('href', target);
        if (prev_project.length === 0) {
            return false;
        }
        active.removeClass('active');
        prev_project.addClass('active');
		
    });
    $('#folio-close').on('click', function () {
        var xv_loader = $('.ajax-action').children('.ajax-loader');
        XV_ajaxClose($(this).attr('href'));
        xv_loader.fadeOut();
        return false;
    });
	
	$('.carousel').carousel();
	
	
	
	
	/*================================
	9-Google Maps
	================================*/

    if ($('#contact-map').length) {
        var contact_map = 'contact-map',
            mapAddress = $('#contact-map').data('address'),
            mapType = $('#contact-map').data('maptype'),
            zoomLvl = $('#contact-map').data('zoomlvl');
        contactemaps(contact_map, mapAddress, mapType, zoomLvl);

    }

    function contactemaps(selector, address, type, zoom_lvl) {
        var map = new google.maps.Map(document.getElementById(selector), {
            mapTypeId: google.maps.MapTypeId.type,
            scrollwheel: false,
            draggable: false,
            zoom: zoom_lvl,
        });
        var map_pin = "assets/img/basic/map-pin.png";
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
                'address': address
            },
            function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: map,
                        icon: map_pin
                    });
                    map.setCenter(results[0].geometry.location);
                }
            });
    }



})(jQuery);