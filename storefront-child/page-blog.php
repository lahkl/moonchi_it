<?php /* Template Name: Blog template */ ?>

<?php
get_header();?>
<div class="container">
	   <div class="row">
<?php
if ( have_posts() ) :
     while ( have_posts() ) :
         the_post();
 ?>
     <h1 class="heading-1 heading-1--dark page__header--title"><?php the_title(); ?></h1>
 <?php
     if ( has_post_thumbnail() ) :
         $img_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
         ?>


<?php
     endif;
 ?>
 <!-- START  -->

     <?php
     $custom_query = new WP_Query(array (
             'paged' => get_query_var('paged', 1),
             'posts_per_page' => 8 )); // exclude category 9
     while($custom_query->have_posts()) : $custom_query->the_post();
     $thumb = get_post_thumbnail_id();
     $img_url = wp_get_attachment_url($thumb,'thumbnail'); //get full URL to image (use "large" or "medium" if the images too big)
     ?>
     <div class="blog-post col-lg-6 col-md-6 col-sm-6 col-xs-12" data-aos="fade-right">
        <div class="col-xs-12">
          <img src="<?php echo $img_url;?>" alt="<?php the_title();?>" width="100%">
       </div>
       <div class="col-xs-12">
          <div class="blog-colum">
           <h3><?php the_title();?></h3>
            <!-- <ul class="blog-detail list-inline">
             <li><i class="fa fa-user"></i>Jack Doe</li>
             <li><i class="fa fa-clock-o"></i>October 10, 2017</li>
           </ul> -->
           <p><?php the_excerpt(); ?></p>
           <a class="btn button" href="<?php the_permalink(); ?>"><?php echo __('Preberi več', 'storefront'); ?></a>
         </div>
       </div>
      </div>
    </br>
         <?php endwhile; wp_reset_postdata(); ?>
     </div>
     <div class="content-pagination">
         <?php echo paginate_links(array(
             'total' => $custom_query->max_num_pages
         ));
         ?>
    <?php
    endwhile;
    endif;
    ?>
	</div>
</div>
<?php
get_footer();
?>
