<?php
/**
 * Template Name: Custom Home
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action( 'vw_one_page_before_slider' ); ?>

  <?php if( get_theme_mod( 'vw_one_page_slider_hide_show',true) != '') { ?>
    <section id="slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
        <?php $slider_page = array();
          for ( $count = 1; $count <= 4; $count++ ) {
            $mod = intval( get_theme_mod( 'vw_one_page_slider_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $slider_page[] = $mod;
            }
          }
          if( !empty($slider_page) ) :
            $args = array(
              'post_type' => 'page',
              'post__in' => $slider_page,
              'orderby' => 'post__in'
            );
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) :
              $i = 1;
        ?>     
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
              <img src="<?php the_post_thumbnail_url('full'); ?>" role="img"/>
              <div class="carousel-caption">
                <div class="inner_carousel">
                  <h2><?php the_title(); ?></h2>
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_one_page_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_one_page_slider_excerpt_number','30')))); ?></p>
                  <div class="more-btn">
                    <a href="<?php the_permalink(); ?>"><?php esc_html_e('GET STARTED','vw-one-page'); ?><span class="screen-reader-text"><?php esc_html_e( 'GET STARTED','vw-one-page' );?></span></a>
                  </div>
                </div>
              </div>
            </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
            <div class="no-postfound"></div>
        <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
          <span class="screen-reader-text"><?php esc_attr_e( 'Previous','vw-one-page' );?></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
          <span class="screen-reader-text"><?php esc_attr_e( 'Next','vw-one-page' );?></span>
        </a>
      </div>  
      <div class="clearfix"></div>
    </section>
  <?php } ?>

  <?php do_action( 'vw_one_page_after_slider' ); ?>

  <?php if( get_theme_mod( 'vw_one_page_services') != '') { ?>
    <section id="services-one">
      <div class="container">
        <div class="row">
          <?php
            $catData =  get_theme_mod('vw_one_page_services');
              if($catData){
            $page_query = new WP_Query(array( 'category_name' => esc_html($catData,'vw-one-page'))); ?>      
            <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
              <div class="col-lg-3 col-md-3 category_main">
                <div class="catgory-box">
                  <?php the_post_thumbnail(); ?>
                  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h4>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata();
          } ?>
        </div>
      </div>
    </section>
  <?php } ?>

  <?php do_action( 'vw_one_page_after_services' ); ?>

  <section id="about-us">
    <div class="container">
      <?php $about_page = array();
        $mod = intval( get_theme_mod( 'vw_one_page_about_page'));
        if ( 'page-none-selected' != $mod ) {
          $about_page[] = $mod;
        }
        if( !empty($about_page) ) :
          $args = array(
            'post_type' => 'page',
            'post__in' => $about_page,
            'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
      ?>
        <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="row">
            <div class="col-lg-8 col-md-7">
              <h3><?php the_title(); ?></h3>
              <hr>
              <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_one_page_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_one_page_about_excerpt_number','30')))); ?></p>
              <div class="more-btn">
                <a href="<?php the_permalink(); ?>"><?php esc_html_e('MORE','vw-one-page'); ?><span class="screen-reader-text"><?php esc_html_e( 'MORE','vw-one-page' );?></span></a>
              </div>
            </div>
            <div class="col-lg-4 col-md-5">
              <img src="<?php the_post_thumbnail_url('full'); ?>" role="img"/>
            </div> 
          </div>
        <?php $i++; endwhile; 
        wp_reset_postdata();?>
      <?php else : ?>
          <div class="no-postfound"></div>
      <?php endif;
      endif;?>
    </div>  
  </section>

  <?php do_action( 'vw_one_page_after_about' ); ?>

  <div class="content-vw">
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>