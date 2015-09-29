<?php get_header(); ?>
<div class="title-bg hero-title-bg">
    <div class="container">
        <div class="row">
            <div class="archive-leader col-sm-12">
                <h1><?php wp_title( '' ); ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8">

            <?php if ( have_posts() ) : while ( have_posts() ): the_post(); ?>
            <article class="blog-post">
                <?php if ( has_post_thumbnail() ) { ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('large'); ?></a>
                <?php }  ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h2>
                <?php the_excerpt(); ?>
                <div class="blog-post-date"> <p>
                    <a href="<?php the_permalink(); ?>">Continue reading</a><br><?php the_author(); ?>  &ndash; <?php the_time('F j, Y'); ?></p>
                </div>
            </article>
            <?php endwhile ?>
                <div class="previous-next-container">
                    <div class="pull-left"><?php previous_posts_link( 'Newer' ); ?></div>
                    <div class="pull-right"><?php next_posts_link( 'Older' ); ?></div>
                </div>
            <?php else: ?>
            <p>Sorry, no pages matched your search.</p>
            <?php get_search_form(); ?>
        <?php endif; ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
