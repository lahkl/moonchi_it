<section class="product-cat">
    <div class="container">
        <div class="row">
            <div class="card col-12">
                <?php
                    $term = get_queried_object();

                    $title = get_field('category_title', $term);
                    $description = get_field('category_description', $term);
                    $image = get_field('category_image', $term);
                    $color = get_field('color', $term);
                ?>
                <div class="row g-0">
                    <div class="col">
                    <img class="product-cat__img" src="<?php echo $image['url']; ?>" alt="<?php echo $title; ?>">
                </div>
                <div class="col-md-8">
                    <div class="card-body product-cat__body">
                        <h1 class="card-title"><?php echo $title; ?></h1>
                        <p class="card-text"><?php echo $description; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
