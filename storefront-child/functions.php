<?php

// Theme wocoomerce support
add_theme_support( 'woocommerce' );

// Enqueue parent and child theme css
function hankart_enqueue_styles() {
   // wp_dequeue_style( 'font-awesome' );
   // wp_dequeue_style( 'storefront-fonts' );
   // wp_dequeue_style( 'source-sans-pro' );
   // wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
   // wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() );
   wp_enqueue_style( 'load-fa', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css' );
}
add_action( 'wp_enqueue_scripts', 'hankart_enqueue_styles' );

function hankart_scripts() {
    // enqueue bootstrap js
    wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/inc/bootstrap/bootstrap.min.js', array( 'jquery' ), '5.0.0', true );
    wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri(). '/inc/bootstrap/bootstrap.min.css', array(), '5.0.0', 'all' );

    // flexslider
  	wp_enqueue_style( 'flexslider-css', get_stylesheet_directory_uri() . '/inc/flexslider/flexslider.css', array(), '', 'all' );
  	wp_enqueue_script( 'flexslider-min-js', get_stylesheet_directory_uri() . '/inc/flexslider/jquery.flexslider-min.js', array( 'jquery' ), '', true );
  	wp_enqueue_script( 'flexslider-js', get_stylesheet_directory_uri() . '/inc/flexslider/flexslider.js', array( 'jquery' ), '', true );

  	// owl carousel
  	// wp_enqueue_style( 'owlcarousel-def-css', get_stylesheet_directory_uri() . '/inc/owlcarousel/owl.theme.default.css', array(), '', 'all' );
  	wp_enqueue_style( 'owlcarousel-min-css', get_stylesheet_directory_uri() . '/inc/owlcarousel/owl.carousel.min.css', array(), '', 'all' );
    wp_enqueue_script( 'owlcarousel-min-js', get_stylesheet_directory_uri() . '/inc/owlcarousel/owl.carousel.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'owlcarousel-js', get_stylesheet_directory_uri() . '/inc/owlcarousel/owlcarousel.js', array( 'jquery' ), '', true );

  	// Add custom fonts
  	// wp_enqueue_style( 'raustila-regular', get_stylesheet_directory_uri() . '/inc/fonts/raustila-Regular.ttf' );
  	// wp_enqueue_style( 'raustila-regular-two', get_stylesheet_directory_uri() . '/inc/fonts/raustila-Regular.otf' );

  	// wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&display=swap|https://fonts.googleapis.com/css2?family=Seaweed+Script&display=swap' );

}
add_action( 'wp_enqueue_scripts', 'hankart_scripts' );

// Enable svg graphic upload
function hankart_cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
add_filter('upload_mimes', 'hankart_cc_mime_types');

function hankart_config () {
    // Custom logo support
    add_theme_support( 'custom-logo', array(
        // 'height'        => 85,
        // 'width'         => 240,
        'flex_height'   => true,
        'flex_width'    => true,
    ) );
    // add_theme_support( 'wc-product-gallery-zoom' );
    // add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // this should be disable the gallery slider and lightbox
    // remove_theme_support('wc-product-gallery-slider');

    // this should be disable the zoom
    remove_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );

    add_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );

    add_image_size(
        'hankart-slider',
        1920,
        800,
        array('center', 'center'
    ));
}
add_action( 'after_setup_theme', 'hankart_config', 999);

// Excerpt length
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// Breadcrumbs - "home" in breadcrumb
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );
function wcc_change_breadcrumb_home_text( $defaults ) {
    // Change the breadcrumb home text from 'Home' to 'HankArt'
	$defaults['home'] = 'HankArt';
	return $defaults;
}

// Remove breadcrumbs on pages
add_action( 'init', 'wc_remove_storefront_breadcrumbs');
function wc_remove_storefront_breadcrumbs() {
    if (is_front_page()) {
        remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
    }
}

// Add banner area
add_action( 'woocommerce_before_main_content', 'hankart_add_category_area', 50 );
function hankart_add_category_area() {
  if( is_product_category() ) {
    get_template_part("inc/template_parts/product-cat-area");
    // Remove archive title
    add_filter( 'woocommerce_show_page_title', '__return_false' );
  }
}

// Customize product descripton tab content
add_filter( 'woocommerce_product_tabs', 'woo_custom_description_tab', 98 );
function woo_custom_description_tab( $tabs ) {

	$tabs['description']['callback'] = 'woo_custom_description_tab_content';	// Custom description callback

	return $tabs;
}
function woo_custom_description_tab_content() {
    woocommerce_product_description_tab();
    get_template_part("inc/template_parts/single-prod-layouts");
}

