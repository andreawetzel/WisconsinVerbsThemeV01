<?php get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                <?php
                if ( has_post_thumbnail() ) { ?>
                   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                   <?php the_post_thumbnail(); ?>
                   </a>
               <?php }  ?>
                <h1><?php the_title(); ?></h1>
                <div class="entry">
                    <p><a href="javascript:history.back()">&#8592; Back</a></p>
                    <p><?php echo wp_get_attachment_image( $post->id, 'large' ); ?></p><!-- Image -->
                    <?php if ( has_excerpt() ) : ?>
                    <div class="entry-caption">
                        <?php the_excerpt(); ?>
                    </div><!-- .entry-caption -->
                    <?php endif; ?>


                    <?php the_content(); ?>
                    <div class="blog-post-date"> <p><?php the_author_posts_link(); ?>  &ndash; <?php the_time('F j, Y'); ?>
                            <?php if (count( get_the_category() )) : ?>
                            &ndash; Category:
                            <?php the_category(', '); ?>
                            <?php endif; ?>
                            </p>
                    </div>
                    <div class="row">
                        <div class="previous-post-link col-sm-4">
                        <?php $prevPost = get_previous_post(); if($prevPost) { ?>
                            <div class="story-link-photo hidden-xs">
                               <?php $prevPost = get_previous_post(); $prevthumbnail = get_the_post_thumbnail($prevPost->ID, 'thumbnail' ); echo previous_post_link('%link', $prevthumbnail); ?>
                            </div>
                            <div class="story-link-title">
                            <?php previous_post_link('%link','Previous: %title'); ?>
                            </div>
                        <?php  } ; ?>
                        </div>
                        <div class="next-post-link col-sm-4 col-sm-offset-4">
                            <?php $nextPost = get_next_post(); if($nextPost) { ?>
                            <div class="story-link-photo hidden-xs">
                            <?php $nextPost = get_next_post(); $nextthumbnail = get_the_post_thumbnail($nextPost->ID, 'thumbnail' ); echo next_post_link('%link', $nextthumbnail); ?>
                            </div>
                            <div class="story-link-title">
                            <?php next_post_link('%link','Next: %title'); ?>
                            </div>
                       <?php } ; ?>
                       </div>
                    </div>
                </div>
            </div>
        <?php endwhile; endif; ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>
