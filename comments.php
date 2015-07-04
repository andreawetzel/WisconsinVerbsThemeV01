<?php

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comment-box">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), '', '' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h2>
		<div class="comment-list">
			<?php
				wp_list_comments( array(
					'callback' => 'wv_comments',
					'style'       => 'div',
					'short_ping'  => true,
					'avatar_size' => 0,
				) );
			?>
		</div><!-- .comment-list -->
	<?php endif; // have_comments() ?>
	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments">Comments are closed.</p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- .comments-area -->