// Remove description tab title
add_filter( 'woocommerce_product_description_heading', '__return_null' );

// Add product custom layouts area under every product tab
// add_action( 'woocommerce_product_after_tabs', 'hankart_add_product_layouts_area', 100 );
function hankart_add_product_layouts_area() {
    get_template_part("inc/template_parts/single-prod-layouts");
}

// Add newsletter area
add_action( 'storefront_before_footer', 'hankart_add_newsleter_area', 50 );
function hankart_add_newsleter_area() {
  get_template_part("inc/template_parts/newsletter-area");
}

// Add footer area
add_action( 'storefront_before_footer', 'hankart_add_footer_area', 100 );
function hankart_add_footer_area() {
  get_template_part("inc/template_parts/footer-area");
}


// Show products short description that price plugin removes
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );


// // Remove search
// function remove_sf_actions() {
// 	remove_action( 'storefront_header', 'storefront_product_search', 40 );
// }
// add_action( 'init', 'remove_sf_actions' );

// Remove search from header area
function hankart_remove_sf_actions() {
    // remove search from upper nav area
	  remove_action( 'storefront_header', 'storefront_product_search', 40 );
    // remove cart from navigation bar
    remove_action( 'storefront_header', 'storefront_header_cart', 60 );
    add_action( 'storefront_header', 'storefront_header_cart', 30 );

}
add_action( 'init', 'hankart_remove_sf_actions' );


// Add navigation arrows to product gallery
function hankart_sf_update_woo_flexslider_options( $options ) {

    $options['directionNav'] = true;

    return $options;
}
add_filter( 'woocommerce_single_product_carousel_options', 'hankart_sf_update_woo_flexslider_options' );

// Flexslider options
// 'flexslider'  => apply_filters( 'woocommerce_single_product_carousel_options', array(
//     'rtl'            => is_rtl(),
//     'animation'      => 'slide',
//     'smoothHeight'   => true,
//     'directionNav'   => false,
//     'controlNav'     => 'thumbnails',
//     'slideshow'      => false,
//     'animationSpeed' => 500,
//     'animationLoop'  => false, // Breaks photoswipe pagination if true.
//     'allowOneSlide'  => false,
// )),


// Add custom tabs

// Add a custom product data tab
add_filter( 'woocommerce_product_tabs', 'hankart_add_manual_tab' );
function hankart_add_manual_tab( $tabs ) {
	// Adds the new tab
	$tabs['pdf_manual'] = array(
		'title' 	=> __( 'Manual', 'storefront' ),
		'priority' 	=> 50,
		'callback' 	=> 'hankart_add_manual_tab_content'
	);
	return $tabs;
}
function hankart_add_manual_tab_content() {
	// The new tab content
    $file = get_field('pdf_manual');
    if( $file ): ?>
        <a target="_blank" href="<?php echo $file['url']; ?>"><i class="fas fa-file-pdf"></i> <?php the_field('pdf_manual_title' ); // echo $file['filename']; ?></a>
    <?php endif;
}

// Add a custom product data tab
add_filter( 'woocommerce_product_tabs', 'hankart_add_tech_spec' );
function hankart_add_tech_spec( $tabs ) {

	// Adds the new tab
	$tabs['tech_spec'] = array(
		'title' 	=> __( 'Technical specifications', 'storefront' ),
		'priority' 	=> 50,
		'callback' 	=> 'hankart_add_tech_spec_content'
	);
	return $tabs;
}

function hankart_add_tech_spec_content() {
	// The new tab content
    $techDetails = get_field('technical_details');
    if( $techDetails ): ?>
        <p><?php the_field('technical_details' );?></p>
    <?php endif;

}

// /**
//  * Customize product data tabs
//  */
// add_filter( 'woocommerce_product_tabs', 'woo_custom_description_tab', 98 );
// function woo_custom_description_tab( $tabs ) {
//
// 	$tabs['description']['callback'] = 'woo_custom_description_tab_content';	// Custom description callback
//
// 	return $tabs;
// }
//
// function woo_custom_description_tab_content() {
// 	echo '<h2>Custom Description</h2>';
// 	echo '<p>Here\'s a custom description</p>';
// }


