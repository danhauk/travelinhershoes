<?php
/**
 * Displays top navigation
 */

$instagram = get_theme_mod( 'travelinhershoes_social_settings_instagram', '' );
$facebook = get_theme_mod( 'travelinhershoes_social_settings_facebook', '' );
$youtube = get_theme_mod( 'travelinhershoes_social_settings_youtube', '' );
$email = get_theme_mod( 'travelinhershoes_social_settings_email', '' );

?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'twentyseventeen' ); ?>">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
		<?php
		echo twentyseventeen_get_svg( array( 'icon' => 'bars' ) );
		echo twentyseventeen_get_svg( array( 'icon' => 'close' ) );
		?>
	</button>

	<div class="top-social-menu">
		<?php if ( $instagram != '' ): ?>
			<a href="https://instagram.com/<?php echo $instagram; ?>" target="_blank" rel="nofollow noopener" aria-label="instagram" title="instagram">
			<i class="fa fa-instagram" aria-hidden="true"></i>
		</a>
		<?php endif; ?>

		<?php if ( $facebook != '' ): ?>
			<a href="https://facebook.com/<?php echo $facebook; ?>" target="_blank" rel="nofollow noopener" aria-label="facebook" title="facebook">
				<i class="fa fa-facebook" aria-hidden="true"></i>
			</a>
		<?php endif; ?>

		<?php if ( $youtube != '' ): ?>
			<a href="https://youtube.com/<?php echo $youtube; ?>" target="_blank" rel="nofollow noopener" aria-label="youtube" title="youtube">
				<i class="fa fa-youtube-play" aria-hidden="true"></i>
			</a>
		<?php endif; ?>

		<?php if ( $email != '' ): ?>
			<a href="mailto:<?php echo $email; ?>" target="_blank" rel="nofollow noopener" aria-label="Email" title="Email">
				<i class="fa fa-envelope" aria-hidden="true"></i>
			</a>
		<?php endif; ?>

		<?php if ( function_exists('wc_get_cart_url') ): ?>
			<a href="<?php echo wc_get_cart_url(); ?>" rel="nofollow noopener">
				<i class="fa fa-shopping-cart"></i>
			</a>
		<?php endif; ?>
	</div>

	<?php wp_nav_menu( array(
		'theme_location' => 'top',
		'menu_id'        => 'top-menu',
	) ); ?>

</nav><!-- #site-navigation -->
