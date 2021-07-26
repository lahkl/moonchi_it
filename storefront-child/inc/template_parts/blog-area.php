<section class="blog top-m-30">
<div class="container">
    <div class="row">
        <h2 class="h2 section-h2-title"><?php echo __('Zadnje novice', 'storefront'); ?></h2>
    <?php
    $args = array(
        'post_type' => 'post',
        'orderby' => 'date',
        'order'   => 'DESC',
        'posts_per_page' => 3
        );
    $post_data = get_posts($args1);
    foreach($post_data as $post)
    {
        $img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
        $category = get_the_category();

        ?>
    <div class="col-md-4">
         <div class="card mb-4">
            <img class="card-img-top" src="<?php echo $img_url; ?>" alt="<?php the_title();?>">
            <div class="card-body">
               <h5 class="card-title"><?php the_title();?></h5>
               <p class="card-text"><?php the_excerpt(); ?></p>
               <a href="<?php the_permalink(); ?>" class="btn btn-outline-dark btn-sm"><?php echo __('Preberi več', 'storefront'); ?></a>
            </div>
         </div>
    </div>
      <?php  } ?>
    </div>
    </div>
</section>
