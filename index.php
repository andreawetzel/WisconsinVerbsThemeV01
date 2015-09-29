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
        <div class="col-md-8 add-btm-margin">
            <?php if ( have_posts() ) : while ( have_posts() ): the_post(); ?>
            <article class="blog-post">
                <?php if ( has_post_thumbnail() ) { ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('large'); ?></a>    
                <?php }  ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h2>
                <?php if(is_single()): ?>
                <?php the_content(); ?>
                <?php else: ?>
                <?php the_content('',FALSE,''); ?> <!--Used in place of the_excerpt-->
                <div class="blog-post-date"> <p>
                    <a href="<?php the_permalink(); ?>">Continue reading</a><br><?php the_author(); ?>  &ndash; <?php the_time('F j, Y'); ?></p>
                </div>
                <?php endif; ?>
            </article>
            <?php endwhile; else: ?>
            <p>Sorry, this page could not be found</p>
            <?php endif; ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
