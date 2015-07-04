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
            <div class="page-content">
                <?php if ( have_posts() ) : while ( have_posts() ): the_post(); ?>
                <?php the_content(); ?>
                <?php endwhile; else: ?>
                <p>Sorry, this page does not exist.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>