<?php
/**
 * The template part for topbar
 *
 * @package VW One Page 
 * @subpackage vw_one_page
 * @since VW One Page 1.0
 */
?>

<div id="topbar">
	<div class="container">	
		<div class="row">
			<div class="offset-lg-2 col-lg-7 col-md-9 col-sm-7">
		        <div class="contact_details">
		        	<ul>
			            <?php if(get_theme_mod('vw_one_page_phone_number') != ''){ ?>
			              	<li><i class="fas fa-phone"></i> <?php echo esc_html(get_theme_mod('vw_one_page_phone_number',''));?></li>
			            <?php } ?>
			            <?php if(get_theme_mod('vw_one_page_email_address') != ''){ ?>
			              <li><i class="far fa-envelope"></i> <?php echo esc_html(get_theme_mod('vw_one_page_email_address',''));?></li>
			            <?php } ?>
			            <?php if(get_theme_mod('vw_one_page_timing') != ''){ ?>
			              <li><i class="far fa-clock"></i> <?php echo esc_html(get_theme_mod('vw_one_page_timing',''));?></li>
			            <?php } ?>
		          	</ul>
		        </div>
	      	</div>
			<div class="col-lg-3 col-md-3 bg-top">
				<?php dynamic_sidebar('social-widget'); ?>
			</div>
		</div>
	</div>
</div>