// Reorder product data tabs
add_filter( 'woocommerce_product_tabs', 'woo_reorder_tabs', 98 );
function woo_reorder_tabs( $tabs ) {

  $tabs['description']['priority'] = 5;			// Description second
  $tabs['tech_spec']['priority'] = 10;	// Additional information third
  $tabs['pdf_manual']['priority'] = 15;	// Additional information fourth
  $tabs['reviews']['priority'] = 20;			// Reviews first
  unset( $tabs['additional_information'] );
	return $tabs;
}


// Add custom fields content to description tab
// add_filter( 'the_content', 'hankart_add_custom_fields_content_to_desc_tab' );
function hankart_add_custom_fields_content_to_desc_tab( $content ){

	if( is_product() ) { // I recommend to always use this condition
    // add_action( 'woocommerce_after_template_part', 'ankart_add_product_layouts_area', 100 );
    $content .= hankart_add_product_layouts_area();
  }

	return $content;

}

// Add icons
add_action( 'wp_footer', 'hankart_load_svg_icons');
function hankart_load_svg_icons() {
    get_template_part("inc/template_parts/hankart-svg-icons");
}

// Disable comments

// First, this will disable support for comments and trackbacks in post types
function hankart_disable_comments_post_types_support() {
   $post_types = get_post_types();
   foreach ($post_types as $post_type) {
      if(post_type_supports($post_type, 'comments')) {
         remove_post_type_support($post_type, 'comments');
         remove_post_type_support($post_type, 'trackbacks');
      }
   }
}
# https://keithgreer.uk/wordpress-code-completely-disable-comments-using-functions-php

// add_action('admin_init', 'hankart_disable_comments_post_types_support');

// Then close any comments open comments on the front-end just in case
function hankart_disable_comments_status() {
   return false;
}
// add_filter('comments_open', 'hankart_disable_comments_status', 20, 2);
// add_filter('pings_open', 'hankart_disable_comments_status', 20, 2);

// Finally, hide any existing comments that are on the site.
function hankart_disable_comments_hide_existing_comments($comments) {
   $comments = array();
   return $comments;
}
// add_filter('comments_array', 'hankart_disable_comments_hide_existing_comments', 10, 2);


// show blog excerpt
add_action( 'init', function() {
    remove_action( 'storefront_loop_post', 'storefront_post_content', 30 );
    add_action( 'storefront_loop_post', function() {
      echo '<div class="entry-content" itemprop="articleBody">';
      if( has_post_thumbnail() ) {
        the_post_thumbnail( 'large', [ 'itemprop' => 'image' ] );
      }
      the_excerpt();
      echo '</div>';
    }, 0 );
} );

// Add customer on every page except on single product

add_action ( 'storefront_before_footer', 'hankart_reviews_on_every_page');

function hankart_reviews_on_every_page() {

  if( ! is_product() && ! is_cart() && ! is_checkout() ) {
    get_template_part("inc/template_parts/customer-rewiews");
  }
}

// Remove storefront credits area and add full width to credits
add_action( 'init', 'hankart_custom_remove_footer_credit', 10 );
function hankart_custom_remove_footer_credit () {
  remove_action( 'storefront_footer', 'storefront_credit', 20 );
  add_action( 'storefront_footer', 'hankart_custom_storefront_credit', 20 );
  }
function hankart_custom_storefront_credit() {
      ?>
    </div>
      </div>
      <div class="footer-bg">
        <div class="container">
          <div class="site-info">
            &copy; <?php echo get_bloginfo( 'name' ) . ' ' . get_the_date( 'Y' ); ?>
          </div><!-- .site-info -->
        </div><!-- .container -->
      </div><!-- .footer-bg -->
    <?php
}


/**
 * Add Prefix to WooCommerce Order Number
 *
 */
 add_filter( 'woocommerce_order_number', 'hankart_woocommerce_order_number', 1, 2 );
function hankart_woocommerce_order_number( $oldnumber, $order ) {
	return 'HAIT' . $order->id;
}

// Remove notes field
add_filter('woocommerce_enable_order_notes_field', '__return_false');
/**
 * @snippet       Move / ReOrder Fields @ Checkout Page, WooCommerce version 3.0+
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=19571
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.0.4
 */

