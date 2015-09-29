<?php get_header(); ?>
<div class="title-bg home-title-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1><?php bloginfo('name'); ?></h1>
                <p><?php bloginfo('description'); ?></p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 add-btm-margin">
            <?php if ( have_posts() ) : while ( have_posts() ): the_post(); ?>
            <article <?php post_class('blog-post') ?> >
                <?php if ( has_post_thumbnail() ) { ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('large'); ?></a>
                <?php }  ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h2>
                <?php if(is_single()): ?>
                <?php the_content(); ?>
                <?php else: ?>
                <?php the_content('',FALSE,''); ?> <!--Used in place of the_excerpt-->
                <div class="blog-post-date"> <p>
                    <a href="<?php the_permalink(); ?>">Continue reading</a><br><?php the_time('F j, Y'); ?></p>
                </div>
                <?php endif; ?>
            </article>
            <?php endwhile ?>
                <div class="previous-next-container">
                    <div class="pull-left"><?php previous_posts_link( 'Newer' ); ?></div>
                    <div class="pull-right"><?php next_posts_link( 'Older' ); ?></div>
                </div>
            <?php else: ?>
            <p>there are no posts to display</p>
        <?php endif; ?>
        </div>
        <?php get_sidebar( 'home' ); ?>
    </div>
</div>
<?php get_footer(); ?>
