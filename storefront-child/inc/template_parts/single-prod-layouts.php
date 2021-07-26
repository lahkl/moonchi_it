
<?php if( have_rows('dynamic_content') ): ?>
    <?php while( have_rows('dynamic_content') ): the_row(); ?>
        <?php if( get_row_layout() == 'full_size_banner_with_text' ): ?>
        <!-- Text, button banner -->
        <div class="fluid-container">
            <div class="container">
                <div class="row">
                    <div style="background-color: <?php the_sub_field('color'); ?>" class="callout-dark text-center fade-in-b">
                        <h2 class="section-h2-title" <?php if( get_sub_field('barva_naslova') ): ?>style="color: <?php the_sub_field('barva_naslova')?>"><?php the_sub_field('text', false, false ); endif; ?></h2>
                        <p <?php if( get_sub_field('barva_besedila') ): ?> style="background-color: <?php the_sub_field('barva_besedila'); endif; ?>"><?php the_sub_field('description'); ?></p>
                        <a href="#<?php the_sub_field('cta-link'); ?>" class="btn btn-lg btn-danger"><?php the_sub_field('cta-text'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        </br>
        <!-- Slider left - text right -->
        <?php elseif( get_row_layout() == 'before_after_left_text_right' ):
            ?>
            <div class="container">
                <div class="row">
                    <div class="content-title col-sm-12">
                        <h2 class="text-center section-h2-title"><?php the_sub_field('title', false, false );?></h2>
                    </div>
                    <div class="col-sm-6">
                        <?php
                            $getShortcode = get_sub_field('slider');
                            echo do_shortcode( $getShortcode ); ?>
                        <?php ?>
                    </div>
                    <div class="col-sm-6 text-content-area">
                        <?php the_sub_field('content');?>
                    </div>
                </div>
            </div>
            </br>
        <!-- Slider left - text right -->
        <?php elseif( get_row_layout() == 'before_after_right_text_left' ):
            ?>
            <div class="container">
                <div class="row">
                    <div class="content-title col-sm-12">
                        <h2 class="text-center section-h2-title"><?php the_sub_field('title', false, false );?></h2>
                    </div>
                    <div class="col-sm-6 text-content-area">
                        <?php the_sub_field('content');?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                            $getShortcode = get_sub_field('slider');
                            echo do_shortcode( $getShortcode ); ?>
                    </div>
                </div>
            </div>
            </br>
        <!-- Show reviews -->
        <?php elseif( get_row_layout() == 'reviews' ):
            ?>
            <div class="container">
                <div class="row">
                    <div class="content-title col-sm-12">
                        <h2 class="text-center section-h2-title"><?php the_sub_field('title', false, false );?></h2>
                    </div>
                    <div class="col-sm-12 gtco-testimonials">
                    <?php
                        $featured_posts = get_sub_field('review');

                        if( $featured_posts ): ?>
                        <ul class="owl-carousel owl-carousel1 owl-theme">
                        <?php foreach( $featured_posts as $post ):
                            $image = get_field('customer_product_image');
                            // Setup this post for WP functions (variable must be named $post).
                            setup_postdata($post); ?>
                            <div class="card text-center">
                            <img class="card-img-top" src="<?php echo esc_url($image['url']); ?>" alt="<?php the_field('customer_product_name');?>">

                                <div class="card-body">
                                <h5><?php the_field('customer_product_name');?><br />
                                    <span><?php the_field('customer_product_job');?></span>
                                </h5>
                                <p class="card-text">“<?php the_field('customer_product_rewiew');?>”</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </ul>
                        <?php
                        // Reset the global post object so that the rest of the page works correctly.
                        wp_reset_postdata(); ?>
                    <?php endif; ?>
                    </div>

                </div>
            </div>
            </br>
         <!-- Show GIF left text right -->
         <?php elseif( get_row_layout() == 'gif_left_text_right' ):
            $image = get_sub_field('image');
            ?>
            <div class="container">
                <div class="row">
                    <div class="content-title col-sm-12">
                        <h2 class="text-center section-h2-title"><?php the_sub_field('title', false, false );?></h2>
                    </div>
                    <div class="col-sm-6">

                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                    <div class="col-sm-6 text-content-area">
                        <?php the_sub_field('content');?>
                    </div>
                </div>
            </div>
            </br>
         <!-- Show GIF right text left -->
         <?php elseif( get_row_layout() == 'gif_right_text_left' ):
            $image = get_sub_field('image');
            ?>
            <div class="container">
                <div class="row">
                    <div class="content-title col-sm-12">
                        <h2 class="text-center section-h2-title"><?php the_sub_field('title', false, false );?></h2>
                    </div>
                    <div class="col-sm-6 text-content-area">
                        <?php the_sub_field('content');?>
                    </div>
                    <div class="col-sm-6">

                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                </div>
            </div>
            </br>
         <!-- Show GIF left text right -->
         <?php elseif( get_row_layout() == 'gif_left_text_right' ):
            $image = get_sub_field('image');
            ?>
            <div class="container">
                <div class="row">
                    <div class="content-title col-sm-12">
                        <h2 class="text-center section-h2-title"><?php the_sub_field('title', false, false );?></h2>
                    </div>
                    <div class="col-sm-6">

                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                    <div class="col-sm-6 text-content-area">
                        <?php the_sub_field('content');?>
                    </div>
                </div>
            </div>
            </br>
         <!-- Show GIF right text left -->
         <?php elseif( get_row_layout() == 'gif_right_text_left' ):
            $image = get_sub_field('image');
            ?>
            <div class="container">
                <div class="row">
                    <div class="content-title col-sm-12">
                        <h2 class="text-center section-h2-title"><?php the_sub_field('title', false, false );?></h2>
                    </div>
                    <div class="col-sm-6 text-content-area">
                        <?php the_sub_field('content');?>
                    </div>
                    <div class="col-sm-6">

                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    </div>
                </div>
            </div>
            </br>
         <!-- Show Gallery right text left -->
         <?php elseif( get_row_layout() == 'gallery_left_text_right' ):
            // $image = get_sub_field('image');
            $images = get_sub_field('gallery');
            ?>
            <div class="container">
                <div class="row">
                    <div class="content-title col-sm-12">
                        <h2 class="text-center section-h2-title"><?php the_sub_field('title', false, false );?></h2>
                    </div>
                    <div class="col-sm-6 text-content-area">
                        <?php the_sub_field('content');?>
                    </div>
                    <div class="col-sm-6">
                    <?php
                        if( $images ): ?>
                            <div id="slider" class="flexslider">
                                <ul class="slides">
                                    <?php foreach( $images as $image ): ?>
                                        <li class="single-slide">
                                            <img class="slider-gallery-img" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            <p><?php echo esc_html($image['caption']); ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            </br>
         <!-- Show Gallery left text right -->
         <?php elseif( get_row_layout() == 'gallery_right_text_left' ):
            $images = get_sub_field('gallery');
            ?>
            <div class="container">
                <div
                    <?php if( get_sub_field('internal_link') ): ?>
                        id="<?php the_sub_field('internal_link');?>"
                    <?php endif; ?>
                    class="row">
                    <div class="content-title col-sm-12">
                        <h2 class="text-center section-h2-title"><?php the_sub_field('title', false, false );?></h2>
                    </div>
                    <div class="col-sm-6">
                    <?php
                        if( $images ): ?>
                            <div id="slider" class="flexslider">
                                <ul class="slides">
                                    <?php foreach( $images as $image ): ?>
                                        <li class="single-slide">
                                            <img class="slider-gallery-img" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            <p><?php echo esc_html($image['caption']); ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6 text-content-area">
                        <?php the_sub_field('content');?>
                    </div>
                </div>
            </div>
            </br>
            <?php elseif( get_row_layout() == 'quote_area' ): ?>
            <!-- Text, button banner -->
            <div class="fluid-container">
                <div class="container">
                    <blockquote <?php if( get_sub_field( 'color') ): ?> style="background-color:<?php the_sub_field('color');?>; color:<?php the_sub_field('barva_besedila');?>"<?php endif; ?>class="quote-card">
                      <p <?php if( get_sub_field('barva_besedila') ): ?> style="color:<?php the_sub_field('barva_besedila'); endif; ?>"><?php the_sub_field('description'); ?></p>
                      <?php if( get_sub_field('author')): ?>
                      <cite <?php if( get_sub_field('barva_besedila') ): ?> style="color:<?php the_sub_field('barva_besedila'); endif; ?>">
                        <?php the_sub_field('author'); ?>
                      </cite>
                    <?php endif; ?>
                    </blockquote>
                </div>
            </div>
            </br>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>
