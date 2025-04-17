<?php

/**
 * @package Total
 */
function total_dymanic_styles() {

    $dynamic_css = apply_filters('total_dynamic_styles', '__return_true');
    if (!$dynamic_css)
        return;

    $custom_css = $tablet_css = $mobile_css = "";
    $color = get_theme_mod('total_template_color', '#FFC107');
    $color_rgba = total_hex2rgba($color, 0.9);
    $darker_color = total_color_brightness($color, -0.9);

    $sidebar_width = get_theme_mod('total_sidebar_width', 30);
    $primary_width = 100 - 4 - $sidebar_width;

    $website_layout = get_theme_mod('total_website_layout', 'wide');
    if ($website_layout == 'wide') {
        $container_width = get_theme_mod('total_wide_container_width', 1170);
    } elseif ($website_layout == 'fluid') {
        $container_width = get_theme_mod('total_fluid_container_width', 80);
    } elseif ($website_layout == 'boxed') {
        $container_padding = get_theme_mod('total_container_padding', 80);
        $container_width = get_theme_mod('total_wide_container_width', 1170);
        $boxed_container_width = $container_width - $container_padding - $container_padding;
    }

    /* =============== Full & Boxed width =============== */
    if ($website_layout == "wide") {
        $custom_css .= "
	.ht-container{
            width:{$container_width}px; 
	}";
    } else if ($website_layout == "boxed") {
        $custom_css .= "
        .ht-container{
            width:{$boxed_container_width}px; 
        }
        body.ht-boxed #ht-page{
            width:{$container_width}px;
	}";
    } else if ($website_layout == "fluid") {
        $custom_css .= "
        .ht-container{
            width:{$container_width}%; 
        }";
    }

    $custom_css .= "
        #primary{ width:{$primary_width}%}
        #secondary{ width:{$sidebar_width}%}
	";

    /* =============== Primary Color CSS =============== */
    $custom_css .= "
    button,
    input[type='button'],
    input[type='reset'],
    input[type='submit'],
    body div.wpforms-container-full .wpforms-form input[type=submit], 
    body div.wpforms-container-full .wpforms-form button[type=submit], 
    body div.wpforms-container-full .wpforms-form .wpforms-page-button,
    .widget-area .widget-title:after,
    .comment-reply-title:after,
    .comments-title:after,
    .nav-previous a,
    .nav-next a,
    .pagination .page-numbers,
    .ht-menu > ul > li.menu-item:hover > a,
    .ht-menu > ul > li.menu-item.current_page_item > a,
    .ht-menu > ul > li.menu-item.current-menu-item > a,
    .ht-menu > ul > li.menu-item.current_page_ancestor > a,
    .ht-menu > ul > li.menu-item.current > a,
    .ht-menu ul ul li.menu-item:hover > a,
    .ht-slide-cap-title span,
    .ht-progress-bar-length,
    #ht-featured-post-section,
    .ht-featured-icon,
    .ht-service-post-wrap:after,
    .ht-service-icon,
    .ht-team-social-id a,
    .ht-counter:after,
    .ht-counter:before,
    .ht-testimonial-wrap  .owl-carousel .owl-nav .owl-prev, 
    .ht-testimonial-wrap  .owl-carousel .owl-nav .owl-next,
    .ht-blog-read-more a,
    .ht-cta-buttons a.ht-cta-button1,
    .ht-cta-buttons a.ht-cta-button2:hover,
    #ht-back-top:hover,
    .entry-readmore a,
    .woocommerce #respond input#submit, 
    .woocommerce a.button, 
    .woocommerce button.button, 
    .woocommerce input.button,
    .woocommerce ul.products li.product:hover .button,
    .woocommerce ul.products li.product:hover .added_to_cart,
    .woocommerce #respond input#submit.alt, 
    .woocommerce a.button.alt, 
    .woocommerce button.button.alt, 
    .woocommerce input.button.alt,
    .woocommerce nav.woocommerce-pagination ul li a, 
    .woocommerce nav.woocommerce-pagination ul li span,
    .woocommerce span.onsale,
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
    .woocommerce #respond input#submit.disabled, 
    .woocommerce #respond input#submit:disabled, 
    .woocommerce #respond input#submit:disabled[disabled], 
    .woocommerce a.button.disabled, .woocommerce a.button:disabled, 
    .woocommerce a.button:disabled[disabled], 
    .woocommerce button.button.disabled, 
    .woocommerce button.button:disabled, 
    .woocommerce button.button:disabled[disabled], 
    .woocommerce input.button.disabled, 
    .woocommerce input.button:disabled, 
    .woocommerce input.button:disabled[disabled],
    .woocommerce #respond input#submit.alt.disabled, 
    .woocommerce #respond input#submit.alt.disabled:hover, 
    .woocommerce #respond input#submit.alt:disabled, 
    .woocommerce #respond input#submit.alt:disabled:hover, 
    .woocommerce #respond input#submit.alt:disabled[disabled], 
    .woocommerce #respond input#submit.alt:disabled[disabled]:hover, 
    .woocommerce a.button.alt.disabled, 
    .woocommerce a.button.alt.disabled:hover, 
    .woocommerce a.button.alt:disabled, 
    .woocommerce a.button.alt:disabled:hover, 
    .woocommerce a.button.alt:disabled[disabled], 
    .woocommerce a.button.alt:disabled[disabled]:hover, 
    .woocommerce button.button.alt.disabled, 
    .woocommerce button.button.alt.disabled:hover, 
    .woocommerce button.button.alt:disabled, 
    .woocommerce button.button.alt:disabled:hover, 
    .woocommerce button.button.alt:disabled[disabled], 
    .woocommerce button.button.alt:disabled[disabled]:hover, 
    .woocommerce input.button.alt.disabled, 
    .woocommerce input.button.alt.disabled:hover, 
    .woocommerce input.button.alt:disabled, 
    .woocommerce input.button.alt:disabled:hover, 
    .woocommerce input.button.alt:disabled[disabled], 
    .woocommerce input.button.alt:disabled[disabled]:hover,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
    .woocommerce-MyAccount-navigation-link a
    {
        background:{$color};
    }

    a,
    a:hover, 
    .woocommerce .woocommerce-breadcrumb a:hover, 
    .breadcrumb-trail a:hover,
    .ht-post-info .entry-date span.ht-day,
    .entry-categories i,
    .widget-area a:hover,
    .comment-list a:hover,
    .no-comments,
    .woocommerce .woocommerce-breadcrumb a:hover,
    #total-breadcrumbs a:hover,
    .ht-featured-link a,
    .ht-portfolio-cat-name-list i,
    .ht-portfolio-cat-name:hover, 
    .ht-portfolio-cat-name.active,
    .ht-portfolio-caption a,
    .ht-team-detail,
    .ht-counter-icon,
    .woocommerce ul.products li.product .price,
    .woocommerce div.product p.price, 
    .woocommerce div.product span.price,
    .woocommerce .product_meta a:hover,
    .woocommerce-error:before, 
    .woocommerce-info:before, 
    .woocommerce-message:before{
        color:{$color};
    }

    .ht-menu ul ul,
    .ht-featured-link a,
    .ht-counter,
    .ht-testimonial-wrap .owl-carousel .owl-item img,
    .ht-blog-post,
    #ht-colophon,
    .woocommerce ul.products li.product:hover, 
    .woocommerce-page ul.products li.product:hover,
    .woocommerce #respond input#submit, 
    .woocommerce a.button, 
    .woocommerce button.button, 
    .woocommerce input.button,
    .woocommerce ul.products li.product:hover .button,
    .woocommerce ul.products li.product:hover .added_to_cart,
    .woocommerce #respond input#submit.alt, 
    .woocommerce a.button.alt, 
    .woocommerce button.button.alt, 
    .woocommerce input.button.alt,
    .woocommerce div.product .woocommerce-tabs ul.tabs,
    .woocommerce #respond input#submit.alt.disabled, 
    .woocommerce #respond input#submit.alt.disabled:hover, 
    .woocommerce #respond input#submit.alt:disabled, 
    .woocommerce #respond input#submit.alt:disabled:hover, 
    .woocommerce #respond input#submit.alt:disabled[disabled], 
    .woocommerce #respond input#submit.alt:disabled[disabled]:hover, 
    .woocommerce a.button.alt.disabled, 
    .woocommerce a.button.alt.disabled:hover, 
    .woocommerce a.button.alt:disabled, 
    .woocommerce a.button.alt:disabled:hover, 
    .woocommerce a.button.alt:disabled[disabled], 
    .woocommerce a.button.alt:disabled[disabled]:hover, 
    .woocommerce button.button.alt.disabled, 
    .woocommerce button.button.alt.disabled:hover, 
    .woocommerce button.button.alt:disabled, 
    .woocommerce button.button.alt:disabled:hover, 
    .woocommerce button.button.alt:disabled[disabled], 
    .woocommerce button.button.alt:disabled[disabled]:hover, 
    .woocommerce input.button.alt.disabled, 
    .woocommerce input.button.alt.disabled:hover, 
    .woocommerce input.button.alt:disabled, 
    .woocommerce input.button.alt:disabled:hover, 
    .woocommerce input.button.alt:disabled[disabled], 
    .woocommerce input.button.alt:disabled[disabled]:hover,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle
    {
        border-color: {$color};
    }

    .woocommerce-error, 
    .woocommerce-info, 
    .woocommerce-message{
        border-top-color: {$color};
    }

    .nav-next a:after{
        border-left-color: {$color};
    }

    .nav-previous a:after{
        border-right-color: {$color};
    }

    .ht-active .ht-service-icon{
        box-shadow: 0px 0px 0px 2px #FFF, 0px 0px 0px 4px {$color};
    }

    .woocommerce ul.products li.product .onsale:after{
        border-color: transparent transparent {$darker_color} {$darker_color};
    }

    .woocommerce span.onsale:after{
        border-color: transparent {$darker_color} {$darker_color} transparent
    }

    .ht-portfolio-caption,
    .ht-team-member-excerpt,
    .ht-title-wrap{
        background:{$color_rgba}
    }

    @media screen and (max-width: 1000px){
        .toggle-bar{
            background:{$color}
        }   
    }";

    $total_enable_header_border = get_theme_mod('total_enable_header_border', true);
    $total_enable_footer_border = get_theme_mod('total_enable_footer_border', true);

    if ($total_enable_header_border) {
        $custom_css .= ".ht-header{border-top: 4px solid {$color}}";
    }

    if ($total_enable_footer_border) {
        $custom_css .= "#ht-colophon{border-top: 4px solid {$color}}";
    }
    /* =============== Typography CSS =============== */
    $custom_css .= total_typography_css('total_body', 'html, body, button, input, select, textarea', array(
        'family' => 'Poppins',
        'style' => '400',
        'text_transform' => 'none',
        'text_decoration' => 'none',
        'size' => '16',
        'line_height' => '1.6',
        'letter_spacing' => '0',
        'color' => '#444444'
    ));

    $custom_css .= total_typography_css('total_menu', '.ht-menu > ul > li > a', array(
        'family' => 'Oswald',
        'style' => '400',
        'text_transform' => 'uppercase',
        'text_decoration' => 'none',
        'size' => '14',
        'line_height' => '2.6',
        'letter_spacing' => '0'
    ));

    $custom_css .= total_typography_css('total_h', 'h1, h2, h3, h4, h5, h6, .ht-site-title, .ht-slide-cap-title, .ht-counter-count', array(
        'family' => 'Oswald',
        'style' => '400',
        'text_transform' => 'none',
        'text_decoration' => 'none',
        'line_height' => '1.3',
        'letter_spacing' => '0'
    ));

    $i_font_size = get_theme_mod('total_menu_font_size', '14');
    $i_font_family = get_theme_mod('total_menu_family', 'Oswald');
    $custom_css .= ".ht-menu ul ul{
            font-size: {$i_font_size}px;
            font-family: {$i_font_family};
	}";


    $content_header_color = get_theme_mod('total_content_header_color', '#000000');
    $content_text_color = get_theme_mod('total_content_text_color', '#333333');
    $content_link_color = get_theme_mod('total_content_link_color', '#000000');
    $content_link_hov_color = get_theme_mod('total_content_link_hov_color');

    $custom_css .= ".ht-main-content h1, .ht-main-content h2, .ht-main-content h3, .ht-main-content h4, .ht-main-content h5, .ht-main-content h6 {color:$content_header_color}";
    $custom_css .= ".ht-main-content{color:$content_text_color}";
    $custom_css .= "a{color:$content_link_color}";
    if ($content_link_hov_color) {
        $custom_css .= "a:hover, .woocommerce .woocommerce-breadcrumb a:hover, .breadcrumb-trail a:hover{color:$content_link_hov_color}";
    }

    /* =============== Site Title & Tagline Color =============== */
    $title_color = get_theme_mod('total_title_color', '#333333');
    $tagline_color = get_theme_mod('total_tagline_color', '#333333');
    $custom_css .= ".ht-site-title a, .ht-site-title a:hover{color:$title_color}";
    $custom_css .= ".ht-site-description a, .ht-site-description a:hover{color:$tagline_color}";

    $logo_width = get_theme_mod('total_logo_width');
    $logo_width_tablet = get_theme_mod('total_logo_width_tablet');
    $logo_width_mobile = get_theme_mod('total_logo_width_mobile');

    if ($logo_width === 0 || $logo_width) {
        $custom_css .= "#ht-site-branding img.custom-logo{width:{$logo_width}px}";
    }

    if ($logo_width_tablet === 0 || $logo_width_tablet) {
        $tablet_css .= "#ht-site-branding img.custom-logo{width:{$logo_width_tablet}px}";
    }

    if ($logo_width_mobile === 0 || $logo_width_mobile) {
        $mobile_css .= "#ht-site-branding img.custom-logo{width:{$logo_width_mobile}px}";
    }

    /* =============== Site Title & Tagline Color =============== */
    $mh_bg_color = get_theme_mod('total_mh_bg_color') ? get_theme_mod('total_mh_bg_color') : '#FFF';
    $custom_css .= ".ht-site-header .ht-header{background-color:{$mh_bg_color}}";
    $custom_css .= total_dimension_css('total_mh_spacing', array(
        'position' => array('left', 'top', 'bottom', 'right'),
        'selector' => '.ht-header .ht-container',
        'type' => 'padding',
        'unit' => 'px',
        'responsive' => false
    ));

    /* =============== Primary Menu  =============== */
    $menu_link_color = get_theme_mod('total_pm_menu_link_color');
    $menu_link_hover_color = get_theme_mod('total_pm_menu_link_hover_color');
    $menu_link_hover_bg_color = get_theme_mod('total_pm_menu_hover_bg_color');
    $submenu_bg_color = get_theme_mod('total_pm_submenu_bg_color');
    $submenu_link_color = get_theme_mod('total_pm_submenu_link_color');
    $submenu_link_hover_color = get_theme_mod('total_pm_submenu_link_hover_color');
    $submenu_link_hover_bg_color = get_theme_mod('total_pm_submenu_link_bg_color');

    if ($menu_link_color) {
        $custom_css .= "
        .ht-menu > ul > li.menu-item > a{
            color: $menu_link_color;
        }";
    }

    if ($menu_link_color) {
        $custom_css .= "
        .ht-menu > ul > li.menu-item:hover > a,
        .ht-menu > ul > li.menu-item.current_page_item > a,
        .ht-menu > ul > li.menu-item.current-menu-item > a,
        .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .ht-menu > ul > li.menu-item.current > a{
            color: $menu_link_hover_color;
        }";
    }

    if ($menu_link_hover_bg_color) {
        $custom_css .= "
        .ht-menu > ul > li.menu-item:hover > a,
        .ht-menu > ul > li.menu-item.current_page_item > a,
        .ht-menu > ul > li.menu-item.current-menu-item > a,
        .ht-menu > ul > li.menu-item.current_page_ancestor > a,
        .ht-menu > ul > li.menu-item.current > a{
            background-color: $menu_link_hover_bg_color;
        }";
    }

    if ($submenu_bg_color) {
        $custom_css .= "  
        .ht-menu ul ul{
            background-color: $submenu_bg_color;
        }";
    }

    if ($submenu_link_color) {
        $custom_css .= ".ht-menu ul ul li.menu-item > a{
            color: $submenu_link_color;
        }";
    }

    if ($submenu_link_hover_color) {
        $custom_css .= ".ht-menu ul ul li.menu-item:hover > a{
            color: $submenu_link_hover_color;
         }";
    }

    if ($submenu_link_hover_bg_color) {
        $custom_css .= ".ht-menu ul ul li.menu-item:hover > a{
            background-color: $submenu_link_hover_bg_color;
        }";
    }

    $custom_css .= "
        @media screen and (max-width: 1000px){
            #ht-site-navigation .ht-menu{background-color: $submenu_bg_color;}
            .ht-menu > ul > li.menu-item > a{color: $submenu_link_color;}
            .ht-menu > ul > li.menu-item:hover > a, 
            .ht-menu > ul > li.menu-item.current_page_item > a, 
            .ht-menu > ul > li.menu-item.current-menu-item > a, 
            .ht-menu > ul > li.menu-item.current_page_ancestor > a, 
            .ht-menu > ul > li.menu-item.current > a{
                color: $submenu_link_hover_color;
                background-color: $submenu_link_hover_bg_color;
            }
            
        }
        ";

    /* =============== Footer Settings =============== */
    $top_footer_title_color = get_theme_mod('total_top_footer_title_color', '#EEEEEE');
    $top_footer_text_color = get_theme_mod('total_top_footer_text_color', '#EEEEEE');
    $top_footer_anchor_color = get_theme_mod('total_top_footer_anchor_color', '#EEEEEE');
    $top_footer_anchor_color_hover = get_theme_mod('total_top_footer_anchor_color_hover');
    $bottom_footer_text_color = get_theme_mod('total_bottom_footer_text_color', '#EEEEEE');
    $bottom_footer_anchor_color = get_theme_mod('total_bottom_footer_anchor_color', '#EEEEEE');
    $bottom_footer_anchor_color_hover = get_theme_mod('total_bottom_footer_anchor_color_hover');
    $bottom_footer_bg_color = get_theme_mod('total_bottom_footer_bg_color');

    $custom_css .= total_background_css('total_footer_bg', '#ht-colophon', array(
        'url' => get_template_directory_uri() . '/images/footer-bg.jpg',
        'repeat' => 'repeat',
        'size' => 'auto',
        'position' => 'center-center',
        'attachment' => 'scroll',
        'color' => '#222222',
        'overlay' => ''
    ));

    $custom_css .= "
    .ht-main-footer .widget-title{
        color: {$top_footer_title_color};
    }

    .ht-main-footer .ht-footer{
        color: {$top_footer_text_color};
    }

    .ht-main-footer a{
        color: {$top_footer_anchor_color};
    }";

    if ($top_footer_anchor_color_hover) {
        $custom_css .= "
        .ht-main-footer a:hover{
            color: {$top_footer_anchor_color_hover};
        }";
    }

    $custom_css .= "
    #ht-bottom-footer{
        color: {$bottom_footer_text_color};
    }

    #ht-bottom-footer a{
        color: {$bottom_footer_anchor_color};
    }";

    if ($bottom_footer_anchor_color_hover) {
        $custom_css .= "
        #ht-bottom-footer a:hover{
            color: {$bottom_footer_anchor_color_hover};
        }";
    }

    if ($bottom_footer_bg_color) {
        $custom_css .= "#ht-bottom-footer{background-color:$bottom_footer_bg_color}";
    }

    /* =============== Front Page Sections =============== */
    $total_service_left_bg = get_theme_mod('total_service_left_bg');
    $total_counter_bg = get_theme_mod('total_counter_bg');
    $total_cta_bg = get_theme_mod('total_cta_bg');
    $custom_css .= '.ht-service-left-bg{ background-image:url(' . esc_url($total_service_left_bg) . ');}';
    $custom_css .= '#ht-counter-section{ background-image:url(' . esc_url($total_counter_bg) . ');}';
    $custom_css .= '#ht-cta-section{ background-image:url(' . esc_url($total_cta_bg) . ');}';

    if ($website_layout != 'fluid') {
        $custom_css .= "@media screen and (max-width:{$container_width}px){
            .ht-container,
            .elementor-section.elementor-section-boxed.elementor-section-stretched>.elementor-container,
            .elementor-template-full-width .elementor-section.elementor-section-boxed>.elementor-container{
                width: auto !important;
                padding-left: 30px !important;
                padding-right: 30px !important;
            }

            body.ht-boxed #ht-page{
                width: 95% !important;
            }

            .ht-slide-caption{
                width: 80%;
                margin-left: -40%;
            }
        }";
    } else {
        $container_half_width = $container_width / 2;
        $custom_css .= ".ht-slide-caption{ width: {$container_width}%; margin-left: -{$container_half_width}%; }";
    }

    $custom_css .= "@media screen and (max-width:768px){{$tablet_css}}";
    $custom_css .= "@media screen and (max-width:480px){{$mobile_css}}";

    return total_css_strip_whitespace($custom_css);
}
