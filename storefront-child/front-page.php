<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package storefront
 */

get_header(); ?>
    </div> <!-- close container -->
    <?php get_template_part("inc/template_parts/slider"); ?>
  <div class="container">
    <h2 class="h2 section-h2-title"><?php echo __('Najbolje prodajani', 'storefront'); ?></h2>
    <div class="row">
    <?php

        global $product;

		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 4
			);
		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) {

			while ( $loop->have_posts() ) : $loop->the_post();
            $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
            $first_gallery_img = wp_get_attachment_image_url( $gallery_image_ids[1], 'single-post-thumbnail');

            // Get gallery ID
            $attachment_ids = $product->get_gallery_image_ids();

            if( sizeof($attachment_ids) > 0 ){
                $first_attachment_id = reset($attachment_ids);
                $first_attachment_img_url = wp_get_attachment_image_src( $first_attachment_id, 'full' )[0];
                // echo #first_attachment_img_url;
            }
    ?>
        <div class="col-md-3 col-sm-6">
            <div class="product-grid4">
                <div class="product-image4">
                    <a href="<?php the_permalink();?>">
                        <img class="pic-1" src="<?php echo esc_url( $featured_image ); ?>">
                        <img class="pic-2" src="<?php echo esc_url( $first_attachment_img_url );?>">
                    </a>
                    <!-- <ul class="social">
                        <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
                        <li><a href="#" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>
                        <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                    <span class="product-new-label">New</span>
                    <span class="product-discount-label">-10%</span> -->
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <div class="price">
                        <?php echo $product->get_display_price(); ?>€
                        <span><?php echo $product->get_regular_price(); ?>€</span>
                    </div>
                    <?php woocommerce_template_loop_add_to_cart(); ?>
                </div>
            </div>
        </div>
        <?php
            endwhile;
            } else {
                echo __( 'No products found' );
            }
            wp_reset_postdata();
        ?>
    </div>
    </br>
    <hr>
</div>

    <?php get_template_part("inc/template_parts/blog-area"); ?>
</div>
<?php
// get_template_part("inc/template_parts/customer-rewiews"); 
?>


<?php
do_action( 'storefront_sidebar' );
get_footer();
