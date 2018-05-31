<?php

$this_post_num = $wp_query->current_post;

$home_layout = 5;
$category_layout = 5;

if ( (is_home() && ($home_layout == 3 || $home_layout == 5)) || ((is_archive() || is_search()) && ($category_layout == 3 || $category_layout == 5)) ) { // offsets for kensington
	$this_post_num++;
}

$post_class = $clearfix = '';
$grid_title = 'grid-title';

$post_class .= ' travelinhershoes-grid-post';

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );
if ($thumb) {
	$bg = esc_url($thumb['0']);
} else {
	$post_id = get_the_ID();
	$bg = travelinhershoes_get_first_image( 'medium' );
}

?>

<div class="<?php echo $post_class; ?>">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta"><span class="date-bar-white-bg">';
			echo twentyseventeen_time_link();
			echo '</span></div><!-- .entry-meta -->';
		};

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>
	</header>

	<div class="entry-summary">
		<a href="<?php the_permalink() ?>" class="grid-cover-img" style="display: block; width: 100%; height: 100%;background-image:url(<?php echo $bg; ?>);">
			<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAyAAAAHCAQMAAAAtrT+LAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAENJREFUeNrtwYEAAAAAw6D7U19hANUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAALIDsYoAAZ9qTLEAAAAASUVORK5CYII=" alt="<?php the_title_attribute(); ?>" class="p3_invisible" data-pin-nopin="true"/>
		</a>
		<a class="more-link" href="<?php the_permalink(); ?>"><?php _e('View Post', 'pipdig-textdomain'); ?></a>
	</div>

	<footer class="entry-meta entry-footer">
		<?php get_template_part( 'template-parts/post/social-shares' ); ?>
		<?php if ( 'post' == get_post_type() ) { ?>
			<span class="comments">
				<a href="<?php comments_link(); ?>" data-disqus-url="<?php echo esc_url(get_the_permalink()); ?>">
					<?php comments_number( 'Comments', '1 Comment', '% Comments' ); ?>
				</a>
			</span>
		<?php } // end if ?>
	</footer>
<!-- #post-<?php the_ID(); ?> --></article>
</div>
