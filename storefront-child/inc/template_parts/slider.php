<div class="container-fluid">
    <!-- Start slider  -->
    <section class="slider" style="background-color: #fafafa">
        <div class="flexslider flexslider-fp">
        <?php
            if( have_rows('front_page_slide') ): ?>
            <ul class="slides">
            <?php while( have_rows('front_page_slide') ): the_row();
                $image = get_sub_field('fp_slider_img');
                // var_dump($image);
            ?>
                <li class="single-slider">
                    <!-- generates image tag -->
                    <?php echo wp_get_attachment_image( $image, 'full' );?>
                    <div class="slider-cont">
                        <h1 class="slider-cont__title">
                            <?php the_sub_field('fp_slider_title'); ?>
                        </h1>
                        <p class="slider-cont__desc">
                            <?php the_sub_field('fp_slider_desc'); ?>
                        </p>
                        <a class="slider-cont__btn btn btn-primary" href="<?php the_sub_field('fp_slider_btn_url');?>">
                            <?php the_sub_field('fp_slider_btn_text'); ?>
                        </a>
                    </div>
                </li>
                <?php endwhile; ?>
            </ul>
            <?php endif; ?>
        </div>
    </section>
</div>
<div class="bottom-m-40"></div>
