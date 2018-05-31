<?php
function travelinhershoes_setup() {
	// override parent theme's 'more' text for excerpts
	remove_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'travelinhershoes_setup' );

function travelinhershoes_enqueue_styles() {
	$parent_style = 'twentyseventeen-style';
  wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'travelinhershoes-style',
    get_stylesheet_directory_uri() . '/style.css',
    array( $parent_style ),
    wp_get_theme()->get('Version')
  );
	wp_enqueue_style( 'travelinhershoes-font', 'https://fonts.googleapis.com/css?family=Oswald' );
	wp_enqueue_style( 'travelinhershoes-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
}

add_action( 'wp_enqueue_scripts', 'travelinhershoes_enqueue_styles' );

/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function travelinhershoes_excerpt_more( $link ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
	 	esc_url( get_permalink( get_the_ID() ) ),
	 	/* translators: %s: Name of current post */
	 	__( 'View Post', 'twentyseventeen' )
	 );
	 return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'travelinhershoes_excerpt_more' );


/**
 * Add social settings in customizer
 */
function travelinhershoes_customize_social( $wp_customize ) {
  $wp_customize->add_section(
    'travelinhershoes_social_settings',
    array(
      'title' => 'Social Settings',
      'description' => 'Enter your social links.',
      'priority' => 35,
    )
  );
	$wp_customize->add_setting(
    'travelinhershoes_social_settings_instagram',
    array(
      'default' => '',
    )
	);
	$wp_customize->add_control(
    'travelinhershoes_social_settings_instagram',
    array(
        'label' => 'Instagram @ handle',
				'description' => 'Enter your username only',
        'section' => 'travelinhershoes_social_settings',
        'type' => 'text',
    )
	);
	$wp_customize->add_setting(
    'travelinhershoes_social_settings_facebook',
    array(
      'default' => '',
    )
	);
	$wp_customize->add_control(
    'travelinhershoes_social_settings_facebook',
    array(
        'label' => 'Facebook handle',
				'description' => 'Only the part after facebook.com/',
        'section' => 'travelinhershoes_social_settings',
        'type' => 'text',
    )
	);
	$wp_customize->add_setting(
    'travelinhershoes_social_settings_youtube',
    array(
      'default' => '',
    )
	);
	$wp_customize->add_control(
    'travelinhershoes_social_settings_youtube',
    array(
        'label' => 'YouTube',
				'description' => 'Only the part after youtube.com/',
        'section' => 'travelinhershoes_social_settings',
        'type' => 'text',
    )
	);
	$wp_customize->add_setting(
    'travelinhershoes_social_settings_email',
    array(
      'default' => '',
    )
	);
	$wp_customize->add_control(
    'travelinhershoes_social_settings_email',
    array(
        'label' => 'Email Address',
				'description' => 'Enter your full email address',
        'section' => 'travelinhershoes_social_settings',
        'type' => 'text',
    )
	);
}
add_action( 'customize_register', 'travelinhershoes_customize_social' );

/**
 * WooCommerce
 */
// remove breadcrumbs
add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

// remove add to cart buttons on shop page
add_action( 'woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1 );
function remove_add_to_cart_buttons() {
  if( is_product_category() || is_shop()) {
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
  }
}

/**
 * Get first image in a post
 */

function travelinhershoes_url_get_image_id($image_url) {
	 global $wpdb;
	 $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
	 // return $attachment[0];
}

/* determine whether post has a featured image, if not, find the first image inside the post content, $size passes the thumbnail size, $url determines whether to return a URL or a full image tag*/

function travelinhershoes_get_first_image( $size ) {
	global $post;
	$content = $post->post_content;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
	$first_img = $matches[1][0];

	if ($first_img) {
		//let's get the correct image dimensions
		$image_id = travelinhershoes_url_get_image_id($first_img);
		$image_thumb = wp_get_attachment_image_src($image_id, $size);

		// if we've found an image ID, correctly display it
		if($image_thumb) {
			return $image_thumb[0];
		} else {
			return $first_img;
		}
	}
}

?>
