<div class="container gtco-testimonials">
	<h2 class="h2 section-h2-title"><?php echo __('Izdelki naših strank', 'storefront'); ?></h2>
  <div class="owl-carousel owl-carousel1 owl-theme">
    <?php
    $args = array(
        'post_type' => 'izdelki-nasih-strank',
				'posts_per_page' => 5,
				'orderby'   => 'rand'
        // 'orderby' => 'date',
        // 'order'   => 'DESC',
        // 'posts_per_page' => -1
        );
    $post_data = get_posts($args);
    foreach($post_data as $post)
    {
          $image = get_field('customer_product_image');

        ?>
    <div>
      <div class="card text-center">
      <img class="card-img-top" src="<?php echo esc_url($image['url']); ?>" alt="<?php the_field('customer_product_name');?>">

        <div class="card-body">
          <h5><?php the_field('customer_product_name');?><br />
            <span><?php the_field('customer_product_job');?></span>
          </h5>
          <p class="card-text">“<?php the_field('customer_product_rewiew');?>”</p>
        </div>
      </div>
    </div>
    <?php  } ?>
  </div>
</div>
<div class="bottom-m-40"></div>