add_filter( 'woocommerce_checkout_fields', 'hankart_remove_fields', 9999 );
function hankart_remove_fields( $woo_checkout_fields_array ) {

	// she wanted me to leave these fields in checkout
	// unset( $woo_checkout_fields_array['billing']['billing_first_name'] );
	// unset( $woo_checkout_fields_array['billing']['billing_last_name'] );
	// unset( $woo_checkout_fields_array['billing']['billing_phone'] );
	// unset( $woo_checkout_fields_array['billing']['billing_email'] );
	// unset( $woo_checkout_fields_array['order']['order_comments'] );
	// and to remove the fields below
	unset( $woo_checkout_fields_array['billing']['billing_company'] );
	return $woo_checkout_fields_array;
}

// Field priority
function hankart_wc_filter_billing_fields( $address_fields ) {
    $address_fields['billing_email']['priority'] = 7;
    $address_fields['billing_email']['required'] = true;
    $address_fields['billing_phone']['required'] = true;
    $address_fields['billing_phone']['priority'] = 8;
    return $address_fields;
}
add_filter( 'woocommerce_billing_fields', 'hankart_wc_filter_billing_fields', 10, 1 );

// Change the cart position
/** woocommerce: change position of add-to-cart on single product **/
// remove_action( 'woocommerce_single_product_summary',
//            'woocommerce_template_single_add_to_cart', 30 );
// add_action( 'hankart_add_cart_area',
//          'woocommerce_template_single_add_to_cart', 9 );


// Remove header and footer from cart and checkout
function remove_header_from_cart(){
    if( is_cart() || is_checkout() ){
        remove_action( 'storefront_page', 'storefront_page_header', 10 );
        remove_action( 'storefront_before_content', 'storefront_header_widget_region', 10 );
        remove_action( 'storefront_header', 'storefront_header_container', 0);
        remove_action( 'storefront_header', 'storefront_skip_links', 5 );
        remove_action( 'storefront_header', 'storefront_site_branding', 20 );
        remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
        remove_action( 'storefront_header', 'storefront_product_search', 40 );
        remove_action( 'storefront_header', 'storefront_header_container_close', 41 );
        remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper', 42 );
        remove_action( 'storefront_header', 'storefront_primary_navigation', 50 );
        remove_action( 'storefront_header', 'storefront_header_cart', 60 );
        remove_action( 'storefront_header', 'storefront_primary_navigation_wrapper_close', 68 );
        remove_action( 'storefront_header', 'storefront_header_cart', 100 );
        remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
        // Remove header cart from header
        remove_action( 'storefront_header', 'storefront_header_cart', 60 );
        remove_action( 'storefront_header', 'storefront_header_cart', 30 );
        // Remove newsletter and footer area
        remove_action( 'storefront_before_footer', 'hankart_add_newsleter_area', 50 );
        remove_action( 'storefront_before_footer', 'hankart_add_footer_area', 100 );

    }
}
add_action('wp_head','remove_header_from_cart');

function remove_footer_from_cart(){
    if( is_cart() || is_checkout() ){
        remove_action( 'storefront_footer', 'storefront_footer_widgets', 10 );
        remove_action( 'storefront_footer', 'storefront_credit', 20 );
        remove_action( 'storefront_footer', 'hankart_custom_storefront_credit', 20 );

    }
}
add_action('wp_head','remove_footer_from_cart');

// CASH OD DELIVERY - disable if value is higher than 150
add_filter( 'woocommerce_available_payment_gateways' , 'hankart_change_payment_gateway', 20, 1);
function hankart_change_payment_gateway( $gateways ){
    // Compare cart subtotal (without shipment fees)
    if( WC()->cart->subtotal > 150 ){
         // then unset the 'cod' key (cod is the unique id of COD Gateway)
         unset( $gateways['cod'] );
    }
    return $gateways;
}

// REMOVE TERMS AND CONDITIONS FROM Checkout
add_action('woocommerce_checkout_init', 'hankart_disable_checkout_terms_and_conditions', 10 );
function hankart_disable_checkout_terms_and_conditions(){
        remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20 );
        remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30 );
        // remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_checkbox_text', 40 );

}

// ADD COST 4€ for COD payment method
add_action( 'woocommerce_cart_calculate_fees','hankart_cod_fee' );
function hankart_cod_fee() {
    global $woocommerce;

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

        // get your payment method
        $chosen_gateway = WC()->session->chosen_payment_method;
        //echo $chosen_gateway;
        $fee = 4;
        if ( $chosen_gateway == 'cod' && ! is_cart() ) { // hide on cart
            WC()->cart->add_fee( __( 'Pagamento alla consegna', 'storefront' ), $fee, false, '' );
        }
}

