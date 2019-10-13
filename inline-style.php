<?php
	
	/*---------------------------First highlight color-------------------*/

	$vw_one_page_first_color = get_theme_mod('vw_one_page_first_color');

	$custom_css = '';

	if($vw_one_page_first_color != false){
		$custom_css .='.logo, #slider .inner_carousel h2, .more-btn a, .content-bttn a, #slider .carousel-control-prev-icon, #slider .carousel-control-next-icon, .scrollup i, .catgory-box:hover, input[type="submit"], #footer .tagcloud a:hover, #sidebar .custom-social-icons i, #footer .custom-social-icons i, #sidebar .tagcloud a:hover, #sidebar input[type="submit"], .pagination .current, .pagination a:hover, #header .nav ul li:hover > ul li a, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .error-btn a{';
			$custom_css .='background-color: '.esc_html($vw_one_page_first_color).';';
		$custom_css .='}';
	}
	if($vw_one_page_first_color != false){
		$custom_css .='#comments input[type="submit"].submit{';
			$custom_css .='background-color: '.esc_html($vw_one_page_first_color).'!important;';
		$custom_css .='}';
	}
	if($vw_one_page_first_color != false){
		$custom_css .='a, #footer h3, .post-main-box:hover h3 a, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, #header .nav ul li a:hover, #header .current-menu-item, .woocommerce-message::before{';
			$custom_css .='color: '.esc_html($vw_one_page_first_color).';';
		$custom_css .='}';
	}
	if($vw_one_page_first_color != false){
		$custom_css .='.logo:after, .catgory-box:hover:after, #about-us hr, .post-info hr, .woocommerce-message{';
			$custom_css .='border-top-color: '.esc_html($vw_one_page_first_color).';';
		$custom_css .='}';
	}

	/*---------------------------Second highlight color-------------------*/

	$vw_one_page_second_color = get_theme_mod('vw_one_page_second_color');

	if($vw_one_page_second_color != false){
		$custom_css .='.more-btn a:hover, .content-bttn a:hover, #footer-2, #footer .custom-social-icons i:hover, #sidebar .social_widget i, #sidebar .custom-social-icons i:hover, .pagination span, .pagination a, .woocommerce span.onsale, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover{';
			$custom_css .='background-color: '.esc_html($vw_one_page_second_color).';';
		$custom_css .='}';
	}
	if($vw_one_page_second_color != false){
		$custom_css .='#header .nav ul li a, #topbar .custom-social-icons i:hover, h1, h2, h3, h4, h5, h6, .catgory-box h4 a, .search-box i, #about-us h3, #footer .tagcloud a, #footer td ,#sidebar td, #footer th, #footer li a , #footer, .post-main-box h3 a, .new-text p, #our-services p, .post-info, #sidebar td#prev a, #sidebar caption, #sidebar td, #sidebar th, #sidebar select, #sidebar h3, #sidebar input[type="search"], #sidebar ul li, #sidebar ul li a, #sidebar .tagcloud a, .post-navigation a, h2.woocommerce-loop-product__title, .woocommerce div.product .product_title, .woocommerce ul.products li.product .price,.woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce .quantity .qty{';
			$custom_css .='color: '.esc_html($vw_one_page_second_color).';';
		$custom_css .='}';
	}
	if($vw_one_page_second_color != false){
		$custom_css .='#footer .tagcloud a, #footer .search-form .search-field, #footer table, #footer th, #footer td, .woocommerce .quantity .qty{';
			$custom_css .='border-color: '.esc_html($vw_one_page_second_color).';';
		$custom_css .='}';
	}
	if($vw_one_page_second_color != false){
		$custom_css .='nav.woocommerce-MyAccount-navigation ul li{
		box-shadow: 4px 4px 0 0 '.esc_html($vw_one_page_second_color).';
		}';
	}
	if($vw_one_page_second_color != false || $vw_one_page_first_color != false){
		$custom_css .='#topbar{
		background: rgba(0, 0, 0, 0) linear-gradient(120deg, '.esc_html($vw_one_page_second_color).' 68%, '.esc_html($vw_one_page_first_color).' 32%) repeat scroll 0 0;
		}';
	}

	/*---------------------------Width Layout -------------------*/

	$theme_lay = get_theme_mod( 'vw_one_page_width_option','Full Width');
    if($theme_lay == 'Boxed'){
		$custom_css .='body{';
			$custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$custom_css .='}';
	}else if($theme_lay == 'Wide Width'){
		$custom_css .='body{';
			$custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$custom_css .='}';
	}else if($theme_lay == 'Full Width'){
		$custom_css .='body{';
			$custom_css .='max-width: 100%;';
		$custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$theme_lay = get_theme_mod( 'vw_one_page_slider_opacity_color','0.5');
	if($theme_lay == '0'){
		$custom_css .='#slider img{';
			$custom_css .='opacity:0';
		$custom_css .='}';
		}else if($theme_lay == '0.1'){
		$custom_css .='#slider img{';
			$custom_css .='opacity:0.1';
		$custom_css .='}';
		}else if($theme_lay == '0.2'){
		$custom_css .='#slider img{';
			$custom_css .='opacity:0.2';
		$custom_css .='}';
		}else if($theme_lay == '0.3'){
		$custom_css .='#slider img{';
			$custom_css .='opacity:0.3';
		$custom_css .='}';
		}else if($theme_lay == '0.4'){
		$custom_css .='#slider img{';
			$custom_css .='opacity:0.4';
		$custom_css .='}';
		}else if($theme_lay == '0.5'){
		$custom_css .='#slider img{';
			$custom_css .='opacity:0.5';
		$custom_css .='}';
		}else if($theme_lay == '0.6'){
		$custom_css .='#slider img{';
			$custom_css .='opacity:0.6';
		$custom_css .='}';
		}else if($theme_lay == '0.7'){
		$custom_css .='#slider img{';
			$custom_css .='opacity:0.7';
		$custom_css .='}';
		}else if($theme_lay == '0.8'){
		$custom_css .='#slider img{';
			$custom_css .='opacity:0.8';
		$custom_css .='}';
		}else if($theme_lay == '0.9'){
		$custom_css .='#slider img{';
			$custom_css .='opacity:0.9';
		$custom_css .='}';
		}

	/*---------------------------Slider Content Layout -------------------*/

	$theme_lay = get_theme_mod( 'vw_one_page_slider_content_option','Right');
    if($theme_lay == 'Left'){
		$custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h2{';
			$custom_css .='text-align:left; left:15%; right:45%;';
		$custom_css .='}';
	}else if($theme_lay == 'Center'){
		$custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h2{';
			$custom_css .='text-align:center; left:20%; right:20%;';
		$custom_css .='}';
	}else if($theme_lay == 'Right'){
		$custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h2{';
			$custom_css .='text-align:right; left:45%; right:15%;';
		$custom_css .='}';
	}