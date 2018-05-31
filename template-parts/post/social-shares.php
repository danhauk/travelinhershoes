<?php

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
if ($thumb) {
	$img = esc_url($thumb['0']);
} else {
	$img = '';
}

$link = get_the_permalink();
$title = rawurlencode(get_the_title());
$summary = rawurlencode(strip_shortcodes(strip_tags(get_the_excerpt())));

?>

<div class="share-toolbox">
	<h6 class="share-title">Share: </h6>
	<?php
	echo '<a href="'.esc_url('mailto:?subject=Shared: '.$title.'&body=I thought you might like this '.$link).'" target="_blank" rel="nofollow noopener" aria-label="Share via email" title="Share via email"><i class="fa fa-envelope" aria-hidden="true"></i></a>';

	echo '<a href="'.esc_url('https://www.facebook.com/sharer.php?u='.$link).'" target="_blank" rel="nofollow noopener" aria-label="Share on Facebook" title="Share on Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>';

	echo '<a href="'.esc_url('https://twitter.com/share?url='.$link.'&text='.$title).'" target="_blank" rel="nofollow noopener" aria-label="Share on Twitter" title="Share on Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>';

	echo '<a href="'.esc_url('https://pinterest.com/pin/create/link/?url='.$link.'&media='.$img.'&description='.$title).'" target="_blank" rel="nofollow noopener" aria-label="Share on Pinterest" title="Share on Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>';

	echo '<a href="'.esc_url('https://www.tumblr.com/widgets/share/tool?canonicalUrl='.$link.'&title='.$title).'" target="_blank" rel="nofollow noopener" aria-label="Share on tumblr" title="Share on tumblr"><i class="fa fa-tumblr" aria-hidden="true"></i></a>';

	echo '<a href="'.esc_url('https://api.whatsapp.com/send?text='.$link).'" target="_blank" rel="nofollow noopener" aria-label="Share on whatsapp" title="Share on whatsapp" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>';
	?>
</div>