// jQuery - Update checkout on methode payment change
add_action( 'wp_footer', 'hankart_custom_checkout_jqscript' );
function hankart_custom_checkout_jqscript() {
    if ( is_checkout() && ! is_wc_endpoint_url() ) :
    ?>
    <script type="text/javascript">
    jQuery( function($){
        $('form.checkout').on('change', 'input[name="payment_method"]', function(){
            $(document.body).trigger('update_checkout');
        });
    });
    </script>
    <?php
    endif;
}

// Update cart on change
add_action( 'wp_footer', 'hankart_cart_update_qty' );
function hankart_cart_update_qty () {
  if (is_cart ()) : ?>
  <script>
    // Hide update cart button
    jQuery("[name='update_cart']").prop("hidden", true);
    jQuery('div.woocommerce').on('change', '.qty', function(){
      jQuery("[name='update_cart']").prop("disabled", false);
      jQuery("[name='update_cart']").trigger("click");
    });

  </script>
  <?php
  endif;
}

// Exclude slider images from lazy loading
function rocket_lazyload_exclude_class( $attributes ) {
	$attributes[] = 'class="custom-logo"';
  // custom-logo

	return $attributes;
}
add_filter( 'rocket_lazyload_excluded_attributes', 'rocket_lazyload_exclude_class' );


function hankart_custom_logo_markup() {
  if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
    $logo = get_custom_logo();
    $html = is_home() ? '<h1 class="logo">' . $logo . '</h1>' : $logo;
  } else {
    $tag = is_home() ? 'h1' : 'div';

    $html = '<' . esc_attr( $tag ) . ' class="beta site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $tag ) . '>';

    if ( '' !== get_bloginfo( 'description' ) ) {
      $html .= '<p class="site-description">' . esc_html( get_bloginfo( 'description', 'display' ) ) . '</p>';
    }
  }

  if ( ! $echo ) {
    return $html;
  }

  echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
// add_filter( 'storefront_site_title_or_logo', 'hankart_custom_logo_markup' );

// TEST REMOVE SOME WOOCOOMERCE SQLiteUnbuffered
// remove woocommerce scripts on unnecessary pages
// function woocommerce_de_script() {
//     if (function_exists( 'is_woocommerce' )) {
//      if (!is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page() ) { // if we're not on a Woocommerce page, dequeue all of these scripts
//     	wp_dequeue_script('wc-add-to-cart');
//     	wp_dequeue_script('jquery-blockui');
//     	wp_dequeue_script('jquery-placeholder');
//     	wp_dequeue_script('woocommerce');
//     	wp_dequeue_script('jquery-cookie');
//     	wp_dequeue_script('wc-cart-fragments');
//       }
//     }
// }
// add_action( 'wp_print_scripts', 'woocommerce_de_script', 100 );
// add_action( 'wp_enqueue_scripts', 'remove_woocommerce_generator', 99 );
// function remove_woocommerce_generator() {
//     if (function_exists( 'is_woocommerce' )) {
// 	if (!is_woocommerce()) { // if we're not on a woo page, remove the generator tag
// 		remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
// 	}
//     }
// }
// // remove woocommerce styles, then add woo styles back in on woo-related pages
// function child_manage_woocommerce_css(){
//     if (function_exists( 'is_woocommerce' )) {
// 	if (!is_woocommerce()) { // this adds the styles back on woocommerce pages. If you're using a custom script, you could remove these and enter in the path to your own CSS file (if different from your basic style.css file)
// 		wp_dequeue_style('woocommerce-layout');
// 		wp_dequeue_style('woocommerce-smallscreen');
// 		wp_dequeue_style('woocommerce-general');
// 	}
//     }
// }
// add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_css' );


// Preload JS
// add_action('wp_head', function () {
//   global $wp_scripts;
//
//   foreach ($wp_scripts->queue as $handle) {
//     $script = $wp_scripts->registered[$handle];
//
//     //-- If version is set, append to end of source.
//     $source = $script->src . ($script->ver ? "?ver={$script->ver}" : "");
//
//     //-- Spit out the tag.
//     echo "<link rel='preload' href='{$source}' as='script'/>\n";
//   }
// }, 1);


/** Disable Ajax Call from WooCommerce */
add_action( 'wp_enqueue_scripts', 'dequeue_woocommerce_cart_fragments', 11);
function dequeue_woocommerce_cart_fragments() {
  if (is_front_page()) wp_dequeue_script('wc-cart-fragments');
}
