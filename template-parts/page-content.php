<?php
/**
 * The template part for displaying page content
 *
 * @package VW One Page
 * @subpackage vw_one_page
 * @since VW One Page 1.0
 */
?>

<div class="content-vw">
  <?php if(has_post_thumbnail()) {?>
     <?php the_post_thumbnail(); ?>
    <hr>
  <?php }?>
  <h1><?php the_title();?></h1>
  <?php the_content();?>
  <?php
      // If comments are open or we have at least one comment, load up the comment template.
      if ( comments_open() || get_comments_number() ) :
         comments_template();
      endif;
  ?>
  <div class="clearfix"></div>
</div>